<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotController extends Controller
{
    public function forgot(Request $request)
    {
        $rules = [
            'email' => 'required|email',
        ];
        $this->validate($request, $rules);

        $email = $request->email;

        if (User::where('email', $email)->doesntExist()) {
            return response()->json(['message' => 'User does not exist'], 404);
        }

        $token = User::generarVerificationToken();

        try {
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token
            ]);


            // Send Email
            Mail::send('Mails.forgot', ['token' => $token], function($message) use ($email){
                $message->to($email);
                $message->subject('Reset your password');
            });

            return response()->json(['message' => 'Check your email '], 200);

        } catch (\Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 400);
        }

    }

    public function reset(Request $request){
        $rules = [
            'token' => 'required',
            'password' => 'required|confirmed',
        ];
        $this->validate($request, $rules);

        $token = $request->token;

        if (!$passwordResets = DB::table('password_resets')->where('token', $token)->first() ) {
            return response()->json(['message' => 'Invalid Token'], 400);
        }

        if (!$user = User::where('email', $passwordResets->email)->first() ) {
            return response()->json(['message' => 'User does not exist!'], 404);
        }

        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['message' => 'Contraseña Actualizada'], 201);


    }

}
