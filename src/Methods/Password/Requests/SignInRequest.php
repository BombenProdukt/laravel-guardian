<?php

declare(strict_types=1);

namespace BombenProdukt\Guardian\Methods\Password\Http\Requests;

use BombenProdukt\Guardian\Guardian;
use Illuminate\Foundation\Http\FormRequest;

final class SignInRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            Guardian::username() => ['required', 'string'],
            Guardian::password() => ['required', 'string'],
        ];
    }
}
