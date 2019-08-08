@php
    $breadcrumb = collect([$document] ?? []);
    $parent = $document;

    while($parent = optional($parent)->parent) {
        $breadcrumb->prepend($parent);
    }
@endphp

<div class="container">
    <div class="row">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white">
                @foreach($breadcrumb as $crumb)
                    <x-breadcrumb-item :document="$crumb" :loop="$loop" />
                @endforeach
            </ol>
        </nav>
    </div>
</div>
