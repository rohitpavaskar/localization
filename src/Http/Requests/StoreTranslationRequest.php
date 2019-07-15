<?php

namespace Rohitpavaskar\Localization\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTranslationRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'key' => 'required',
            'text' => 'required',
            'type' => 'required',
            'module' => 'required',
            'language' => 'required',
        ];
    }

}
