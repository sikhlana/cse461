<?php

namespace App\Http\Requests\Dashboard;

use App\Faculty;
use Illuminate\Foundation\Http\FormRequest;

class AccountSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() instanceof Faculty;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'nullable|string|confirmed',
        ];
    }
}
