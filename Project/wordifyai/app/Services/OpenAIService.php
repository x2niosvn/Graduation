<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'https://api.keyai.shop/v1';  // Địa chỉ API bạn sử dụng
        $this->apiKey = config('services.openai.api_key');  // Lấy key từ config
    }

    public function sendMessage($message)
    {
        // Gửi yêu cầu đến API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->post("{$this->baseUrl}/chat/completions", [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $message,
                ],
            ],
        ]);

        // Kiểm tra xem có lỗi không
        if ($response->failed()) {
            throw new \Exception('Error connecting to OpenAI API');
        }

        // Trả về kết quả
        return $response->json();
    }
}
