<li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}" @if($loop->last) aria-current="page" @endif>
    @if($loop->first) <i class="fas fa-home text-muted"></i> @endif
    @if(!$loop->last) <a href="{{ $document->url }}"> @endif
        {{ $document->title }}
        @if(!$loop->last) </a> @endif
</li>