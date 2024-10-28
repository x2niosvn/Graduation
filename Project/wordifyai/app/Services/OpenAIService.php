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

    /**
     * Gửi yêu cầu phân tích văn bản.
     *
     * @param string $message
     * @return array
     * @throws \Exception
     */
    public function sendMessageForAnalysis($message)
    {
        // Lấy thông tin ngôn ngữ và mức độ chi tiết từ yêu cầu
        $language = request()->input('language', 'en'); // Mặc định là 'en' nếu không có input
        $detail = request()->input('detail', 'simple'); // Mặc định là 'simple' nếu không có input
    
        // Khởi tạo prompt phân tích
        $analysisPrompt = "
            You are a highly detailed text analysis AI named WordifiAI.
            Please analyze the following text " . ($detail === 'detailed' ? "in great detail" : "") . ":
            1. Main Ideas: " . ($detail === 'detailed' ? "Provide a thorough summary of the key points, themes, and messages presented. Please expand as much as possible, and include supporting details where applicable." : "Provide a summary of the key points, themes, and messages presented.") . "
            2. Type: Identify the type of text (e.g., story, review, article) and " . ($detail === 'detailed' ? "give a detailed explanation of why it falls under this category." : "briefly explain why.") . "
            3. Structure: Analyze the organization of ideas and paragraphs. Are they logically arranged? " . ($detail === 'detailed' ? "Provide an in-depth discussion on how effectively the structure supports the text." : "") . "
            4. Language: " . ($detail === 'detailed' ? "Provide a comprehensive evaluation of the vocabulary, sentence structure, and overall style used in the text. Discuss its effectiveness in detail, providing examples where applicable." : "Evaluate the vocabulary and sentence structure used in the text.") . "
            5. Audience Engagement: " . ($detail === 'detailed' ? "Analyze whether the text is engaging or compelling for its intended audience. Expand on specific elements that contribute to or detract from its engagement." : "Is the text engaging for its intended audience?") . "
            Translate all responses to {$language}." . ($detail === 'detailed' ? " Provide the longest and most detailed analysis possible." : "");
        
        // Gửi yêu cầu đến API để phân tích
        $response = $this->sendRequest($language, $message, $analysisPrompt);
        
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
         // Lấy thông tin ngôn ngữ và mức độ chi tiết từ yêu cầu
         $language = request()->input('language', 'en'); // Mặc định là 'en' nếu không có input
         $detail = request()->input('detail', 'simple'); // Mặc định là 'simple' nếu không có input
     
         // Khởi tạo prompt đánh giá
         $evaluationPrompt = "
             You are an expert-level text evaluation AI named WordifyAI.
             Please evaluate the following text " . ($detail === 'detailed' ? "in great depth" : "") . ":
             1. Structure and Coherence: " . ($detail === 'detailed' ? "Analyze in detail the logical organization and flow of ideas. Discuss whether the transitions are smooth and how effectively the structure supports the text. Please provide as much insight as possible." : "Provide a brief analysis of the logical organization and flow of ideas.") . "
             2. Clarity and Precision: " . ($detail === 'detailed' ? "Assess the clarity and precision of the language used. Identify any vague or ambiguous terms, and explain how this affects the overall quality." : "Assess the clarity and precision of the language used.") . "
             3. Tone: " . ($detail === 'detailed' ? "Thoroughly evaluate the tone and its appropriateness for the intended audience. Explain why the tone works or doesn’t work, and suggest improvements if necessary." : "Evaluate the tone and its appropriateness for the intended audience.") . "
             4. Engagement: " . ($detail === 'detailed' ? "Discuss whether the text captures and maintains interest. Analyze the specific techniques used for engagement and comment on their effectiveness for the audience." : "Discuss whether the text engages the audience.") . "
             5. Originality: " . ($detail === 'detailed' ? "Provide a detailed assessment of the creativity and originality of the text. Discuss whether the text stands out or follows conventional patterns." : "Briefly assess the creativity and originality of the text.") . "
             Translate all responses to {$language}." . ($detail === 'detailed' ? " Provide the longest and most detailed evaluation possible." : "");
         
         // Gửi yêu cầu đến API để đánh giá
         $response = $this->sendRequest($language, $message, $evaluationPrompt);
         
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


        // Thiết lập timeout cho yêu cầu
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->timeout(30)->post("{$this->baseUrl}/chat/completions", [ // timeout 
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


        // Trả về kết quả
        return $response->json();
    }
}
