@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row m-2">
            <div class="col-md-3 offset-md-9">
                <div class="form-group">
                    <select name="order_field" id="order_field" class="form-control">
                        <option value="" disabled selected>Urutkan</option>
                        <option value="best_seller">Best Seller</option>
                        <option value="terbaik">Terbaik (Berdasarkan Rating)</option>
                        <option value="termurah">Termurah</option>
                        <option value="termahal">Termahal</option>
                        <option value="terbaru">Terbaru</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col" id="product-list">
            <div class="row row-cols-1 row-cols-md-4">
                @foreach ($products as $product)
                    <div class="col md-4">
                        <div class="card h-100">
                            <img src="{{ asset("/storage/".$product->image_url) }}" class="card-img-top" style="height: 250px; object-fit: cover;object-position: center;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                </h5>
                            </div>
                            <div class="container">
                                <p class="card-text p-1">
                                    Rp {{ $product->price }}
                                </p>
                            </div>

                            <div class="card-footer">
                                <a href="{{ route('carts.add', $product->id) }}" class="btn btn-primary"><i class="fa fa-dollar"></i> Beli</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#order_field').change(function() {
                // window.location.href = 'products/?order_by=' + $(this).val();
                $.ajax({
                    type: 'GET',
                    url: 'products/',
                    data: {
                        order_by: $(this).val(),
                    },
                    dataType: 'json',
                    success: function(data) {
                        var products = '';
                        products += '<div class="col" id="product-list">' + 
                                '<div class="row row-cols-1 row-cols-md-4">';
                        $.each(data, function(idx, product) {
                            products += '<div class="col md-4">' + 
                                        '<div class="card h-100">' + 
                                            '<img src="/storage/' + product.image_url + '" class="card-img-top" style="height: 250px; object-fit: cover;object-position: center;">' + 
                                            '<div class="card-body">' + 
                                                '<h5 class="card-title">' + 
                                                    '<a href="/product/' + product.id + '">' + product.name + '</a>' + 
                                                '</h5>' + 
                                            '</div>' + 
                                            '<div class="container">' + 
                                                '<p class="card-text p-1">' + 
                                                    'Rp ' + product.price + 
                                                '</p>' + 
                                            '</div>' + 

                                            '<div class="card-footer">' + 
                                                '<a href="carts/add/' + product.id +'" class="btn btn-primary"><i class="fa fa-dollar"></i> Beli</a>' + 
                                            '</div>' + 
                                        '</div>' + 
                                    '</div>';
                        });
                        products += '</div>' + 
                            '</div>';
                            
                        $('#product-list').html(products);
                    },
                    error: function(data) {
                        alert('Unable to handle request');
                    }
                });
            });
        });
    </script>
@endsection