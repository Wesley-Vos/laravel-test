<div class="card card-{{ $type }}">
    @if (!empty($title))
        <div class="card-header card-{{ $type }}">
            {{ $title }}
        </div>
    @endif
    <div class="card-body card-{{ $type }}">
        {{ $slot }}
    </div>
    @if (!empty($footer))
        <div class="card-footer card-{{ $type }}">
            {{ $footer }}
        </div>
    @endif
</div>
