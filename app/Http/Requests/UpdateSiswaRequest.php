<?php

namespace App\Http\Requests;

use App\Enums\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSiswaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // return auth()->user()->role == Role::ADMIN->status() || $this->id == auth()->user()->id;
        return true;
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        return [
            'nama' => __('model.absen.nama'),
            'tanggal_lahir' => __('model.absen.tanggal_lahir'),
            'gender' => __('model.absen.gender'),
            'alamat' => __('model.absen.alamat'),
            'absen' => __('model.absen.absen'),
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
            'nama' => ['required'],
            'tanggal_lahir' => ['required'],
            'gender' => ['required'],
            'alamat' => ['required'],
            'absen' => ['required'],
        ];
    }
}
