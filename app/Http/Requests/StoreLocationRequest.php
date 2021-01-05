<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->id != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:100',
            'address' => 'required|string',
            'phone' => 'nullable',
            'lat_long' => 'string|required',
            'description' => 'nullable',
            'website' => 'nullable',
            'status' => 'required',
            'location_type_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
            'max' => ':attribute maksimal :max karakter',
            'string' => ':attribute harus berupa string',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Nama lokasi', 
            'address' => 'Alamat', 
            'phone' => 'Nomor telepon', 
            'lat_long' => 'Latitude Longitude', 
            'description' => 'Deskripsi', 
            'website' => 'Website', 
            'status' => 'Status',
            'location_type_id' => 'Tipe lokasi',    
        ];
    }
}
