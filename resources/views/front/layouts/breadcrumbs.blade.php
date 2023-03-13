@unless ($breadcrumbs->isEmpty())
    <div class="breadcrumb">
        <ul class="breadcrumb-list">
            @foreach ($breadcrumbs as $breadcrumb)
            @if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item">
                    <a href="{{ $breadcrumb->url }}">
                        <span>{{ $breadcrumb->title }}</span><i class="fa fa-caret-right"></i>
                    </a>
                </li>
            @else
                <li class="breadcrumb-item"><span>{{ $breadcrumb->title }}</span></li>
            @endif
        @endforeach
        </ul>
    </div>
@endunless
