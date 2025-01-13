<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Telegram\Bot\Laravel\Facades\Telegram;


class RegisteredUserController extends Controller
{

    public function store() {
        $email = "peshkov-dv@yandex.ru";
        $name = Auth::user()->name;
        Mail::to($email)->send(new Welcome(Auth::user()));
        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID'),
            'parse_mod' => 'html',
            'text' => "К нам присоединился $name"
        ]);
        return response()->json(['status' => 'success']);

    }

}
