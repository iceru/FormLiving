<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI;

class homeAssistantChatController extends Controller
{
    private $openai;
    private $conversationHistory;

    public function __construct()
    {
        $this->openai = OpenAI::client(env('OPENAI_API_KEY'));
        $this->conversationHistory = [
            ["role" => "developer", "content" => "You are a helpful assistant for a housing company."],
            ["role" => "developer", "content" => "Do not give calculations. Give normal format. Just give final answers"],
            ["role" => "developer", "content" => "Try to answer first. Do not ask question without giving answer."],
            ["role" => "developer", "content" => "If user ask for credit simulation, gives estimated number for down payment, duration, BI rate, and monthly payment."],
            ["role" => "developer", "content" => json_encode($this->loadHousingData())]
        ];
    }

    private function loadHousingData()
    {
        $dataPath = storage_path('app/greenland_tidar_data.json');
        return json_decode(file_get_contents($dataPath), true);
    }

    private function askGpt($messages)
    {
        try {
            $response = $this->openai->chat()->create([
                'model' => 'gpt-4-turbo',
                'messages' => $messages,
                'temperature' => 0.5,
            ]);
            return $response['choices'][0]['message']['content'];
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function chat(Request $request)
    {
        $userQuestion = $request->input('message');

        if (in_array(strtolower($userQuestion), ['keluar', 'exit', 'quit'])) {
            return response()->json(['response' => 'Terima kasih telah menggunakan Virtual Assistant Greenland Tidar. Sampai jumpa!']);
        }

        $this->conversationHistory[] = ["role" => "user", "content" => $userQuestion];
        $gptResponse = $this->askGpt($this->conversationHistory);
        $this->conversationHistory[] = ["role" => "assistant", "content" => $gptResponse];

        return response()->json(['response' => $gptResponse]);
    }
}
