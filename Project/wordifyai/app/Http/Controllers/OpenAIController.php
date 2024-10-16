<?php

namespace App\Http\Controllers;

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

    public function askOpenAI(Request $request)
    {
        // Lấy message từ request
        $message = $request->input('message');

        // Gửi message tới API và nhận phản hồi
        try {
            $response = $this->openAIService->sendMessage($message);

            // Lọc ra chỉ phần câu trả lời từ phản hồi
            $answer = $response['choices'][0]['message']['content'];

            Log::info('Raw OpenAI Response: ', ['response' => $answer]);

            // Chuyển đổi định dạng Markdown thành HTML
            $formattedAnswer = $this->markdowntohtml($answer);
            
            // Trả về view cùng với câu trả lời
            return view('ask-openai-form', ['answer' => $formattedAnswer, 'message' => $message]);

        } catch (\Exception $e) {
            return view('ask-openai-form', ['error' => $e->getMessage()]);
        }
    }

    private function markdowntohtml($text)
    {
        $parsedown = new Parsedown();
        return $parsedown->text($text);
    }
}