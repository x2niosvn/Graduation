<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class OpenAIService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'https://api.keyai.shop/v1'; // api endpoint
        $this->apiKey = config('services.openai.api_key'); // api key
    }

    /**
     * Gửi yêu cầu phân tích văn bản.
     *
     * @param string $message
     * @return array
     * @throws \Exception
     */
    public function sendMessageForAnalysis($message)
    {
        $language = request()->input('language', 'en'); // Ngôn ngữ

        // Gửi yêu cầu đến API để phân tích
        $response = $this->sendRequest($language, $message, "You are a text-analyzing AI named WordifiAI.
Please analyze the following text in detail and identify its type. 
Focus on the following aspects in your analysis:
1. Content Understanding: Provide a summary of the main ideas and themes presented in the text.
2. Type Identification: Clearly identify the type of text (e.g., story, review, essay, article, etc.) and explain your reasoning.
3. Language Use: Analyze the effectiveness of the language used, including vocabulary, sentence structure, and overall style.
4. Engagement: Assess how engaging the text is for its intended audience. Does it capture interest? Is it compelling?
5. Overall Analysis: Offer a comprehensive evaluation of the text's strengths and weaknesses, along with any suggestions for improvement.
Translate all respond to {$language}.");

        return $response;
    }

    /**
     * Gửi yêu cầu đánh giá văn bản.
     *
     * @param string $message
     * @return array
     * @throws \Exception
     */
    public function sendMessageForEvaluation($message)
    {
        $language = request()->input('language', 'en'); // Ngôn ngữ


        // Gửi yêu cầu đến API để đánh giá
        $response = $this->sendRequest($language, $message, "You are WordifyAI. You are an expert in evaluating text analysis. Please analyze the following text in detail. 
Focus on the following aspects:
1. Structure: Assess the organization of ideas, paragraphing, and overall flow. Are the main points clear and logically arranged?
2. Clarity: Evaluate how clearly the ideas are expressed. Is the language accessible and straightforward? Are there any ambiguous or confusing phrases?
3. Tone: Analyze the tone of the text. Does it suit the intended audience and purpose? Is it formal, informal, persuasive, etc.?
4. Overall Quality: Provide an assessment of the overall effectiveness of the text. Consider factors such as engagement, originality, and whether the text fulfills its intended purpose.
Translate all respond to {$language}."); 

        return $response;
    }

    /**
     * Gửi yêu cầu đến API với thông điệp và ngôn ngữ đã chỉ định.
     *
     * @param string $language
     * @param string $message
     * @param string $systemMessage
     * @return array
     * @throws \Exception
     */
    protected function sendRequest($language, $message, $systemMessage)
    {
        // Tạo một khóa cache duy nhất cho yêu cầu
        $cacheKey = "analysis_{$language}_" . md5($message);

        // Kiểm tra xem có dữ liệu đã được cache không
        $cachedResponse = Cache::get($cacheKey);
        if ($cachedResponse) {
            return $cachedResponse;
        }

        // Thiết lập timeout cho yêu cầu
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->timeout(30)->post("{$this->baseUrl}/chat/completions", [ // Thay đổi timeout ở đây
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $systemMessage . " Respond in {$language}."
                ],
                [
                    'role' => 'user',
                    'content' => $message
                ],
            ],
        ]);

        // Kiểm tra xem có lỗi không
        if ($response->failed()) {
            throw new \Exception('Error connecting to OpenAI API');
        }

        // Lưu kết quả vào cache
        Cache::put($cacheKey, $response->json(), 300); // Cache kết quả trong 5 phút

        // Trả về kết quả
        return $response->json();
    }
}
