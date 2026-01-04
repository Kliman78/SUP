<?php

namespace App\Modules\Clients\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientsRequest extends FormRequest
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
