<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Propaganistas\LaravelPhone\Rules\Phone;


class FeedbackController extends Controller
{
    public function submitPhone(Request $request)
    {
        try {
            // Валидация данных
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => ['required', new Phone('RU')],  // RU — это код страны для России
            ]);
            

            // Формируем сообщение для Telegram
            $message = "📩 *Новая заявка:*\n";
            $message .= "👤 *Имя:* {$validated['name']}\n";
            $message .= "📞 *Телефон:* {$validated['phone']}";

            // Отправляем данные в Telegram
            $this->sendToTelegram($message);

            return response()->json([
                'success' => true,
                'message' => 'Спасибо! Мы свяжемся с вами в ближайшее время.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $this->translateErrors($e->errors()),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Не удалось отправить данные. Попробуйте позже.',
            ], 500);
        }
    }

    /**
     * Отправка сообщения в Telegram
     */
    private function sendToTelegram(string $message)
    {
        $botToken = config('services.telegram.bot_token');
        $chatId = config('services.telegram.chat_id');

        if (!$botToken || !$chatId) {
            Log::error('Телеграм-бот: Не указан токен или chat_id.');
            throw new \Exception('Ошибка отправки в Telegram.');
        }

        try {
            $client = new Client();
            $response = $client->post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'form_params' => [
                    'chat_id' => $chatId,
                    'text' => $message,
                    'parse_mode' => 'Markdown',
                ],
            ]);

            $body = json_decode($response->getBody(), true);

            if (!$body['ok']) {
                throw new \Exception('Ошибка отправки в Telegram: ' . $body['description']);
            }

            Log::info('Телеграм-бот: сообщение успешно отправлено.');
        } catch (\Exception $e) {
            Log::error('Ошибка отправки в Telegram: ' . $e->getMessage());
            throw new \Exception('Ошибка отправки в Telegram.');
        }
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
            'required' => 'обязательно для заполнения',
            'string' => 'должно быть строкой',
            'max' => 'превышает допустимую длину',
            'regex' => 'имеет неверный формат',
        ];

        foreach ($translations as $key => $translation) {
            $message = str_replace($key, $translation, $message);
        }

        return $message;
    }
}
