<x-card>
    <x-slot name="title">
        <h3>{{ $product->name }}</h3>
    </x-slot>

    <x-slot name="footer">
        <form action="{{ route('products.delete', $product) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn" type="submit">Delete product</button>
        </form>
    </x-slot>

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
                <form action="{{ route('products.remove-tag', [$product, $tag]) }}" method="POST">
                    @csrf
                    <div style="display: flex">
                        <span class="tag">
                            {{ $tag->name }}
                            <button type="submit" style="background-color: inherit; border: none; color: white; font-size: large">x</button>
                        </span>
                    </div>
                </form>
            @endforeach
        </div>
    @endif
</x-card>
