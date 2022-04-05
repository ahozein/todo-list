<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;

class UserController extends Controller
{
    public const SUCCESS_STATUS = 200;
    public const UNAUTHORIZED_STATUS = 401;

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['name'] = $user->name;
            $success['token'] = $user->createToken('MyTodoList')->accessToken;

            return response()->json(['success' => $success], self::SUCCESS_STATUS);
        } else
            return response()->json(['error' => 'Unauthorised'], self::UNAUTHORIZED_STATUS);
    }

    public function register(RegisterRequest $request)
    {
        if (isset($request->validator) && $request->validator->fails())
            return response()->json($request->validator->messages(), self::UNAUTHORIZED_STATUS);

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        $success['name'] = $user->name;
        $success['token'] = $user->createToken('MyTodoList')->accessToken;

        return response()->json(['success' => $success], self::SUCCESS_STATUS);
    }
}
