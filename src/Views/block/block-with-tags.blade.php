<div uk-grid>
    <div class="uk-width-2-3 uk-text-lead">
        {!!  $item->html_headline !!}
        {!! $item->content ?? '' !!}
      
        <div class="tags mb-4">
            Tags:
            @foreach($item->tags as $tag)
                <span class="badge badge-info">{{ $tag->name }}</span>
            @endforeach
        </div>
    </div>
    <div class="uk-width-1-3">
        <img src="{{ $item->getMedia('teaser')[0]->getUrl('rectangle-lg') }}" uk-img>
    </div>
</div>

