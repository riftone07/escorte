<?php

namespace App\Http\Controllers\Api\AUTH;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthAPIController extends BaseController
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        $user = User::where('email', $request->email)->orWhere('telephone',$request->email)->first();


        if (! $user || ! Hash::check($request->password, $user->password)) {
            return $this->sendError('Non autorisé.', ['error'=>"Les informations d'identification fournies sont incorrectes."]);
        }

        $userResource = new UserResource($user);

        $userData = $userResource->toArray($request);

        $userData['token'] = $user->createToken($request->device_name)->plainTextToken;


        return $this->sendResponse($userData, 'Success.');
    }

    public function loginnumber(Request $request)
    {
        $request->validate([
            'telephone' => 'required',
            'device_name' => 'required'
        ]);
        $email = 'private'.uniqid().time()."@innovebox.com";
        $code = rand(1000, 9999);
        $user =  User::updateOrCreate(
            ['telephone' => $request->telephone],
            [
                'name' => "innovebox",
                'code' => $code,
                'device_name' => $request->device_name,
                'email' => $email,
                'password' => Hash::make('Passer123@123#')
            ]
        );
        $success['code'] = $user->code;
        $success['name'] = $user->name;
        $success['email'] = $user->email;
        $success['telephone'] = $user->telephone;
        $success['profile_photo_url'] = $user->profile_photo_url;
        $success['created_at'] = (string) $user->created_at;
        $success['updated_at'] = (string) $user->updated_at;
        $success['token'] =  $user->createToken($request->device_name)->plainTextToken;
        return $this->sendResponse($success, 'Success.');
    }


    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required|string|min:2',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $user = User::create($input);

        $userResource = new UserResource($user);

        $userData = $userResource->toArray($request);

        $userData['token'] = $user->createToken($request->device_name)->plainTextToken;


        return $this->sendResponse($userData, 'Success.');
    }


}
