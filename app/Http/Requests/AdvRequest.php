<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdvRequest extends FormRequest
{
    public function rules(): array
    {
        $data= [
            'company_id'=>'required|exists:companies,id',
            'image'=>[Rule::requiredIf(request()->method==self::METHOD_POST),'image','mimes:jpg,jpeg,png,svg,webp'],
        ];

        return $this->mapLanguageValidations($data);
    }
    private function mapLanguageValidations($data){
        foreach (config('app.languages') as $lang){
            $data[$lang]='required|array';
            $data["$lang.name"]='required|string';
            $data["$lang.title"]='string';
        }
        return $data;
    }
}
