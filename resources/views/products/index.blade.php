<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>

        <title>Products</title>

        <style>
            body {
                font-family: 'Lato', sans-serif;
                font-weight: 400;
            }
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

            .card {
                background-color: white;
                border-radius: 25px;

                border: 2px solid steelblue;
                margin-bottom: 20px;
            }

            .card-header, .card-body, .card-footer {
                padding: 15px 20px 15px 20px;
            }

            .card-header {
                padding-bottom: 0px;
                padding-top: 0px;
                border-bottom: 1px solid steelblue;
            }

            .card-body {
            }

            .card-footer {
                border-top: 1px solid steelblue;
            }

            .btn {
                border: none;
                border-radius: 10px;
                padding: 10px 20px 10px 20px;
                background-color: steelblue;
                color: white;
            }

            .tag {
                border-radius: 10px;
                padding: 10px 20px 10px 20px;
                color: white;
                background-color: lightblue;
                margin-right: 10px;
            }

        </style>
    </head>
    <body style="width: 80%; margin: auto">

        <h1 style="text-align: center">Current Products</h1>

        @if ($products->count())
            @foreach ($products as $product)
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $product->name }}</h3>
                    </div>
                    <div class="card-body">
                        @if (!is_null($product->description))
                            <p>@foreach ($product->splitDescription as $line)
                                {{ $line }}<br>
                            @endforeach
                            </p>
                        @else
                            <p><em>No description.</em></p>
                        @endif
                        @if (!empty($product->tags))
                            <div style="display: flex">
                                @foreach ($product->tags as $tag)
                                    <span class="tag">
                                        {{ $tag->name }}<br>
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <form action="{{ route('products.delete', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn" type="submit">Delete product</button>
                        </form>
                    </div>
                </div>
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

        @if ($errors->any())
            <div class="card" style="border-color: red">
                <div class="card-header" style="border-color: red">
                    <h4>There {{ count($errors) > 1 ? "are multiple errors" : "is an error" }} with the new product</h4>
                </div>

                <div class="card-body">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif


        <div class="card">
            <div class="card-header">
                <h2 style="text-align: center">Create new product</h2>
            </div>
            <form action="{{ route('products.new') }}" method="POST">
                @csrf
                <div class="card-body">
                    <input type="text" name="name" placeholder="name" value="{{ old('name') }}" /><br />
                    <textarea name="description" placeholder="description">{{ old('description') }}</textarea><br />
                    <input type="text" name="tags" placeholder="tags" value="{{ old('tags') }}" /><br />
                </div>
                <div class="card-footer">
                    <button class="btn" type="submit">Create</button>
                </div>
            </form>
        </div>

    </body>
</html>
