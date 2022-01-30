@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h2>
                        <span class="badge badge-primary">Alamat Pengiriman</span> 
                    </h2>
                    <p>{{ $order->shipping_address }} {{ $order->ward }}, Ds. {{ $order->village }}, Kec. {{ $order->district }}, Kab. {{ $order->city }}, Prov. {{ $order->province }} </p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h2>
                        <span class="badge badge-primary">Kode Pos</span> 
                    </h2>
                    <p>{{ $order->zip_code }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h2>
                        <span class="badge badge-primary">Nomor Yang Dapat Dihubungi</span> 
                    </h2>
                    <p>{{ $order->telp }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h2>
                        <span class="badge badge-primary">Harga Total</span> 
                    </h2>
                    <p>{{ $order->total_price }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <td style="width: 50%;">Product</td>
                        <td style="width: 18%;">Price</td>
                        <td style="width: 8%;">Quantity</td>
                        <td style="width: 22%;" class="text-center">Subtotal</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $orderItem)
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-3 hidden-xs"><img src="{{ asset("/storage/".$orderItem->product->image_url) }}" alt="..." width="100" class="img-responsive"></div>
                                <div class="col-sm-9">
                                    <a href="{{ route('products.show', $orderItem->product->id) }}" class="text-dark">
                                        <h4 class="nomargin">{{ $orderItem->product->name }}</h4>
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">
                            {{ $orderItem->price }}
                        </td>
                        <td data-th="Quantity">
                            {{ $orderItem->quantity }}
                        </td>
                        <td data-th="Subtotal" class="text-center">
                            {{ $orderItem->price * $orderItem->quantity }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection