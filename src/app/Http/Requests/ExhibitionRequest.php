<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'required|mimes:jpeg,png',
            'categories' => 'required',
            'condition_id' => 'required',
            'name' => 'required',
            'description' => 'required|max:255',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'image.required' => '商品画像を選択してください',
            'image.mimes:jpeg,png' => '.jpegまたは.pngファイルを選択してください',
            'categories.required' => 'カテゴリーを選択してください',
            'condition_id.required' => '商品の状態を選択してください',
            'name.required' => '商品名を入力してください',
            'description.required' => '商品の説明を入力してください',
            'description.max:255' => '255字以内で入力してください',
            'price.required' => '販売価格を入力してください',
            'price.numeric' => '数値で入力してください',
            'price.min:0' => '0円以上で入力してください',
        ];
    }
}
