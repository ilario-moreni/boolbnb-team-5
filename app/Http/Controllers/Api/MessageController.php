<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;

class MessageController extends Controller
{
    public function index(StoreMessageRequest $request)
    {
        $form_data = $request->validated();

        $newMessage = new Message();
        /* $newMessage->apartment_id = $form_data->apartment_id;
        $newMessage->name = $form_data->name;
        $newMessage->surname = $form_data->surname;
        $newMessage->email = $form_data->email;
        $newMessage->description = $form_data->message; */
        $newMessage->apartment_id = $request->apartment_id;
        $newMessage->fill($form_data);
        $newMessage->save();

        return response()->json([
            'success' => true,
            'message' => 'messaggio inviato con successo',
            'apartment_id' => $form_data
        ]);
    }
}
