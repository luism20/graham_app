<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class PlansFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'nullable|string|min:0|max:250',
            'stripe_id' => 'nullable',
            'amount' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'interval' => 'nullable|string|min:0|max:50',
            'description' => 'nullable|string|min:0|max:22',
        ];

        return $rules;
    }
    
    /**
     * Get the request's data from the request.
     *
     * 
     * @return array
     */
    public function getData()
    {
        $data = $this->only(['name', 'stripe_id', 'amount', 'interval', 'description']);

        return $data;
    }

}