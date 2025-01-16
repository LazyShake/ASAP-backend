<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function submitFeedback(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Логика обработки, например, сохранение в БД или отправка письма
        // Mail::to('admin@example.com')->send(new FeedbackMail($validated));

        return back()->with('success', 'Спасибо! Мы свяжемся с вами в ближайшее время.');
    }

    public function submitPhone(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|phone:RU',
        ]);

        // Логика обработки, например, сохранение в БД или отправка письма
        // Mail::to('admin@example.com')->send(new PhoneFeedbackMail($validated));

        return back()->with('success', 'Спасибо! Мы свяжемся с вами в ближайшее время.');
    }
}
