@extends('admin.admin_template')

@section('main')
    @include('admin.partials.breadcrumb')
    <div class="card">
        <div class="card-body flex flex-col p-6">
            <header class="flex mb-5 items-center border-b border-slate-100 dark:border-slate-700 pb-5 -mx-6 px-6">
                <div class="flex-1">
                    <div class="card-title text-slate-900 dark:text-white">{{ $title }}</div>
                </div>
            </header>
            @include('admin.partials.alert')
            <div class="card-text h-full ">
                <form class="space-y-4" method="POST" action="{{ route('konsumen.application.create') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="input-area relative">
                        <label for="nama" class="form-label">nama</label>
                        <input type="text" id="nama" name="nama" class="form-control"
                            placeholder="Enter Your nama" value="{{ old('nama') }}">
                        <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                    </div>
                    <div class="input-area relative">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" id="nik" name="nik" class="form-control" placeholder="">
                        <x-input-error :messages="$errors->get('nik')" class="mt-2" />
                    </div>
                    <div class="input-area relative">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" placeholder="">
                        <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
                    </div>
                    <div>
                        @php
                            $status_perkawinans = ['single', 'married'];
                        @endphp
                        <label for="status_perkawinan" class="form-label">Status Perkawinan <x-required /></label>
                        <select name="status_perkawinan" id="status_perkawinan"
                            class="select2 form-control w-full mt-2 py-2">
                            @foreach ($status_perkawinans as $rol)
                                <option value="{{ $rol }}"
                                    {{ $rol === old('status_perkawinan') ? 'selected' : '' }}
                                    class=" inline-block font-Inter font-normal text-sm text-slate-600">
                                    {{ $rol }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-area relative">
                        <label for="data_pasangan" class="form-label">Data Pasangan</label>
                        <input type="text" id="data_pasangan" name="data_pasangan" class="form-control" placeholder="">
                        <x-input-error :messages="$errors->get('data_pasangan')" class="mt-2" />
                    </div>
                    <div class="input-area relative">
                        <label for="dealer" class="form-label">Dealer</label>
                        <input type="text" id="dealer" name="dealer" class="form-control" placeholder="">
                        <x-input-error :messages="$errors->get('dealer')" class="mt-2" />
                    </div>
                    <div class="input-area relative">
                        <label for="merk_kendaraan" class="form-label">Merk Kendaraan</label>
                        <input type="text" id="merk_kendaraan" name="merk_kendaraan" class="form-control" placeholder="">
                        <x-input-error :messages="$errors->get('merk_kendaraan')" class="mt-2" />
                    </div>
                    <div class="input-area relative">
                        <label for="model_kendaraan" class="form-label">Model Kendaraan</label>
                        <input type="text" id="model_kendaraan" name="model_kendaraan" class="form-control"
                            placeholder="">
                        <x-input-error :messages="$errors->get('model_kendaraan')" class="mt-2" />
                    </div>
                    <div class="input-area relative">
                        <label for="tipe_kendaraan" class="form-label">Tipe Kendaraan</label>
                        <input type="text" id="tipe_kendaraan" name="tipe_kendaraan" class="form-control" placeholder="">
                        <x-input-error :messages="$errors->get('tipe_kendaraan')" class="mt-2" />
                    </div>
                    <div class="input-area relative">
                        <label for="warna_kendaraan" class="form-label">Warna Kendaraan</label>
                        <input type="text" id="warna_kendaraan" name="warna_kendaraan" class="form-control"
                            placeholder="">
                        <x-input-error :messages="$errors->get('warna_kendaraan')" class="mt-2" />
                    </div>
                    <div class="input-area relative">
                        <label for="harga_kendaraan" class="form-label">Harga Kendaraan</label>
                        <input type="number" id="harga_kendaraan" name="harga_kendaraan" class="form-control"
                            placeholder="">
                        <x-input-error :messages="$errors->get('harga_kendaraan')" class="mt-2" />
                    </div>
                    <div class="input-area relative">
                        <label for="asuransi" class="form-label">asuransi</label>
                        <input type="number" id="asuransi" name="asuransi" class="form-control" placeholder="">
                        <x-input-error :messages="$errors->get('asuransi')" class="mt-2" />
                    </div>
                    <div class="input-area relative">
                        <label for="down_payment" class="form-label">Down Payment</label>
                        <input type="number" id="down_payment" name="down_payment" class="form-control"
                            placeholder="">
                        <x-input-error :messages="$errors->get('down_payment')" class="mt-2" />
                    </div>
                    <div class="input-area relative">
                        <label for="lama_kredit_bulan" class="form-label">Lama Kredit Bulan</label>
                        <input type="number" id="lama_kredit_bulan" name="lama_kredit_bulan" class="form-control"
                            placeholder="">
                        <x-input-error :messages="$errors->get('lama_kredit_bulan')" class="mt-2" />
                    </div>
                    <div class="input-area relative">
                        <label for="angsuran_bulan" class="form-label">Angsuran Bulan</label>
                        <input type="number" id="angsuran_bulan" name="angsuran_bulan" class="form-control"
                            placeholder="">
                        <x-input-error :messages="$errors->get('angsuran_bulan')" class="mt-2" />
                    </div>

                    <div class="input-area relative">
                        <label for="bukti_bayar" class="form-label">Bukti Bayar</label>
                        <input type="file" id="bukti_bayar" name="bukti_bayar" class="form-control" placeholder="">
                        <x-input-error :messages="$errors->get('bukti_bayar')" class="mt-2" />
                    </div>
                    <div class="input-area relative">
                        <label for="form_aplikasi" class="form-label">Form Aplikasi</label>
                        <input type="file" id="form_aplikasi" name="form_aplikasi" class="form-control"
                            placeholder="">
                        <x-input-error :messages="$errors->get('form_aplikasi')" class="mt-2" />
                    </div>
                    <div class="input-area relative">
                        <label for="kartu_keluarga" class="form-label">Kartu Keluarga</label>
                        <input type="file" id="kartu_keluarga" name="kartu_keluarga" class="form-control"
                            placeholder="">
                        <x-input-error :messages="$errors->get('kartu_keluarga')" class="mt-2" />
                    </div>
                    <button class="btn inline-flex justify-center btn-dark">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
