<?php

namespace App\Http\Requests\Artists;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ArtistIndexRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => ['nullable', 'string', 'max:255'],
            'regencies' => ['nullable', 'array'],
            'regencies.*' => ['integer'],
            'genres' => ['nullable', 'array'],
            'genres.*' => ['integer'],
        ];
    }

    public function search(): ?string
    {
        $value = $this->string('search')->trim()->value();

        return $value !== '' ? $value : null;
    }

    public function regencyIds(): array
    {
        return $this->array('regencies');
    }

    public function genreIds(): array
    {
        return $this->array('genres');
    }
}
