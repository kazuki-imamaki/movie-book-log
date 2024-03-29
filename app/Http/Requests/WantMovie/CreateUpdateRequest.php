<?php

namespace App\Http\Requests\WantMovie;

use Illuminate\Foundation\Http\FormRequest;

class CreateUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:50',
            'memo' => 'nullable|max:140',
            'image' => 'nullable',
            'is_done' => 'required'
        ];
    }

    // public function userId(): int
    // {
    //     dd($this);
    //     return $this->user()->id;
    // }


    // public function title(): string
    // {
    //     return $this->input('title');
    // }

    // public function memo(): ?string
    // {
    //     return $this->input('memo');
    // }

    // public function image(): ?string
    // {
    //     return $this->input('image');
    // }

    // public function is_done(): int
    // {
    //     return $this->input('is_done');
    // }

    // public function id(): int
    // {
    //     return (int) $this->route('movieId');
    // }
}
