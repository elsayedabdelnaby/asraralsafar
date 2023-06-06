<?php

namespace Modules\UsersManagement\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TranslationContainMainLanguage;

class StoreRoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'report_to' => 'required|exists:roles,id,deleted_at,NULL',
            'translations' => ['required', 'array', new TranslationContainMainLanguage],
            'translations.*.language_id' => 'required|exists:languages,id',
            'translations.*.name' => 'required|string|unique:role_translations,name,NULL,id,deleted_at,NULL|max:100',
            'profiles' => 'required|array',
            'profiles.*' => 'required|exists:profiles,id,deleted_at,NULL',
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
