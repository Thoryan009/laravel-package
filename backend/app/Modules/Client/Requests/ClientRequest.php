<?php

namespace App\Modules\Client\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Modules\Client\Models\Client;

class ClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

   public function rules(): array
{
    $id = $this->route('client'); // string/int from URL

    /** @var Client|null $client */
    $client = $id ? Client::find($id) : null;

    $clientPk = $client?->id;
    $userId   = $client?->user_id;

    return [
        // ───── User fields ─────
        'name' => [
            'required',
            'string',
            'max:255',
        ],

        'email' => [
            'required',
            'email',
            Rule::unique('users', 'email')->ignore($userId),
        ],

        'phone' => [
            'nullable',
            'string',
            'max:20',
            Rule::unique('users', 'phone')->ignore($userId),
        ],

        'password' => [
            $client ? 'nullable' : 'required',
            'string',
            'min:8',
        ],

        // ───── Client fields ─────
        'client_id' => [
            'required',
            'string',
            Rule::unique('clients', 'client_id')->ignore($clientPk),
        ],

        'country_id' => [
            'required',
            'exists:countries,id',
        ],
    ];
}
}
