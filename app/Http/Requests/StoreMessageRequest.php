<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'surname' => ['nullable'],
            'email' => ['required'],
            'description' => ['required', 'max:500'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'E` necessario inserire un nome',
            'email.required' => 'E` necessario inserire una mail di riconoscimento',
            'description.required' => 'Compilare la sezione di messaggio',
            'description.max' => 'Il testo non deve superare i 500 caratteri, è possibile inviare più messaggi consecutivamente se necessario'
        ];
    }
}
