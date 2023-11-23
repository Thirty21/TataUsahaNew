<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
            'nis' => __('model.student.nis'),
            'nama' => __('model.student.nama'),
            'tanggal_lahir' => __('model.student.tanggal_lahir'),
            'gender' => __('model.student.gender'),
            'alamat' => __('model.student.alamat'),
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
            'nis' => ['required', Rule::unique('students')->ignore($this->id), 'size:8'],
            'nama' => ['required'],
            'tanggal_lahir'=> ['nullable'],
            'gender'=> ['nullable'],
            'alamat'=> ['nullable'],
        ];
    }
}
