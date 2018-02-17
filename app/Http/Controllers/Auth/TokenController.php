<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TokenController extends Controller
{
    public function regenerate()
    {
        $user = auth()->user();
        $user->update(['api_token' => (string) \Uuid::generate(4)]);

        return redirect()->route('home');
    }
}
