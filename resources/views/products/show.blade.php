@extends('layouts.app')

@section('content')
<style>
    .rating{
        transform: translate(-88%, -20%) rotateY(180deg);
        display: flex;
    }
    .rating input{
        display: none;
    }
    .rating label{
        display: block;
        cursor: pointer;
        width: 20px;
        /*background: #ccc;*/
    }
    .rating label:before{
        content:'\f005';
        font-family: fontAwesome;
        position: relative;
        display: block;
        font-size: 20px;
        color: yellow;
    }
    .rating label:after{
        content:'\f005';
        font-family: fontAwesome;
        position: absolute;
        display: block;
        font-size: 20px;
        color: #fffa00;
        top:0;
        opacity: 0;
        transition: .5s;
        text-shadow: 0 2px 5px rgba(0,0,0,.5);
    }
    .rating label:hover:after,
    .rating label:hover ~ label:after,
    .rating input:checked ~ label:after
    {
        opacity: 1;
    }
</style>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="{{ asset("/storage/".$product->image_url) }}" class="card-img-top">
            </div>
            <div class="col-md-9">
                <h2>
                    <b>{{ $product->name }}</b>
                    <hr class="ml-0" style="width: 500px;">
                </h2>
                <h4>Rp {{ $product->price }}</h4>
                <p>Total Rating: <strong>{{ $star }}</strong></p>
                <div class="rating">
                    @for ($stars = 0; $stars < $star; $stars++)
                    <input type="radio" value="$star" id="star1"><label for="star1"></label>
                    @endfor
                </div>
                <div class="mt-4">
                    <a href="{{ route('carts.add', $product->id) }}" class="btn btn-primary"><i class="fa fa-dollar"></i> Beli</a>
                </div>
                <div class="mt-3">
                    <h5>Share Product</h5>
                    <a href="https://wwww.facebook.com/sharer/sharer.php?u={{ route('products.show', $product->id) }}" class="social-button mr-2" target="_blank">
                        <i class="fa fa-facebook fa-2x"></i>
                    </a>
                    <a href="https://wwww.twitter.com/intent/tweet?text=my share text&amp;url={{ route('products.show', $product->id) }}" class="social-button mr-2" target="_blank">
                        <i class="fa fa-twitter fa-2x"></i>
                    </a>
                    <a href="https://wwww.linkedin.com/shareArticle?mini=true&amp;url={{ route('products.show', $product->id) }}&amp;title=my share text&amp;summary=it is the linkedin summary" class="social-button mr-2" target="_blank">
                        <i class="fa fa-linkedin fa-2x"></i>
                    </a>
                    <a href="https://www.instagram.com/p/{{ route('products.show', $product->id) }}/?utm_source=ig_web_copy_link" class="social-button mr-2" target="_blank">
                        <i class="fa fa-instagram fa-2x"></i>
                    </a>
                    <a href="https://wa.me/?text={{ route('products.show', $product->id) }}" class="social-button" target="_blank">
                        <i class="fa fa-whatsapp fa-2x"></i>
                    </a>
                </div>
                <div class="mt-4">
                    <ul  class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" role="tab" data-toggle="tab" href="#desc">Deskripsi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" role="tab" data-toggle="tab" href="#review">Review</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-1">
                        <div role="tabpanel" id="desc" class="tab-pane fade in active show">
                            {!! $product->desc !!}
                        </div>
                        <div role="tabpanel" id="review" class="tab-pane fade">
                            <form action="{{ route('products.store', $product->id) }}" method="POST">
                                @csrf
                                <h4>Rating: </h4>
                                <div class="rating">
                                    <input type="radio" value="5" name="rating" id="star5"><label for="star5"></label>
                                    <input type="radio" value="4" name="rating" id="star4"><label for="star4"></label>
                                    <input type="radio" value="3" name="rating" id="star3"><label for="star3"></label>
                                    <input type="radio" value="2" name="rating" id="star2"><label for="star2"></label>
                                    <input type="radio" value="1" name="rating" id="star1"><label for="star1"></label>
                                </div>
                                <h4>Deskripsi: </h4>
                                <div class="form-group">
                                    <textarea name="description" id="description" class="form-control" placeholder="Deskripsi"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary m-2">SUBMIT</button>
                            </form>
                            
                            @foreach ($reviews as $review)
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="text-center col-2">
                                                <img src="{{ asset("user_img/default.png") }}" alt="...">
                                                <p class="mt-3">
                                                    <div class="badge badge-warning">
                                                        @for ($star = 0; $star < $review->rating; $star++)
                                                        <i type="radio" class="fa fa-star" value="$star" id="star1"></i>
                                                        @endfor
                                                    </div>
                                                    <hr>
                                                    {{ $review->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                            <div class="col">
                                                <h2 class="card-title"><strong>{{ Auth::user()->name }}</strong></h2>
                                                <p>{!! $review->description !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <a href="{{ route('products.index') }}" class="btn btn-danger mt-3"><i class="fa fa-close"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{ asset("tinymce/js/tinymce/jquery.tinymce.min.js") }}"></script>
<script src="{{ asset("tinymce/js/tinymce/tinymce.min.js") }}"></script>
<script>
    tinymce.init({
        selector: 'textarea'
    });
</script>    
@endsection