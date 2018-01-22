<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple webshop</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<form action="index.php" method="post">
@foreach ($products as $product)
        <div class="form-group {{ $errors->has($product->getId()) ? "has-error" : "" }}">
            <label for="{{ $product->getId() }}">{{ $product->getName() }}</label>
            <input
                    id="{{ $product->getId() }}"
                    class="form-control"
                    name="{{ $product->getId() }}"
                    type="number"
                    step="1"
                    value="{{ old(
                        $product->getId(),
                        isset($cart) ? $cart->getAmountOf($product) : 0
                    ) }}"
            >
            @if ($errors->has($product->getId()))
            <span class="help-block">
                <strong>{{ $errors->first($product->getId()) }}</strong>
            </span>
            @endif
        </div>
@endforeach
    {!! csrf_field() !!}
    <button type="submit" class="btn btn-default">Ellenőrzés</button>
</form>

@if (isset($cart))
    <p>Eredeti ár: {{ $cart->getOriginalPrice() }}</p>
    @if ($cart->getDiscount())
    <p>Kedvezményes ár: {{ $cart->getFinalPrice() }}</p>
    <p>Alkalmazott kedvezmény: {{ $cart->getDiscount()->getName() }}</p>
    @else
    <p>Nem alkalmazható semmilyen kedvezmény :/</p>
    @endif
@endif
</body>
</html>
