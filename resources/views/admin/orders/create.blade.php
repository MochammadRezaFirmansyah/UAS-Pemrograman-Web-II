@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2>Menambahkan Alamat</h2>
            <br />

            @if (count($errors))
                <div class="form-group">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <br />

            
            <form action="{{ route('admin.orders.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="shipping_address">Alamat Pengiriman</label>
                    <input name="shipping_address" class="form-control" placeholder="Alamat Pengiriman"></input>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="ward">RT/RW</label>
                        <input name="ward" type="text" class="form-control" placeholder="RT /RW "></input>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="village">Kelurahan/Desa</label>
                        <input name="village" type="text" class="form-control" placeholder="Kelurahan/Desa"></input>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="district">Kecamatan</label>
                        <input name="district" type="text" class="form-control" placeholder="Kecamatan"></input>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="city">Kota</label>
                        <input name="city" type="text" class="form-control" placeholder="Kota"></input>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="province">Provinsi</label>
                        <input name="province" type="text" class="form-control" placeholder="Provinsi"></input>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="zip_code">Kode Pos</label>
                        <input name="zip_code" type="number" class="form-control" placeholder="Kode Pos"></input>
                    </div>
                </div>
                <div class="form-group">
                    <label for="telp">Nomor Handphone</label>
                    <input name="telp" class="form-control" placeholder="Nomor Handphone"></input>
                </div>       
                <button type="submit" class="btn btn-success">Simpan <i class="fa fa-save"></i></button>
                <a href="/products" type="submit" class="btn btn-danger">Cancel <i class=" fa fa-close"></i></a>       
            </form>
        </div>
    </div>
</div>
@endsection