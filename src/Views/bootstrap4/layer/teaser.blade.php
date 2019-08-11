<section class="row">
    @foreach($item->children as $child)
        <div class="col-md-4">
            <lsd::render :item="$child" />
        </div>
    @endforeach
</section>