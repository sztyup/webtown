@extends('layout')

@section('content')
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
        <p>Eredeti ár: {{ $cart->getOriginalPrice() }} HUF ({{ $exchanger->exchange($cart->getOriginalPrice()) }} EUR)</p>
        @if ($cart->getDiscount())
            <p>Kedvezményes ár: {{ $cart->getFinalPrice() }} HUF ({{ $exchanger->exchange($cart->getFinalPrice()) }} EUR)</p>
            <p>Alkalmazott kedvezmény: {{ $cart->getDiscount()->getName() }}</p>
        @else
            <p>Nem alkalmazható semmilyen kedvezmény :/</p>
        @endif
    @endif
@endsection