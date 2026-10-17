<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Captcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $expected = session('captcha_answer');

        if (!$expected || (int) $value !== (int) $expected) {
            $fail('Jawaban captcha salah. Silakan coba lagi.');
        }

        // Hapus captcha setelah dipakai (sekali pakai)
        session()->forget('captcha_answer');
    }
}