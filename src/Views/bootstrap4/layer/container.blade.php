<div class="container">
    @foreach($children as $item)
        <lsd::render :item="$item"/>
    @endforeach
</div>