<?php

namespace App\Http\Requests;

use App\Rules\ValidLicense;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddLicenseRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'api-key' => ['required','string','max:60'],
            'license-key' => ['required','string','max:40'],
            'product-code' => ['required', 'string', new ValidLicense()],
        ];
    }

    protected function failedValidation(Validator $validator) {
        $errors = $validator->errors();

        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $errors
            ], 422)
        );
    }
}
