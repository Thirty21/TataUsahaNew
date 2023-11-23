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
            'nip' => __('model.staff.nip'),
            'nama' => __('model.staff.nama'),
            'tanggal_lahir' => __('model.staff.tanggal_lahir'),
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
            'nip' => ['required', Rule::unique('staff'), 'size:8'],
            'nama' => ['required'],
            'tanggal_lahir' => ['nullable'],
            'gender' => ['nullable'],
            'posisi' => ['nullable'],
        ];
    }
}
