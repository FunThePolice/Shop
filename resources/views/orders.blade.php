<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container text-center">
    <div class="my-5">
        <a class="btn btn-secondary p-2 g-col-6" href="{{ route('cart.index') }}" role="button" >Cart</a>
        <a class="btn btn-secondary p-2 g-col-6" href="/" role="button" >Shop</a>
    </div>
    @if(empty($orders))
        <h1 class="display-1 mt-5">{{ 'No orders yet' }}</h1>
    @endif
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Number</th>
            <th scope="col">Body</th>
            <th scope="col">Total Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <th scope="row">{{$order['number']}}</th>
                <th scope="row">
                    <div class="card-group">
                    @foreach($order['body'] as $product)
                        <div class="card">
                            <img src="{{ reset($product['images'])['url'] }}" class="img-thumbnail" width="300" height="250" alt="image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product['name'] }}</h5>
                                <h6 class="card-subtitle mb-2 text-body-secondary">sku:{{ $product['sku'] }}</h6>
                                <h6 class="card-subtitle mb-2 text-body-secondary">price:{{ $product['price'] }}</h6>
                                <h6 class="card-subtitle mb-2 text-body-secondary">tags:</h6>
                                @foreach($product['tags'] as $tag)
                                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $tag['name'] }}</h6>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    </div>
                </th>
                <th scope="row">{{$order['total_price']}}</th>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
