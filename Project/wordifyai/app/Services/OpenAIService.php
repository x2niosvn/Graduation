<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'https://api.keyai.shop/v1'; // api endpoint
        $this->apiKey = config('services.openai.api_key'); // api key
    }

    public function sendMessageForAnalysis($message)
    {
        // nhan du lieu tu form
        $language = request()->input('language', 'en'); // ngon ngu
        $situation = request()->input('situation', 'general'); // tinh huong
        $spell_check = request()->input('spell_check', 'yes') === 'yes' ? 'enabled' : 'disabled'; // Nhận tùy chọn kiểm tra chính tả

        // Kiểm tra dữ liệu đầu vào
        if (empty($message) || strlen($message) < 10) {
            return ['error' => 'Your input is too short or invalid.'];
        }

        // gui yeu cau den API de phan tich
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->post("{$this->baseUrl}/chat/completions", [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "You are a text-analyzing AI that operates and responds in {$language}. Your task is to analyze in detail the content of a given text from a user, the user will give you a situation that you have to analyze according to which is {$situation}. {$spell_check} checks the spelling of the text and {$spell_check} points out any errors or omissions at the end of the analysis.
Please identify and reject irrelevant input, including greetings, math problems, and general questions. If you encounter irrelevant input, respond with a message stating that it is irrelevant and make sure to stay focused on your analysis."
                ],
                [
                    'role' => 'user',
                    'content' => $message
                ],
            ],
        ]);

        // Kiểm tra xem có lỗi không
        if ($response->failed()) {
            throw new \Exception('Error connecting to OpenAI API for analysis');
        }

        // Trả về kết quả
        return $response->json();
    }

    public function sendMessageForEvaluation($message)
    {
        // Nhận ngôn ngữ từ form
        $language = request()->input('language', 'en'); // nhan ngon ngu

        // Kiểm tra dữ liệu đầu vào
        if (empty($message) || strlen($message) < 10) {
            return ['error' => 'Your input is too short or invalid.'];
        }

        // Gửi yêu cầu đến API để đánh giá
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->post("{$this->baseUrl}/chat/completions", [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "You are an expert in evaluating text analysis. Your role is to evaluate the provided analysis focusing on structure, clarity, tone, and overall quality. Respond in the language of {$language}."
                ],
                [
                    'role' => 'user',
                    'content' => $message
                ],
            ],
        ]);

        // Kiểm tra xem có lỗi không
        if ($response->failed()) {
            throw new \Exception('Error connecting to OpenAI API for evaluation');
        }

        // Trả về kết quả
        return $response->json();
    }
}
