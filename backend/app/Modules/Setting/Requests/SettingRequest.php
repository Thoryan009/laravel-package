<?php

namespace App\Modules\Setting\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{

    private array $fileRule = [
        'nullable',
        'file',
        'mimetypes:image/*',
        'max:1024', // 1MB (KB)
    ];
    public function authorize(): bool
    {
        return true; // move policy logic here later
    }

    public function rules(): array
    {

        return [
            'software_name' => [
                'required',
                'string',
                'max:255',
            ],
            'company_name' => [
                'required',
                'string',
                'max:255',
            ],
            'company_phone' => [
                'required',
                'string',
                'max:50',
            ],
            'company_email' => [
                'nullable',
                'email',
                'max:255',
            ],
            'company_address' => [
                'nullable',
                'string',
                'max:500',
            ],
            'company_logo_path' => [
                'nullable',
                'string',
                'max:255',
            ],
            'company_logo_file' => $this->fileRule,
        ];
    }
}
