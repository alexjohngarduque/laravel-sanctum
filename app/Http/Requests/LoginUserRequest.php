<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class LoginUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'password' => ['required'],
        ];
    }

    public function getCredentials()
    {
        // in order to support
        // logging users in with both (name and email)
        // we have to check if user has entered one or another
        $name = $this->get('name');

        if ($this->isEmail($name)) {
            return [
                'email' => $name,
                'password' => $this->get('password')
            ];
        }

        return $this->only('name', 'password');
    }

    private function isEmail($param)
    {
        $factory = $this->container->make(ValidationFactory::class);

        return ! $factory->make(
            ['name' => $param],
            ['name' => 'email']
        )->fails();
    }

}
