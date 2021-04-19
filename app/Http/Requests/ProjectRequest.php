<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Dash;

class ProjectRequest extends FormRequest
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
        $this->sanitize();

        return [
            'name'  => ['required'],
            'cost' => ['required'],
            'description'   => ['required'],
        ];
    }
    /**
     * Limpa os dados da request
     *
     * @return void
     */
    public function sanitize()
    {
        $data = $this->all();

        $data['name'] = str_replace('-', ' ', $data['name']);

        $this->replace($data);
    }
    /**
     * Verifica se tem -
     *
     * @return boolean
     */
    public function hasDash()
    {
        return strpos($this->name, '-');
    }
    /**
     * define descrições manuais das regras de validação
     *
     * @return void
     */
    public function messages()
    {
        return [
            'name.required' => "O campo nome do cliente deve ser preenchido"
        ];
    }
}
