<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    /**
     * Cek jika atribut yang diberikan mempunyai aturan 'required'
     *
     * @param  array $attribute
     * @return boolean
     */
    public function isRequirede($attribute)
    {
        if (in_array($attribute, array_keys($this->rules()))) {
            if (strpos($this->rules()[$attribute], 'required') !== false) {
                return true;
            }
        }

        return false;
    }
}
