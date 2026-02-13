<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $bookID = $this->route('book');
        return [
            'book' => [
                'required', 'string', 'max:60',
                Rule::unique('book')->where(function ($query) use ($bookID) {
                    return $query->where('author', $this->author)
                                 ->where('subject_code', $this->subject_code)
                                 ->where('bookID', '!=', $bookID);
                })
            ],
            'author' => 'required|string|max:100',
            'subject_code' => 'required|string|max:20',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'rack' => 'required|string|max:60'
        ];
    }

    public function messages(): array
    {
        return [
            'book.required' => 'El título del libro es obligatorio.',
            'book.unique' => 'Este libro con el mismo autor y código de materia ya existe.',
            'author.required' => 'El autor es obligatorio.',
            'subject_code.required' => 'El código de materia es obligatorio.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'quantity.required' => 'La cantidad es obligatoria.',
            'quantity.integer' => 'La cantidad debe ser un número entero.',
            'rack.required' => 'La ubicación (estante) es obligatoria.',
        ];
    }
}
