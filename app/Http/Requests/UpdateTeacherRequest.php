<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    public function attributes(): array
    {
        return [
            'nig' => __('model.teacher.nig'),
            'nama' => __('model.teacher.nama'),
            'tanggal_lahir' => __('model.teacher.tanggal_lahir'),
            'jenis_kelamin' => __('model.teacher.jenis_kelamin'),
            'alamat' => __('model.teacher.alamat'),
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'nig' => ['required', Rule::unique('teachers')],
            'nama' => ['required'],
            'tanggal_lahir' => ['nullable'],
            'jenis_kelamin' => ['nullable'],
            'alamat' => ['nullable'],
        ];
    }
}
