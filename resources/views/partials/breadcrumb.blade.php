{{-- Breadcrumb dynamique --}}
<div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            {{-- Tableau de bord est toujours présent --}}
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Tableau de bord</a></li>

            @if(isset($breadcrumb) && count($breadcrumb) > 0)
                @foreach($breadcrumb as $item)
                    @if($loop->last)
                        <li class="breadcrumb-item active" aria-current="page">{{ $item['title'] }}</li>
                    @else
                        <li class="breadcrumb-item"><a href="{{ $item['url'] }}">{{ $item['title'] }}</a></li>
                    @endif
                @endforeach
            @endif
        </ol>
    </nav>
</div>
