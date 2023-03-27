<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
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
            'title' => ['required', 'unique:apartments', 'max:100'],
            'user_id' => ['nullable', 'exists:users,id'],
            'n_room' => ['required'],
            'n_bed' => ['required'],
            'n_bathroom' => ['required'],
            'mq' => ['nullable'],
            'image' => ['nullable', 'image'],
            'latitude' => ['required'],
            'longitude' => ['required'],
            'services' => ['nullable', 'exists:services,id'],
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.unique' => 'Questo titolo è già esistente',
            'title.max' => 'Il titolo può essere lungo al massimo :max caratteri.',
            'n_bed.required' => 'Il numero di letti è obbligatorio',
            'n_room.required' => 'Il numero di stanze è obbligatorio',
            'n_bathroom.required' => 'Il numero di bagni è obbligatorio',
            'image.image' => 'Inserire un formato di immagine valido',
            'latitude.required' => 'la posizione è obbligatoria',
            'longitude.required' => 'la posizione è obbligatoria',
        ];
    }
}
