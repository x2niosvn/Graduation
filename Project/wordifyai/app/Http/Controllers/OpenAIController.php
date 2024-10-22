<?php

namespace App\Http\Controllers;

use App\Models\TextAnalysis;  // Thêm import mô hình TextAnalysis
use App\Models\History;       // Thêm import mô hình History





use App\Services\OpenAIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Parsedown;

class OpenAIController extends Controller
{

    



    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function analysisText(Request $request)
    {
        // Lấy message từ request
        $message = $request->input('message');
    
        // Kiểm tra độ dài ký tự (bao gồm cả dấu cách)
        $messageLength = strlen($message);
        if ($messageLength > 30000 || $messageLength < 20) {
            $errorMessage = $messageLength > 30000 
                ? 'The text is too long. Please provide a text with less than 30,000 characters.' 
                : 'The text is too short. Please provide a text with at least 20 characters.';

            return response()->json([
                'success' => false,
                'error' => $errorMessage,
            ]);
        }

    
        // Gửi message tới API và nhận phản hồi
        try {
            $response = $this->openAIService->sendMessageForAnalysis($message);
    
            // Kiểm tra phản hồi có hợp lệ không
            if (isset($response['choices']) && !empty($response['choices'])) {
                // Lọc ra chỉ phần câu trả lời từ phản hồi
                $answer = $response['choices'][0]['message']['content'];
                Log::info('Raw OpenAI Response: ', ['response' => $answer]);
    
                // Chuyển đổi định dạng Markdown thành HTML cho kết quả phân tích
                $formattedAnswer = $this->markdowntohtml($answer);
    
                // Lưu lịch sử phân tích
                $textAnalysis = TextAnalysis::create([
                    'user_id' => auth()->id(),  // Lấy ID người dùng hiện tại
                    'text_content' => $message,
                    'analysis_result' => $formattedAnswer,
                    'type_of_analysis' => 'text analysis',  // Bạn có thể thay đổi giá trị này tùy theo yêu cầu
                    'evaluation' => '',  // Để trống ban đầu, sẽ cập nhật sau
                    'status' => 'completed',  // Đặt trạng thái là 'completed'
                ]);
    
                // Đánh giá văn bản đầu vào
                $evaluation = $this->evaluateText($message);
    
                // Chuyển đổi kết quả đánh giá sang HTML
                $formattedEvaluation = $this->markdowntohtml($evaluation);
    
                // Cập nhật lại đánh giá trong bảng text_analysis
                $textAnalysis->evaluation = $formattedEvaluation;
                $textAnalysis->save(); // Lưu thay đổi
    
                // Lưu lịch sử hành động của người dùng
                History::create([
                    'user_id' => auth()->id(),
                    'action' => 'Analyzed text with ID: ' . $textAnalysis->id,
                ]);
    
                // Trả về JSON cho AJAX
                return response()->json([
                    'success' => true,
                    'answer' => $formattedAnswer,
                    'evaluation' => $formattedEvaluation,
                    'history_entry' => 'Analyzed: ' . $message, // Cập nhật lịch sử
                ]);
            } else {
                throw new \Exception('Can not get valid response from OpenAI API.');
            }
    
        } catch (\Exception $e) {
            // Log lỗi để dễ dàng theo dõi
            Log::error('Error while calling OpenAI API: ', ['error' => $e->getMessage()]);
    
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ]);
        }
    }
    
    




    private function evaluateText($analysisResult)
    {
        try {
            // Gọi OpenAI API để đánh giá kết quả phân tích
            $response = $this->openAIService->sendMessageForEvaluation($analysisResult);

            // Trích xuất kết quả đánh giá từ phản hồi
            if (isset($response['choices']) && !empty($response['choices'])) {
                return $response['choices'][0]['message']['content'];
            } else {
                return 'No evaluation available.';
            }
        } catch (\Exception $e) {
            // Nếu có lỗi, trả về một thông báo mặc định
            Log::error('Error while evaluating text: ', ['error' => $e->getMessage()]);
            return 'Unable to evaluate the text at this moment. Please try again later.';
        }
    }












    private function markdowntohtml($text)
    {
        $parsedown = new Parsedown();
        return $parsedown->text($text);
    }


    public function showAnalysisForm()
    {
        return view('user.aianalyisvealuation'); // Truyền biến đến view
    }
    

    public function showAnalysisGuestForm()
    {
        return view('aianalyisvealuationguest'); // Truyền biến đến view
    }



    public function showAnalysisEvaluationHistory()
    {
        $histories = TextAnalysis::all(); // Lấy tất cả dữ liệu lịch sử
        return view('user.analysisevaluationhistory', compact('histories'));
    }
    
    public function getAnalysisDetail($id)
    {
        $history = TextAnalysis::find($id); // Lấy dữ liệu theo ID
        if ($history) {
            $text_content = $history->text_content;
            $analysis = $history->analysis_result;
            $evaluation = $history->evaluation;


            return response()->json([
                'content' => $this->markdowntohtml($text_content), // Chuyển đổi Markdown sang HTML
                'analysis' => $this->markdowntohtml($analysis), // Thay đổi theo trường của bạn
                'evaluation' => $this->markdowntohtml($evaluation), // Thay đổi theo trường của bạn
            ]);
        }
        return response()->json(['error' => 'Can not find data'], 404);
    }
    


    public function destroy($id)
    {
    $history = TextAnalysis::find($id);
    
    if (!$history) {
        return response()->json(['error' => 'History not found.'], 404);
    }

    // Xóa bản ghi
    $history->delete();

    return response()->json(['success' => 'History deleted successfully.']);
    }

}
