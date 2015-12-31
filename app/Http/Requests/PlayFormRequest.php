<?php

namespace App\Http\Requests;

use App\Play;
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
            'src_data' => 'required',
            'res_data' => 'required',
            'res_litho' => 'required',
            'res_formation' => 'required',
            'res_age_period' => 'required',
            'res_age_epoch' => 'required',
            'res_dep_env' => 'required',
            'trp_data' => 'required',
            'trp_type' => 'required',
            'dyn_data' => 'required'
        ];
    }
}
