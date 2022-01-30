@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2>List Product</h2>
            <div>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Tambah Produk</a>
                <a href="{{ route('products.index') }}" class="btn btn-success">Daftar Produk</a>
            </div>
            <br>
            <div class="form-group col-md-2">
                <label for="">User Admin: </label>
                <select name="admin_products" id="admin_products" class="form-control">
                    <option value="{{ Auth::user()->id }}" disabled selected>{{ Auth::user()->name }}</option>
                </select>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Create at</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->created_at }}</td>
                            <td class="d-flex">
                                <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm btn-info">INFO <i class="fa fa-info"></i> </a>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="ml-2 btn btn-sm btn-secondary">EDIT <i class="fa fa-edit"></i> </a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-2 btn btn-sm btn-danger">HAPUS <i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#admin_products').change(function() {
                window.location.href = 'products/?admin_id=' + $(this).val();
            });
        });
    </script>
@endsection