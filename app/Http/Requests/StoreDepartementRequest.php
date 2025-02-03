<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreDepartementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'first_approver_id' => ['required', 'exists:users,id'],
            'second_approver_id' => ['required', 'exists:users,id'],
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        // Redirect ke route tertentu dengan membawa error dan input
        throw new HttpResponseException(
            redirect()
                ->route('departement.index') // Ganti dengan route yang diinginkan
                ->withErrors($validator)
                ->withInput()
                ->with('modal', '#create-departement-modal') // Tambahkan parameter modal jika diperlukan
        );
    }
}
