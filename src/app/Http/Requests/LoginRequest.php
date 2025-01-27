<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Models\User;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メール形式で入力してください',
            'password.required' => 'パスワードを入力してください',
            'password.min' => 'パスワードは8文字以上で入力してください',
        ];
    }
    protected function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            // 入力されたメールアドレスがデータベースに存在するか確認
            if (!$this->checkEmailExists($this->input('email'))) {
                $validator->errors()->add('email', 'ログイン情報が登録されていません。');
            }
        });
    }

    // メールアドレスがデータベースに存在するか確認
    protected function checkEmailExists($email)
    {
        return User::where('email', $email)->exists();
    }
}
