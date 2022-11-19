<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Products</title>

        <style>
            .alert-success {
                color: green;
            }

            .alert-box {
                background-color: lightgrey;
                border-radius: 4px;
                width: 50%;
                padding: 5px 20px 5px;
                color: black;
            }

            .alert-box h3 {
                color: red;
            }

        </style>
    </head>
    <body>

        <h1>Current Products</h1>

        @if (\App\Product::all()->count())
        <ul>
            @foreach (\App\Product::all() as $product)
            <li>
                {!! $product->name !!}
                <form action="{{ route('products.delete', $product) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">delete</button>
                </form>
            </li>
            @endforeach
        </ul>
        @else
            <p><em>No products have been created yet.</em></p>
        @endif



        @if (session('status'))
        <div class="alert-success">
            {{ session('status') }}
        </div>
        @endif

        @if ($errors->any())
            <div class="alert-box">
                <h3>There {{ count($errors) > 1 ? "are multiple errors" : "is an error" }} with the new product</h3>
                <div>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif


        <h2>New product</h2>
        <form action="{{ route('products.new') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="name" /><br />
            <textarea name="description" placeholder="description"></textarea><br />
            <input type="text" name="tags" placeholder="tags" /><br />
            <button type="submit">Submit</button>
        </form>

    </body>
</html>
