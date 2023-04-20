<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements Rule
{
    public function __construct()
    {

    }

    // Validate the submission.
    public function passes($attribute, $value)
    {
        // Sends a post request to reCAPTCHA.
        $url = 'https://www.google.com/recaptcha/api/siteverify';

        $captcha = Http::asForm()->post($url, [
            'secret' => config('services.recaptcha.secret_key'),
            'response' => $value
        ]);

        // Check if the response was successful and if the score is above the threshold.
        return ($captcha->successful() && $captcha->json('success') && $captcha->json('score') > config('services.recaptcha.threshold'));
    }

    // Error message.
    public function message()
    {
        return 'Captcha failed.';
    }
}
