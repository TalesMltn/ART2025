<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
{
    $userId = Auth::id();

    $conversationUserIds = Message::where('sender_id', $userId)
        ->orWhere('receiver_id', $userId)
        ->select('sender_id', 'receiver_id')
        ->distinct()
        ->get()
        ->map(fn($msg) => $msg->sender_id == $userId ? $msg->receiver_id : $msg->sender_id)
        ->unique();

    $conversations = [];
    foreach ($conversationUserIds as $otherUserId) {
        $lastMessage = Message::where(function ($q) use ($userId, $otherUserId) {
                $q->where('sender_id', $userId)->where('receiver_id', $otherUserId);
            })
            ->orWhere(function ($q) use ($userId, $otherUserId) {
                $q->where('sender_id', $otherUserId)->where('receiver_id', $userId);
            })
            ->latest()
            ->first();

        if ($lastMessage) {
            $otherUser = $lastMessage->sender_id == $userId 
                ? $lastMessage->receiver 
                : $lastMessage->sender;

            $conversations[] = [
                'user' => $otherUser,
                'last_message' => $lastMessage,
                'unread_count' => Message::where('sender_id', $otherUserId)
                    ->where('receiver_id', $userId)
                    ->whereNull('read_at') // ← AHORA EXISTE
                    ->count()
            ];
        }
    }

    return view('messages.index', compact('conversations'));
}

    // Mostrar formulario
    public function showSendForm($id)
    {
        $artisan = User::findOrFail($id)->artisan;
        if (!$artisan) {
            abort(404, 'Artesano no encontrado');
        }
        return view('messages.send', compact('artisan'));
    }

    // Enviar mensaje
    public function send(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);
    
        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $id,
            'content' => $request->content,
            'read_at' => null // ← CORRECTO
        ]);
    
        return redirect()->route('messages.index')
            ->with('success', '¡Mensaje enviado con éxito!');
    }
}