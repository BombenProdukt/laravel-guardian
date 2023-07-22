<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Password\Http\Requests;

use BombenProdukt\Guardian\Guardian;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

final class SignUpRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            Guardian::username() => ['required', 'string', 'email', 'max:255', 'unique:'.Guardian::model('user')],
            Guardian::password() => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
