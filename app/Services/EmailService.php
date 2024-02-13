<?php

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class EmailService {
    public function sendPasswordResetLink($user, $token) {
        $subject = "Votre lien de réinitialisation de mot de passe";
        $view = "auth.password-reset";
        $data = ['token' => $token];

        Mail::send($view, $data, function ($message) use ($user, $subject) {
            $message->to($user->email);
            $message->subject($subject);
        });
    }
}
