<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/css/app.css"/>
        <title>Products</title>
    </head>
    <body style="width: 80%; margin: auto">

        <h1 style="text-align: center">Current Products</h1>

        @if ($products->count())
            @foreach ($products as $product)
                <x-product :product="$product"/>
            @endforeach
        @else
            <p style="text-align: center"><em>No products have been created yet.</em></p>
        @endif

        <hr style="margin-top: 30px; margin-bottom: 30px">

        @if (session('status'))
        <div class="alert-success" style="text-align: center">
            <p>{{ session('status') }}</p>
        </div>
        @endif

        <form action="{{ route('products.new') }}" method="POST">
            @csrf
            <x-card type="{{ $errors->any() ? 'alert' : 'default' }}">
                <x-slot name="title">
                    <h2 style="text-align: center">Create new product</h2>
                </x-slot>

                <input type="text" name="name" placeholder="name" value="{{ old('name') }}" /><br />
                @error('name')
                <span style="color:red">{{ $message  }}</span><br>
                @enderror

                <textarea name="description" placeholder="description">{{ old('description') }}</textarea><br />
                @error('description')
                <span style="color:red">{{ $message  }}</span><br>
                @enderror

                <input type="text" name="tags" placeholder="tags" value="{{ old('tags') }}" /><br />

                <x-slot name="footer">
                    <button class="btn" type="submit">Create</button>
                </x-slot>
            </x-card>
        </form>
    </body>
</html>
