<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategorieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categorie = $this->route('category');

        return [
            'nom' => 'required|string|max:255',

            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($categorie),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de la catégorie est obligatoire.',
            'nom.string' => 'Le nom doit être un texte.',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'slug.required' => 'Le slug est obligatoire.',
            'slug.string' => 'Le slug doit être un texte.',
            'slug.max' => 'Le slug ne doit pas dépasser 255 caractères.',
            'slug.unique' => 'Ce slug est déjà utilisé par une autre catégorie.',
        ];
    }
}

