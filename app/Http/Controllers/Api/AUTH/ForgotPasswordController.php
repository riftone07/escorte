<?php

namespace App\Http\Controllers\Api\AUTH;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use App\Notifications\ReinitialisationMotDePasseNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class ForgotPasswordController extends AppBaseController
{
    protected function sendResetLinkResponse(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
        ]);
        $user = User::whereEmail($request->email)->first();
        $success['code'] = null;
        if (empty($user)) {
            return $this->sendResponse($success, "Aucun utilisateur n'a été trouvé avec cette adresse email.");
        }

        $code = rand(10000,99999);
        $token = Str::random(60);
        $passwordReset = PasswordReset::firstOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => $token
            ]
        );

        Notification::send($user, new ReinitialisationMotDePasseNotification($code));
        $success['code'] = $code;
        $success['token'] = $passwordReset->token;


        return $this->sendResponse($success, "Nous vous avons envoyé par email le code de réinitialisation du mot de passe !");
    }
}
