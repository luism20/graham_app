<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UsersFormRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = [
            'name' => 'required|string|min:1|max:255',
            'email' => ['required'],
            'password' => 'required|string|min:1|max:255|required_with:password2|same:password2',
            'password2' => 'required|string|min:1|max:255',
        ];
        
        if ($this->route()->getAction()['as'] == 'users.user.store')
            array_push($rules['email'], 'unique:users');

        return $rules;
    }

    public function attributes() {
        return [
            'password' => 'password',
            'password2' => 'confirm password',
        ];
    }

    /**
     * Get the request's data from the request.
     *
     *
     * @return array
     */
    public function getData() {
        $data = $this->only(['name', 'email', 'password', 'password2', 'rol', 'company']);
        return $data;
    }

}
