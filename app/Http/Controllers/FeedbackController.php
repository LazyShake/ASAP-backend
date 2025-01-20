<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use GuzzleHttp\Client;

class FeedbackController extends Controller
{
    public function submitFeedback(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|regex:/^\+?[0-9]{10,15}$/',
                'message' => 'required|string',
            ]);

            // Отправка данных в Telegram
            $this->sendToTelegram([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'message' => $validated['message'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Спасибо! Мы свяжемся с вами в ближайшее время.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $this->translateErrors($e->errors()),
            ], 422);
        }
    }

    public function submitPhone(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|regex:/^\+?[0-9]{10,15}$/',
            ]);

            // Отправка данных в Telegram
            $this->sendToTelegram([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Спасибо! Мы свяжемся с вами в ближайшее время.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $this->translateErrors($e->errors()),
            ], 422);
        }
    }

    /**
     * Отправка сообщения в Telegram
     */
    private function sendToTelegram(array $data)
    {
        $botToken = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id');

        $message = "Новое обращение:\n";
        foreach ($data as $key => $value) {
            $message .= ucfirst($key) . ": " . $value . "\n";
        }

        $client = new Client();
        $client->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
            ],
        ]);
    }

    /**
     * Перевод ошибок валидации на русский язык
     */
    private function translateErrors(array $errors)
    {
        $translated = [];
        foreach ($errors as $field => $messages) {
            foreach ($messages as $message) {
                $translated[$field][] = $this->translateMessage($field, $message);
            }
        }
        return $translated;
    }

    /**
     * Перевод конкретного сообщения об ошибке
     */
    private function translateMessage($field, $message)
    {
        $translations = [
            'name' => 'Поле имя',
            'phone' => 'Поле телефон',
            'message' => 'Поле сообщение',
            'required' => 'обязательно для заполнения',
            'string' => 'должно быть строкой',
            'max' => 'превышает допустимую длину',
            'regex' => 'имеет неверный формат',
        ];

        // Переводим стандартные ключи
        foreach ($translations as $key => $translation) {
            $message = str_replace($key, $translation, $message);
        }

        return $message;
    }
}
