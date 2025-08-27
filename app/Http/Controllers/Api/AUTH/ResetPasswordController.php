<?php

namespace App\Http\Controllers\Api\AUTH;

use App\Http\Controllers\AppBaseController;
use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends AppBaseController
{
    public function passwordupdate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'token' => 'required|string',
            'device_name' => 'required'
        ]);

        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();


        if (!$passwordReset)
        {
            return response()->json(
                [
                    'success' => false,
                    'data'    => [
                        'code' => null,
                    ],
                    'message' => 'Email ou token invalide'
                ],
                200
            );
        }

        $user = User::where('email', $passwordReset->email)->first();
        if (!$user){
            return response()->json(
                [
                    'success' => false,
                    'data'    => [
                        'code' => null,
                    ],
                    'message' => 'Utilisateur inconnu.'
                ],
                200
            );
        }
        $user->connexion =  $user->connexion + 1 ;
        $user->password = bcrypt($request->password);
        $user->save();

        $success['id'] = $user->id;
        $success['code'] = $user->code;
        $success['name'] = $user->name;
        $success['email'] = $user->email;
        $success['telephone'] = $user->telephone;
        $success['profile_photo_url'] = $user->profile_photo_url;
        $success['created_at'] = (string) $user->created_at;
        $success['updated_at'] = (string) $user->updated_at;
        $success['btn_entree'] =  $user->btn_entree;
        $success['btn_debut_pause'] =  $user->btn_debut_pause;
        $success['btn_fin_pause'] =  $user->btn_fin_pause;
        $success['btn_sortie'] =  $user->btn_sortie;
        $success['btn_scan'] =  $user->scan_qrcode;
        $success['fonction_id'] =  (int)$user->fonction_id;
        $success['fonction'] =  $user->fonction->libelle;
        $success['token'] =  $user->createToken($request->device_name)->plainTextToken;
        $success['qr_code'] = $user->imgqrcode();
        return $this->sendResponse($success, 'Success.');
    }
}
