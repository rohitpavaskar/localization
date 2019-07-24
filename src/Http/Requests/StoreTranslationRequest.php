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

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes() {
        return [
            'key' => trans('translation.key'),
            'text' => trans('translation.translation'),
            'type' => trans('translation.type'),
            'module' => trans('translation.module'),
            'language' => trans('translation.language'),
        ];
    }

}
