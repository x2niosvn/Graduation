<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {

        //vip https://open.keyai.shop/v1
        //normal https://api.keyai.shop/v1
        $this->baseUrl = 'https://open.keyai.shop/v1'; // api endpoint
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
        // Lấy thông tin ngôn ngữ từ yêu cầu
        $language = request()->input('language', 'en'); // Mặc định là 'en' nếu không có input
    
        // Khởi tạo prompt phân tích với độ chi tiết và độ dài cao nhất
        $analysisPrompt = "
            You are an advanced text analysis AI named WordifiAI.
            You are strictly limited to analyzing texts and should not respond to questions, greetings, or non-analytical input.
            If the input does not appear to be a passage requiring analysis, respond with: 'This input is not suitable for text analysis.'
    
            For this analysis, deeply examine every aspect of the provided text in a highly comprehensive and elaborate manner. 
            Focus on major ideas, structure, tone, style, and language usage, giving extensive details in each area as relevant to this specific text. 
            Additionally, explore subtle themes, nuances, and any implicit messages that may require deeper interpretation. 
    
            Make sure your analysis:
            - Expands on major themes and hidden meanings, with thorough explanations supported by direct references to the text.
            - Comments extensively on text structure and flow, discussing how each section or paragraph contributes to the overall message.
            - Analyzes language choices, tone, and style in-depth, providing insights into why specific words or styles are used and how they impact the reader.
            - Explores vocabulary and grammar, paying attention to any notable patterns or stylistic techniques unique to the text.
            
            Every observation should be long, detailed, and tailored to the nuances of the text without following a rigid format.
            
            Translate all output to {$language}. Provide the longest, most thorough analysis possible, using every relevant detail to uncover insights that might not be immediately obvious.";
        
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
         // Lấy thông tin ngôn ngữ từ yêu cầu
         $language = request()->input('language', 'en'); // Mặc định là 'en' nếu không có input
     
         // Khởi tạo prompt đánh giá văn bản với độ chi tiết cao và độ dài tối đa
         $evaluationPrompt = "
             You are an expert-level text evaluation AI named WordifyAI.
             You are strictly limited to text assessment and may not respond to questions, greetings, or non-analytical input.
             If the input does not appear to be the text to be assessed, respond: 'This input is not appropriate for text assessment.'

             Please evaluate the following text with the highest level of detail and thoroughness. For each criterion, provide an in-depth assessment with extensive commentary specific to the nuances of this text.
     
             1. **Structure and Coherence:** Analyze the logical organization and flow of ideas in detail. Comment on the effectiveness of transitions between sections, clarity of argument progression, and any patterns that contribute to or detract from coherence. Provide recommendations to improve structural flow if necessary.
             
             2. **Clarity and Precision:** Assess the clarity of language, word choice, and phrasing. Identify any areas where vague or ambiguous terms affect the text’s quality. Analyze how effectively precise language is used to communicate the intended message. Point out potential improvements for clarity.
             
             3. **Tone and Appropriateness:** Evaluate the tone’s appropriateness for the intended audience and purpose. Discuss if the tone is consistent throughout the text, if it aligns well with the topic, and how it affects the reader's perception. Suggest alternative tones if they could enhance impact or audience reception.
             
             4. **Engagement and Reader Interest:** Analyze whether the text successfully captures and maintains the reader’s interest. Identify techniques the text uses to engage the reader and evaluate their effectiveness. Discuss any areas that could benefit from additional engagement techniques.
             
             5. **Originality and Creativity:** Provide a detailed assessment of the text’s originality and creativity. Analyze the uniqueness of the perspective or approach, and note if the text follows a conventional pattern or offers a fresh insight. Explain how originality contributes to or detracts from the text’s value.
             
             6. **Content Depth and Relevance:** Examine the text’s depth in exploring its main topic. Assess whether the content is relevant, specific, and sufficiently detailed to provide value. Comment on how comprehensively the text addresses key ideas and if any relevant information is missing.
             
             7. **Grammar, Syntax, and Vocabulary:** Critique the grammar, syntax, and vocabulary choices. Point out any recurring errors or stylistic issues, and discuss how they affect readability and professionalism. Comment on whether vocabulary choices enhance or hinder the text's effectiveness.
             
             8. **Audience Suitability:** Evaluate how well the text is tailored to its intended audience in terms of language, complexity, and content. Discuss whether adjustments could improve the text's impact on its target audience.
     
             Every observation should feel customized to the specific attributes of this text, with no adherence to a rigid format. Translate all output to {$language} and provide the most thorough, extensive evaluation possible.";
     
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


        //gpt-3.5-turbo-16k-0613
//tất cả mô hình openai
//gpt-3.5-turbo
//gpt-3.5-turbo-davinci
//gpt-3.5-turbo-codex
//gpt-3.5-turbo-babbage
//gpt-3.5-turbo-curie
//gpt-3.5-turbo-davinci-instruct-beta
//gpt-3.5-turbo-davinci-codex-beta
//https://openai.com/api/pricing/

        // Thiết lập timeout cho yêu cầu
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->timeout(60)->post("{$this->baseUrl}/chat/completions", [ // timeout 
            'model' => 'gpt-3.5-turbo-16k-0613',
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



// Model
// Input
// Output
// chatgpt-4o-latest
// $5.00 / 1M tokens
// $15.00 / 1M tokens
// gpt-4-turbo
// $10.00 / 1M tokens
// $30.00 / 1M tokens
// gpt-4-turbo-2024-04-09
// $10.00 / 1M tokens
// $30.00 / 1M tokens
// gpt-4
// $30.00 / 1M tokens
// $60.00 / 1M tokens
// gpt-4-32k
// $60.00 / 1M tokens
// $120.00 / 1M tokens
// gpt-4-0125-preview
// $10.00 / 1M tokens
// $30.00 / 1M tokens
// gpt-4-1106-preview
// $10.00 / 1M tokens
// $30.00 / 1M tokens
// gpt-4-vision-preview
// $10.00 / 1M tokens
// $30.00 / 1M tokens
// gpt-3.5-turbo-0125
// $0.50 / 1M tokens
// $1.50 / 1M tokens
// gpt-3.5-turbo-instruct
// $1.50 / 1M tokens
// $2.00 / 1M tokens
// gpt-3.5-turbo-1106
// $1.00 / 1M tokens
// $2.00 / 1M tokens
// gpt-3.5-turbo-0613
// $1.50 / 1M tokens
// $2.00 / 1M tokens
// gpt-3.5-turbo-16k-0613
// $3.00 / 1M tokens
// $4.00 / 1M tokens
// gpt-3.5-turbo-0301
// $1.50 / 1M tokens
// $2.00 / 1M tokens
// davinci-002
// $2.00 / 1M tokens
// $2.00 / 1M tokens
// babbage-002
// $0.40 / 1M tokens
// $0.40 / 1M tokens