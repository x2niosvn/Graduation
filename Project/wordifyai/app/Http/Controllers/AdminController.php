<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\TextAnalysis;
use App\Models\Suggestion;
class AdminController extends Controller
{
        // Hiển thị danh sách người dùng
        public function index()
        {
            $users = User::all();
            return view('admin.user_management', compact('users'));
        }

        public function create()
        {
            return view('admin.create_user');
        }



    // Lưu người dùng mới
    public function store(Request $request)
    {
        // Validate the request with custom error messages
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'role_id' => 'required|integer',
        ]);
    
        // Create the user if validation passes
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);
    
        return redirect()->route('user-management')->with('success', 'User created successfully');
    }
    
    




    // Hiển thị form chỉnh sửa người dùng
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    // Cập nhật thông tin người dùng
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role_id' => 'required|integer',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('user-management')->with('success', 'User information updated successfully');
    }










    // Xóa người dùng
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user-management')->with('error', 'User not found');
        }

        $user->delete();

        return redirect()->route('user-management')->with('success', 'User deleted successfully');
    }











    // Xem danh sách lịch sử đánh giá
    public function analysisHistory()
    {
        // Lấy tất cả dữ liệu mà không phân trang
        $history = TextAnalysis::orderBy('created_at', 'desc')->get();
        return view('admin.analysis_history', compact('history'));
    }
    




    // Hiển thị chi tiết phân tích
    public function viewAnalysisDetail($id)
    {
        $analysis = TextAnalysis::where('type_of_analysis', 'text analysis')->findOrFail($id);
        return view('admin.analysis_detail', compact('analysis'));
    }

    // Hiển thị chi tiết đánh giá
    public function viewEvaluationDetail($id)
    {
        $evaluation = TextAnalysis::where('type_of_analysis', 'text evaluation')->findOrFail($id);
        return view('admin.evaluation_detail', compact('evaluation'));
    }



    // Xóa lịch sử đánh giá
    public function deleteAnalysis($id)
    {
        $analysis = TextAnalysis::findOrFail($id);
        $analysis->delete();

        return redirect()->route('admin.analysisHistory')->with('success', 'Deleted analysis or evaluation successfully');
    }






    //hiển thị bảng suggestion
    public function adminIndex()
    {
        // Lấy tất cả dữ liệu mà không phân trang
        $suggestions = Suggestion::latest()->get();
        return view('admin.suggestions.index', compact('suggestions'));
    }
    

    //hiển thị chi tiết suggestion
    public function adminShow($id)
    {
        $suggestion = Suggestion::findOrFail($id);
        return view('admin.suggestions.show', compact('suggestion'));
    }

    //cập nhật suggestion
    public function adminUpdate(Request $request, $id)
{
    $suggestion = Suggestion::findOrFail($id);
    $suggestion->status = $request->status;
    $suggestion->admin_feedback = $request->admin_feedback;
    $suggestion->save();

    return redirect()->route('admin.suggestions.index')->with('success', 'Suggestion updated successfully.');
}



function getApiBalance($apiKey)
{
    $url = "https://open.keyai.shop/check-balance";
    $payload = [
        'api_key' => $apiKey
    ];

        // Khởi tạo cURL
        $ch = curl_init();

        // Cấu hình cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload)); // Convert payload sang query string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded' // Định dạng header
        ]);
    
        // Thực hiện yêu cầu và lấy kết quả
        $response = curl_exec($ch);
            // Kiểm tra lỗi cURL
    if (curl_errno($ch)) {
        curl_close($ch);
        return [
            'error' => 'cURL Error: ' . curl_error($ch)
        ];
    }

    // Đóng cURL
    curl_close($ch);

    // Phân tích kết quả trả về
    $data = json_decode($response, true);

    if (isset($data['balance'])) {
        return [
            'balance' => $data['balance'],
            'used_quota' => $data['used_quota']
        ];
    } else {
        return [
            'error' => 'Failed to retrieve balance. Response: ' . $response
        ];
    }

}


    public function dashboard()
    {
        $userCount = User::count(); // Số lượng người dùng

        $totalAnalysisAndEvaluations = TextAnalysis::count(); // Tổng số phân tích và đánh giá

        $totalAnalysis = TextAnalysis::where('type_of_analysis', 'text analysis')->count(); // Tổng số phân tích


        $totalEvaluations = TextAnalysis::where('type_of_analysis', 'text evaluation')->count(); // Tổng số đánh giá



        $completedAnalysis = TextAnalysis::where('type_of_analysis', 'text analysis')->where('status', 'completed')->count(); // Số lượng phân tích hoàn thành
        $incompleteAnalysis = TextAnalysis::where('type_of_analysis', 'text analysis')->where('status', '!=', 'completed')->count(); // Số lượng phân tích chưa hoàn thành



        $completedEvaluations = TextAnalysis::where('type_of_analysis', 'text evaluation')->where('status', 'completed')->count(); // Số lượng đánh giá hoàn thành
        $incompleteEvaluations = TextAnalysis::where('type_of_analysis', 'text evaluation')->where('status', '!=', 'completed')->count(); // Số lượng đánh giá chưa hoàn thành


        $totalSuggestions = Suggestion::count(); // Tổng số góp ý

        //tộng số góp ý chưa xử lý
        $totalPendingSuggestions = Suggestion::where('status', 'pending')->count();

        //tổng số góp ý đã xử lý
        $totalResolvedSuggestions = Suggestion::where('status', 'approved')->count();

        //tổng số góp ý không thể xử lý
        $totalUnresolvedSuggestions = Suggestion::where('status', 'rejected')->count();

        $apiKey = 'sk-OvqAynH2w5OCjqboSL12ajRY1GRi23Yis5Wm2XVhPxC0WBur';
        $balance = $this->getApiBalance($apiKey);
        $balance_full = $balance['balance'];
        $balance_used = $balance['used_quota'];

        return view('admin.dashboard', compact(
            'userCount',
            'totalAnalysisAndEvaluations', 
            'totalAnalysis', 
            'totalEvaluations', 
            'completedAnalysis', 
            'incompleteAnalysis', 
            'completedEvaluations', 
            'incompleteEvaluations',
            'totalSuggestions',
            'totalPendingSuggestions',
            'totalResolvedSuggestions',
            'totalUnresolvedSuggestions',
            'balance_full',
            'balance_used'
        ));
    }

}











