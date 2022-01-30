@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2>List Order</h2>
            <br>
            <div class="table-responsive">
                <table class="table-striped table-ms">
                    <thead>
                        <tr>
                            <th style="width: 5%;">#</th>
                            <th style="width: 8%;">Harga Total</th>
                            <th style="width: 7%;">Status</th>
                            <th style="width: 7%;">Kode Pos</th>
                            <th style="width: 48%;">Alamat Pengiriman</th>
                            <th style="width: 10%;">No. Telp</th>
                            <th style="width: 35%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->zip_code }}</td>
                            <td>{{ $order->shipping_address }} {{ $order->ward }}, Ds. {{ $order->village }}, Kec. {{ $order->district }}, Kab. {{ $order->city }}, Prov. {{ $order->province }} </td>
                            <td>{{ $order->telp }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('admin.orders.show', $order->id) }}"><i class="fa fa-eye"></i> Lihat</a>
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