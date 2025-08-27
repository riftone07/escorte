<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    /**
     * Enregistre un nouveau device token pour l'utilisateur authentifié
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'device_id' => 'nullable|string',
            'device_type' => 'required|string|in:android,ios,web',
            'device_name' => 'nullable|string',
            'app_version' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();
        
        // Vérifier si le token existe déjà
        $device = Device::where('token', $request->token)->first();
        
        if ($device) {
            // Mettre à jour le device existant
            $device->update([
                'user_id' => $user->id,
                'device_id' => $request->device_id,
                'device_type' => $request->device_type,
                'device_name' => $request->device_name,
                'app_version' => $request->app_version,
                'last_active_at' => now(),
                'is_active' => true,
            ]);
        } else {
            // Créer un nouveau device
            $device = Device::create([
                'user_id' => $user->id,
                'token' => $request->token,
                'device_id' => $request->device_id,
                'device_type' => $request->device_type,
                'device_name' => $request->device_name,
                'app_version' => $request->app_version,
                'last_active_at' => now(),
                'is_active' => true,
            ]);
        }

        return response()->json([
            'message' => 'Device enregistré avec succès',
            'device' => $device
        ]);
    }

    /**
     * Désactive un device token
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unregister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Auth::user();
        
        // Désactiver le device
        $device = Device::where('token', $request->token)
            ->where('user_id', $user->id)
            ->first();
            
        if ($device) {
            $device->update([
                'is_active' => false
            ]);
            
            return response()->json([
                'message' => 'Device désactivé avec succès'
            ]);
        }
        
        return response()->json([
            'message' => 'Device non trouvé'
        ], 404);
    }
}
