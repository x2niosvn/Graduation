<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\TextAnalysis;
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
        $history = TextAnalysis::orderBy('created_at', 'desc')->paginate(10);
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

        return view('admin.dashboard', compact(
            'userCount',
            'totalAnalysisAndEvaluations', 
            'totalAnalysis', 
            'totalEvaluations', 
            'completedAnalysis', 
            'incompleteAnalysis', 
            'completedEvaluations', 
            'incompleteEvaluations'
        ));
    }

}











