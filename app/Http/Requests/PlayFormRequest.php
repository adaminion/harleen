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
            'play.basin_name' => 'sometimes|required',
            'play.province_name' => 'required',
            'play.analog_to' => 'required',
            'play.analog_distance' => 'required',
            'play.shore' => 'required',
            'play.terrain' => 'required',
            'play.nearby_field' => 'required',
            'play.nearby_infra' => 'required',
            'play.update_reason' => 'sometimes|required',
            'play.delete_reason' => 'sometimes|required',
            'gcf.src_data' => 'required',
            'gcf.res_data' => 'required',
            'gcf.res_litho' => 'required',
            'gcf.res_formation' => 'required',
            'gcf.res_age_period' => 'required',
            'gcf.res_age_epoch' => 'required',
            'gcf.res_dep_env' => 'required',
            'gcf.trp_data' => 'required',
            'gcf.trp_type' => 'required',
            'gcf.dyn_data' => 'required'
        ];
    }
}
