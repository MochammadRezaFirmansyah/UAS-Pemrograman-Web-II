@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $product->name }}</h2>
        <img src="{{ asset("/storage/".$product->image_url) }}" style="max-width: 100%;height: 300px;">
        <p class="text-primary mt-3">INFO BARANG <i class="fa fa-info"></i></p>
        <div class="row">
            <div class="col-md-3">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td>Harga</td>
                            <td>{{ $product->price }}</td>
                        </tr>
                        <tr>
                            <td>Deskripsi</td>
                            <td>{!! $product->desc !!}</td>
                        </tr>
                        <tr>
                            <td>Action</td>
                            <td class="d-flex">
                                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-info">BACK <i class="fa fa-backward"></i></a>    
                                <a href="{{ route('admin.products.edit', $product['id']) }}" class="ml-2 btn btn-sm btn-secondary">EDIT <i class="fa fa-edit"></i> </a>
                                <form action="{{ route('admin.products.destroy', $product['id']) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-2 btn btn-sm btn-danger">HAPUS <i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>    
@endsection