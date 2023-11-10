<?php

namespace App\Http\Requests;

use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStaffRequest extends FormRequest
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

    public function attributes(): array
    {
        return [
            'nip' => __('model.staff.nis'),
            'name' => __('model.staff.nama'),
            'date_of_birth' => __('model.staff.date_of_birth'),
            'gender' => __('model.staff.gender'),
            'position' => __('model.staff.position'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nip' => ['required', Rule::unique('staff')],
            'name' => ['required'],
            'date_of_birth' => ['nullable'],
            'gender' => ['nullable'],
            'position' => ['nullable'],
        ];
    }
}
