<?php

namespace App\Modules\Contracts\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [];
    }
}
