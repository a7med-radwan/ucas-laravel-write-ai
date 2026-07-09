<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $userId = $this->route('user') ? $this->route('user')->id : null;
        $user = $this->user();

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($userId)],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($userId)],
            'password' => [$this->isMethod('post') ? 'required' : 'nullable', 'string', 'min:8', 'confirmed'],
            'status' => ['required', 'in:active,inactive'],
        ];

        if ($user && ($user->type === 'super-admin' || $user->hasRole('Super Admin'))) {
            $rules['type'] = ['required', 'in:user,admin,super-admin'];
            $rules['roles'] = ['nullable', 'array'];
            $rules['roles.*'] = ['exists:roles,id'];

            // Protect critical fields if editing themselves to prevent self-lockout or privilege downgrade
            if ($userId && $user->id === $userId) {
                $rules['status'] = ['required', 'in:active'];
                $rules['type'] = ['required', 'in:super-admin'];

                $superAdminRoleId = \App\Models\Role::where('name', 'Super Admin')->value('id');
                if ($superAdminRoleId) {
                    $rules['roles'] = ['required', 'array', function ($attribute, $value, $fail) use ($superAdminRoleId) {
                        if (!in_array($superAdminRoleId, $value)) {
                            $fail('You cannot remove the Super Admin role from yourself.');
                        }
                    }];
                }
            }
        }

        return $rules;
    }
}
