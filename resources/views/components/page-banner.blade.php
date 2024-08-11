<!-- resources/views/components/page-banner.blade.php -->
<div class="page-banner-area">
    <div class="container">
        <div class="page-banner-content">
            <h2>{{ $title }}</h2>

            <ul class="pages-list">
                @foreach($breadcrumbs as $breadcrumb)
                    @if($loop->last)
                        <li>{{ $breadcrumb['label'] }}</li>
                    @else
                        <li><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</div>
