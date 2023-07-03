<?php

namespace Modules\Package\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required',
            'number_of_days' => 'required',
            'number_of_clients' => 'required',
            'image' => 'traveling_date',
            'image' => 'return_date',
            'meeting_time' => 'required',
            'departure_time' => 'required',
            'price_includes' => 'required',
            'title' => 'required',
            'description' => 'required',
            'traveling_location' => 'required',
            'type_of_rooms' => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
