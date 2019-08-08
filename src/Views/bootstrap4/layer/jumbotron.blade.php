<div class="uk-section uk-section-primary">
    <div class="uk-container ">
        @foreach($items as $item)
            <x-render :item="$item"/>
        @endforeach
    </div>
</div>