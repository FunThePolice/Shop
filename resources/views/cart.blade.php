<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container text-center">
    <h1 class="display-1 mt-5">App</h1>
    <div class="my-5">
        <a class="btn btn-secondary p-2 g-col-6" href="/" role="button" >Shop</a>
    </div>
    @if(empty($products))
        <h1 class="display-1 mt-5">{{'No products in cart'}}</h1>
    @endif

    <h1 class="display-1 mt-5">{{session()?->get('message')}}</h1>

    <div class="card-group">
        @foreach($products as $product)
            <div class="card">
                <div id="{{ $product['sku'] }}" class="carousel carousel-dark">
                    <div class="carousel-item active">
                        <img src="{{ reset($product['images'])['url'] }}" class="img-thumbnail" width="300" height="250" alt="image">
                    </div>
                    <div class="carousel-inner">
                        @foreach($product['images'] as $image)
                            <div class="carousel-item">
                                <img src="{{ $image['url'] }}" class="img-thumbnail" width="300" height="250" alt="image">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#{{ $product['sku'] }}" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#{{ $product['sku'] }}" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $product['name'] }}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">sku:{{ $product['sku'] }}</h6>
                    <h6 class="card-subtitle mb-2 text-body-secondary">price:{{ $product['price'] }}</h6>
                    <h6 class="card-subtitle mb-2 text-body-secondary">amount:{{ $product['amount'] }}</h6>
                    <h6 class="card-subtitle mb-2 text-body-secondary">tags:</h6>
                    @foreach($product['tags'] as $tag)
                        <h6 class="card-subtitle mb-2 text-body-secondary">{{ $tag['name'] }}</h6>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

<div class="my-5">
    <form id="buy-products" method="post" action="{{ route('cart.buy') }}">
        @csrf
        @method('POST')
        <button class="btn btn-primary me-md-2" type="submit">Buy</button>
    </form>
</div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
