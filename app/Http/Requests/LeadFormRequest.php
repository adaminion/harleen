<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LeadFormRequest extends Request
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
            'lead.basin_name' => 'sometimes|required',
            'lead.play_name' => 'required',
            'lead.structure_name' => 'required',
            'lead.closure_name' => 'required',
            'lead.province_name' => 'required',
            'lead.analog_to' => 'required',
            'lead.analog_distance' => 'required',
            'lead.shore' => 'required',
            'lead.terrain' => 'required',
            'lead.nearby_field' => 'required',
            'lead.nearby_infra' => 'required',
            'lead.update_reason' => 'sometimes|required',
            'lead.delete_reason' => 'sometimes|required',
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
