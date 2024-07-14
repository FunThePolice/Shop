<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container text-center">
    <h1 class="display-1 mt-5">App</h1>
    <div class="my-5">
        <a class="btn btn-secondary p-2 g-col-6" href="{{ route('cart.index') }}" role="button" >Cart</a>
        <a class="btn btn-secondary p-2 g-col-6" href="{{ route('orders.index') }}" role="button" >Orders</a>
    </div>
    @if(session()->get('order_number'))
        <h1 class="display-1 mt-5">{{'Your order number is '. session()->get('order_number')}}</h1>
    @endif
    <div class="row">
    @foreach($forecast as $day)
        <div class="col">
        <span class="badge text-bg-info">
            {{$day[0]}}<br/>
            t.max:{{$day[2]}}<br/>
            t.min:{{$day[3]}}<br/>
        </span>
        </div>
    @endforeach
    </div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="card-group">
        @foreach($items as $item)
            <div class="card">
                <div id="{{ $item['sku'] }}" class="carousel carousel-dark">
                    <div class="carousel-item active">
                        <img src="{{ reset($item['images'])['url'] }}" class="img-thumbnail" width="300" height="250" alt="image">
                    </div>
                    <div class="carousel-inner">
                            @foreach($item['images'] as $image)
                                <div class="carousel-item">
                                    <img src="{{ $image['url'] }}" class="img-thumbnail" width="300" height="250" alt="image">
                                </div>
                            @endforeach
                        </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#{{ $item['sku'] }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#{{ $item['sku'] }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $item['name'] }}</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">sku:{{ $item['sku'] }}</h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary">price:{{ $item['price'] }}</h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary">amount:{{ $item['amount'] }}</h6>
                        <h6 class="card-subtitle mb-2 text-body-secondary">tags:</h6>
                        @foreach($item['tags'] as $tag)
                            <h6 class="card-subtitle mb-2 text-body-secondary">{{ $tag['name'] }}</h6>
                        @endforeach
                    </div>
                <div class="card-footer">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <form id="add-to-cart" method="post" action="{{ route('products.add') }}">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="product" value="{{ json_encode($item) }}">
                            <button class="btn btn-primary me-md-2" type="submit">Add to cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
