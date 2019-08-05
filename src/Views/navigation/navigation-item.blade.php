@php
    $children = $document->children;
    $hasChildren = $children->isNotEmpty();
@endphp

<li class="uk-parent">
    <x-navigation-link :document="$document" />

    @if($hasChildren)
        <div class="uk-navbar-dropdown">
            <ul class="uk-nav uk-navbar-dropdown-nav">
                @foreach($children as $child)
                    <li>
                        <x-navigation-link :document="$child" />
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</li>