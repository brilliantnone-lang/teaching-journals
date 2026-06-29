<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ReCaptchaService
{
    protected $secretKey;

    public function __construct()
    {
        $this->secretKey = env('RECAPTCHA_SECRET_KEY');
    }

    public function verify($token)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $this->secretKey,
            'response' => $token,
        ]);

        $data = $response->json();
        return isset($data['success']) && $data['success'] === true;
    }
}