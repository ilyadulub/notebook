<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $noteId = Route::current()->originalParameter('note');

        return [
            'full_name' => [
                'required',
                'string',
                'max:150',
            ],
            'company' => [
                'nullable',
                'string',
                'max:50',
            ],
            'phone' => [
                'required',
                'digits:10',
                'unique:notes,phone,' . $noteId,
            ],
            'email' => [
                'required',
                'email:rfc',
                'max:50',
                'unique:notes,email,' . $noteId,
            ],
            'birthday' => [
                'nullable',
                'date',
            ],
            'photo_file' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
                'dimensions:max_width=200,max_height=200',
            ],
        ];
    }
}
