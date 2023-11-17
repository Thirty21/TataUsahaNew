<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStaffRequest extends FormRequest
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
            'nama' => __('model.staff.nama'),
            'tanggal_lahir' => __('model.staff.date_of_birth'),
            'gender' => __('model.staff.gender'),
            'posisi' => __('model.staff.posisi'),
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
                'nip' => ['required', Rule::unique('staff')->ignore($this->id)],
                'nama' => ['required'],
                'tanggal_lahir'=> ['nullable'],
                'gender'=> ['nullable'],
                'posisi'=> ['nullable'],
        ];
    }
}
