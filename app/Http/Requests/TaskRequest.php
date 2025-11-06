<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    /**
     * Pega as regras de validação que se aplicam ao request.
     * (Requisito 1 e 6)
     *
     * @return array<string
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',

            'description' => 'nullable|string',

            'status' => 'nullable|string|in:pendente,concluída',
        ];
    }
}
