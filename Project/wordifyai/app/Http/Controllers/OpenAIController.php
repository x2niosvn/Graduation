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

    public function AnalysisAndEvaluation(Request $request) {
        $message = $request->input('message');
        $analysisOrEvaluation = $request->input('analysis_evaluation');
    
        if (empty($message)) {
            return response()->json(['success' => false, 'error' => 'Text cannot be empty.']);
        }
    
        if ($analysisOrEvaluation == 'analysis') {
            return $this->analyzeText($request);
        } elseif ($analysisOrEvaluation == 'evaluation') {
            return $this->evaluateText($request);
        } else {
            return response()->json(['success' => false, 'error' => 'Invalid request.']);
        }
    }




    public function analyzeText(Request $request) {
        $message = $request->input('message');
        $messageLength = strlen($message);
    
        if ($messageLength > 30000 || $messageLength < 20) {
            return response()->json([
                'success' => false,
                'error' => $messageLength > 30000 
                    ? 'The text is too long. Please provide a text with less than 30,000 characters.' 
                    : 'The text is too short. Please provide a text with at least 20 characters.'
            ]);
        }
    
        try {
            $response = $this->openAIService->sendMessageForAnalysis($message);
            if (isset($response['choices']) && !empty($response['choices'])) {
                $answer = $response['choices'][0]['message']['content'];
                Log::info('Raw OpenAI Response: ', ['response' => $answer]);
    
                $formattedAnswer = $this->markdowntohtml($answer);
                $analysisCode = uniqid('wordifyai_', true); // Tạo mã ngẫu nhiên
    
                $textAnalysis = TextAnalysis::create([
                    'user_id' => auth()->id(),
                    'text_content' => $message,
                    'analysis_result' => $formattedAnswer,
                    'type_of_analysis' => 'text analysis',
                    'evaluation' => '', // Khởi tạo trống
                    'status' => 'completed',
                    'analysis_evaluation_code' => $analysisCode, // Lưu mã
                ]);
    
                return response()->json([
                    'success' => true,
                    'type' => 'analysis',
                    'answer' => $formattedAnswer,
                    'analysis_id' => $textAnalysis->id,
                    'analysis_evaluation_code' => $analysisCode, // Trả về mã
                    'history_entry' => 'Analyzed: ' . $message,
                ]);
            } else {
                throw new \Exception('Cannot get valid response from OpenAI API.');
            }
        } catch (\Exception $e) {
            Log::error('Error while calling OpenAI API: ', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    
    public function evaluateText(Request $request) {
        $message = $request->input('message');
        $messageLength = strlen($message);
    
        if ($messageLength > 30000 || $messageLength < 20) {
            return response()->json([
                'success' => false,
                'error' => $messageLength > 30000 
                    ? 'The text is too long. Please provide a text with less than 30,000 characters.' 
                    : 'The text is too short. Please provide a text with at least 20 characters.'
            ]);
        }
    
        try {
            $response = $this->openAIService->sendMessageForEvaluation($message);
            if (isset($response['choices']) && !empty($response['choices'])) {
                $evaluation = $response['choices'][0]['message']['content'];
                Log::info('Raw OpenAI Evaluation Response: ', ['response' => $evaluation]);
    
                $formattedEvaluation = $this->markdowntohtml($evaluation);
                
                $analysisCode = uniqid('wordifyai_', true); // Tạo mã ngẫu nhiên
    

                $textAnalysis = TextAnalysis::create([
                    'user_id' => auth()->id(),
                    'text_content' => $message,
                    'analysis_result' => '', // Khởi tạo trống
                    'type_of_analysis' => 'text evaluation',
                    'evaluation' => $formattedEvaluation, 
                    'status' => 'completed',
                    'analysis_evaluation_code' => $analysisCode, // Lưu mã
                ]);
                    
                    // Trả về mã phân tích
                    return response()->json([
                        'success' => true,
                        'type' => 'evaluation',
                        'evaluation' => $formattedEvaluation,
                        'analysis_id' => $textAnalysis->id,
                        'analysis_evaluation_code' => $analysisCode, // Trả về mã
                    ]);
                
            } else {
                throw new \Exception('Cannot get valid response from OpenAI API.');
            }
        } catch (\Exception $e) {
            Log::error('Error while calling OpenAI API for evaluation: ', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    











    public function analyzeTextGuest(Request $request) {
        $message = $request->input('message');
    
        try {
            $response = $this->openAIService->sendMessageForAnalysis($message);
            
            if (!empty($response['choices'])) {
                $answer = $response['choices'][0]['message']['content'];
                Log::info('Raw OpenAI Response: ', ['response' => $answer]);
    
                return response()->json([
                    'success' => true,
                    'answer' => $this->markdowntohtml($answer),
                ]);
            }
    
            throw new \Exception('Cannot get valid response from OpenAI API.');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    











    public function AnalysisAndEvaluationGuest(Request $request) {
        $message = $request->input('message');
    
        // Kiểm tra tính hợp lệ của văn bản
        if (empty($message)) {
            return response()->json(['success' => false, 'error' => 'Text cannot be empty.']);
        }
    
        if (str_word_count($message) > 500) {
            return response()->json(['success' => false, 'error' => 'The text is too long. Please provide a text with less than 500 words.']);
        }
    
        return $this->analyzeTextGuest($request);
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
