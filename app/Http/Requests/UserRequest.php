<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user=User::where('username',$this->route('user'))->first();
        return $this->user()->can('update',$user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'=>['required',Rule::unique('users','name')->ignore(user()),'alpha_dash','string','max:255'],
            'name'=>'required|alpha_dash',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

  
}
