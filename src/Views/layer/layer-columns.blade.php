<div class="uk-section">
    <div class="uk-container">
        <div class="uk-child-width-1-3@m uk-grid-small uk-grid-match" uk-grid>
            @foreach($items as $item)
                <x-render :item="$item"/>
            @endforeach
        </div>
    </div>
</div>