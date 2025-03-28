<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SaveUserSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Set the attributes aliases
     * 
     * @return array<string>
     */
    public function messages(): array
    {
        return [
            'username' => [
                'required' => 'Name is required',
                'regex' => 'Your can only contain characters from A to Z, numbers from 0 to 0, hyphens and underscores',
            ],
            'biography' => [
                'max' => 'Your biography can\'t be bigger than 300 characters long.',
            ],
            'name' => [
                'required' => 'Username is required',
                'unique' => 'That username is already taken',
                'max' => 'Your username can\'t be bigger than 30 characters long.',
                'regex' => 'Your username can only contain characters from A to Z, numbers from 0 to 9 and underscores.'
            ],
            'email' => [
                'required' => 'Email is required',
                'unique' => 'That email is already taken',
                'email' => 'Must be a valid email',
            ],
            // 'password' => [
            //     'required' => 'Password is required',
            //     'min' => 'Your password must be at least 8 characters long.'
            // ]
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {   
        $user = Auth::user();

        return [
            'username' => 'required|max:30|regex:/^[a-zA-Z0-9_\-\s]+$/',
            'biography' => 'max:300',
            'private' => 'bool',
            'name' => 'required|unique:users,name,' . $user->id . '|max:30|regex:/^[a-zA-Z0-9_]+$/',
            'email' => 'required|unique:users,email,' . $user->id . '|email',
            // 'password' => 'required|min:8',
        ];
    }
}
