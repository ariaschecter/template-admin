<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KonsumenApplicationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() : array
    {
        return [
            'nama'              => 'required|string|max:100',
            'nik'               => 'required|string|size:16',
            'tanggal_lahir'     => 'required|date',
            'status_perkawinan' => 'required|in:single,married',
            'data_pasangan'     => 'nullable|string|max:255',
            'dealer'            => 'required|string|max:100',
            'merk_kendaraan'    => 'required|string|max:100',
            'model_kendaraan'   => 'required|string|max:100',
            'tipe_kendaraan'    => 'required|string|max:100',
            'warna_kendaraan'   => 'required|string|max:50',
            'harga_kendaraan'   => 'required|numeric',
            'asuransi'          => 'required|numeric',
            'down_payment'      => 'required|numeric',
            'lama_kredit_bulan' => 'required|integer',
            'angsuran_bulan'    => 'required|numeric',
            'bukti_bayar'       => 'required|file',
            'form_aplikasi'     => 'required|file',
            'kartu_keluarga'    => 'required|file',
        ];
    }
}
