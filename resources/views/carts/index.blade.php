@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width: 50%">Product</th>
                    <th style="width: 10%">Price</th>
                    <th style="width: 8%">Quantity</th>
                    <th style="width: 22%" class="text-center">Sub Total</th>
                    <th style="width: 10%"></th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0 ?>
                @if(session('cart'))
                @foreach (session('cart') as $id => $product)
                    <?php $total += $product['price'] * $product['quantity'] ?>
                    
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img width="100px" height="100px" class="img-responsive"  src="{{ asset("/storage/".$product['image_url']) }}"></div>
                                <div class="col-sm-9">
                                    <h4 class="nomargin">{{ $product['name'] }}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">Rp {{ $product['price'] }}</td>
                        <td data-th="Quantity">
                            <input type="number" value="{{ $product['quantity'] }}" class="form-control quantity">
                        </td>
                        <td data-th="Subtotal" class="text-center">Rp {{ $product['price'] * $product['quantity'] }}</td>
                        <td>
                            <button data-id="{{ $id }}" class="btn btn-info btn-sm ml-1 mb-1 update-cart">Update</button>
                            <button data-id="{{ $id }}" class="btn btn-danger btn-sm remove-cart">Remove</button>
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr class="visible-xs">
                    <td class="text-center"><strong>Total Rp {{ $total }}</strong></td>
                </tr>
                <tr>
                    <td>
                        <a href="{{ url('/products') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Lanjutkan Belanja</a>
                        <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">Lanjut ke pembayaran <i class="fa fa-arrow-right"></i></a>
                    </td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Total Rp. {{ $total }}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".update-cart").click(function(e){
                e.preventDefault();
                var ele = $(this);

                $.ajax({
                    url: '{{ route('carts.update') }}',
                    method: 'patch',
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            });

            
            $(".remove-cart").click(function(e){
                e.preventDefault();
                var ele = $(this);

                if (confirm("Are you sure?")) {
                    $.ajax({
                        url: '{{ route('carts.remove') }}',
                        method: 'delete',
                        data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endsection