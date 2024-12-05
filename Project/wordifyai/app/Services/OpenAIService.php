<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'https://open.keyai.shop/v1';
        $this->apiKey = config('services.openai.api_key');
    }

    public function sendMessageForAnalysis($message)
    {
        $language = request()->input('language', 'en');
        $model_using = $this->getModel(request()->input('ai_model', '1'));

        $analysisPrompt = "
            You are an advanced text analysis AI named WordifiAI. Using natural language for analysis.
            For this analysis, deeply examine every aspect of the provided text in a highly comprehensive and elaborate manner. 
            Focus on major ideas, structure, tone, style, and language usage, giving extensive details in each area as relevant to this specific text. 
            Additionally, explore subtle themes, nuances, and any implicit messages that may require deeper interpretation. 
            Conduct a comprehensive and detailed analysis of the text below, expanding on the ideas in a flexible and creative way, and providing as in-depth and detailed feedback as possible. In your analysis, highlight the following elements:
            Explore the main ideas and underlying meanings, explaining them clearly and in-depth, using direct evidence from the text to illustrate. Focus on how small details contribute to the overall picture.
            Consider the organization and flow of each section or paragraph. Clarify how they connect and contribute to the main message, and highlight the cohesion between different sections.
            Dig into the choices of words, images, and diction. Explain the impact these elements have on the reader and why the author may have chosen that style.
            Comment on sentence patterns, special word usage, or notable grammatical techniques. Clarify how these elements highlight the uniqueness of the text.
            Give multi-dimensional analysis, do not be constrained by a template, but instead be flexible in changing your approach depending on the content and context of the text. Answer as deeply and as long as possible, without limiting the length or number of details provided.
            Every observation should be long, detailed, and tailored to the nuances of the text without following a rigid format.
            Translate all output to {$language}. Provide the longest, most thorough analysis possible, using every relevant detail to uncover insights that might not be immediately obvious.";

        return $this->sendRequest($model_using, $language, $message, $analysisPrompt);
    }

    public function sendMessageForEvaluation($message)
    {
        $language = request()->input('language', 'en');
        $model_using = $this->getModel(request()->input('ai_model', '1'));

        $evaluationPrompt = "
            You are an expert-level text evaluation AI named WordifyAI. Using natural language for evaluation.
            Please evaluate the following text with the highest level of detail and thoroughness. For each criterion, provide an in-depth assessment with extensive commentary specific to the nuances of this text.
            Analyze the logical organization and flow of ideas in detail. Comment on the effectiveness of transitions between sections, clarity of argument progression, and any patterns that contribute to or detract from coherence. Provide recommendations to improve structural flow if necessary.
            Assess the clarity of language, word choice, and phrasing. Identify any areas where vague or ambiguous terms affect the text’s quality. Analyze how effectively precise language is used to communicate the intended message. Point out potential improvements for clarity.
            Evaluate the tone’s appropriateness for the intended audience and purpose. Discuss if the tone is consistent throughout the text, if it aligns well with the topic, and how it affects the reader's perception. Suggest alternative tones if they could enhance impact or audience reception.
            Analyze whether the text successfully captures and maintains the reader’s interest. Identify techniques the text uses to engage the reader and evaluate their effectiveness. Discuss any areas that could benefit from additional engagement techniques.
            Provide a detailed assessment of the text’s originality and creativity. Analyze the uniqueness of the perspective or approach, and note if the text follows a conventional pattern or offers a fresh insight. Explain how originality contributes to or detracts from the text’s value.
            Examine the text’s depth in exploring its main topic. Assess whether the content is relevant, specific, and sufficiently detailed to provide value. Comment on how comprehensively the text addresses key ideas and if any relevant information is missing.
            Critique the grammar, syntax, and vocabulary choices. Point out any recurring errors or stylistic issues, and discuss how they affect readability and professionalism. Comment on whether vocabulary choices enhance or hinder the text's effectiveness.
            Evaluate how well the text is tailored to its intended audience in terms of language, complexity, and content. Discuss whether adjustments could improve the text's impact on its target audience.
            Every observation should feel customized to the specific attributes of this text, with no adherence to a rigid format. Translate all output to {$language} and provide the most thorough, extensive evaluation possible.";

        return $this->sendRequest($model_using, $language, $message, $evaluationPrompt);
    }

    protected function sendRequest($model_using, $language, $message, $systemMessage)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
        ])->timeout(60)->post("{$this->baseUrl}/chat/completions", [
            'model' => $model_using,
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

        if ($response->failed()) {
            throw new \Exception('Error connecting to OpenAI API');
        }

        return $response->json();
    }

    protected function getModel($model)
    {
        $models = [
            '1' => 'gpt-3.5-turbo-16k-0613',
            '2' => 'gpt-3.5-turbo-0613',
            '3' => 'gpt-3.5-turbo-1106',
            '4' => 'gpt-3.5-turbo-instruct',
            '5' => 'gpt-3.5-turbo-0125',
            '6' => 'davinci-002',
            '7' => 'gpt-4o-mini',
        ];

        return $models[$model] ?? 'gpt-3.5-turbo-16k-0613';
    }
}
