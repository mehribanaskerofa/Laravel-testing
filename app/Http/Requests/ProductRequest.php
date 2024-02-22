<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function rules(): array
    {
//        $data= [
//            'image'=>[Rule::requiredIf(request()->method==self::METHOD_POST),'required','image','mimes:jpg,jpeg,png'],
//            'active'=>'nullable|boolean',
//            'category_id'=>'required|exists:categories,id',
//            'price'=>'required|numeric|min:0',
//            'quantity'=>'nullable|numeric|min:0'
//
//
//        ];
//        return $this->mapLanguageValidations($data);
        return [
            'name'=>'required',
            'price'=>'required'
        ];
    }
//    private function mapLanguageValidations($data){
//        foreach (config('app.languages') as $lang){
//            $data[$lang]='required|array';
//            $data["$lang.title"]='required|string|min:2';
//            $data["$lang.description"]='string';
//            $data["$lang.specification"]='required|string|min:2';
//            $data["$lang.slug"]=[
//                'required','string',
//                Rule::unique('product_translations','slug')
//                    ->where('locale',$lang)
//                    ->ignore($this->route('product')?->id,'product_id')];
//        }
//        return $data;
//    }
}
