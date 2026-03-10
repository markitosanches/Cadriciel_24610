<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use Inertia\Inertia;
use App\Events\MessageNotification;

class ChatsController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index() {
        $messages = Message::with('user')->get();
        return Inertia::render('Chat', compact('messages'));
    }

    public function fetchMessages() {
        return Message::with('user')->get();
    }

    public function store(Request $request) {
        $user = Auth::user();
        $message = $user->messages()->create([
            'message' => $request->message
        ]);
        
        broadcast(new MessageNotification($user, $message))->toOthers();
        return Message::with('user')->get();

    }


}
