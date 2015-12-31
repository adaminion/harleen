<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PlayFormRequest extends Request
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
        return [
            'basin_name' => 'sometimes|required',
            'province_name' => 'required',
            'analog_to' => 'required',
            'analog_distance' => 'required',
            'shore' => 'required',
            'terrain' => 'required',
            'nearby_field' => 'required',
            'nearby_infra' => 'required',
            'update_reason' => 'sometimes|required',
            'delete_reason' => 'sometimes|required',
        ];
    }
}
