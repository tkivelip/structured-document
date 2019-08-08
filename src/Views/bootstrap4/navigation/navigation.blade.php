@php($current = $root = $tree->first())

<nav class="uk-navbar uk-container" uk-navbar="mode: click">
    <div class="uk-navbar-left">
        <div class="uk-navbar-item">
            <div><a href="/">Laramate Nucid</a></div>
        </div>
        <ul class="uk-navbar-nav">
            @foreach($current->children as $document)
                <x-navigation-item :document="$document" />
            @endforeach
        </ul>
    </div>
</nav>