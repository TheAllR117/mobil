<?php

namespace App\Http\Requests;

use App\DifferentBill;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DifferentBillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_estacion' => [
                'required',
            ],
            'description' => [
                'required', 'min:3'
            ],
            /*'add_or_subtract' => [
                'required',
            ],*/
            'quantity' => [
                'required',
            ],
            'file_pdf' => [
                'required',
            ],
            'file_xml' => [
                'required',
            ]
        ];
    }
}
