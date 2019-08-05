@php($rootPage = $documentTree->first())
@php($currentPage = $rootPage)

<ul class="nav flex-column nav-pills">
    <li class="list-group-item">{{ $rootPage->title }}</li>
        @foreach($currentPage->children as $document)
            <li class="nav-link">
                {{ $document->title }}
                @if($childDocuments = $document->children)
                    <ul>
                        @foreach($childDocuments as $childDocument)
                            <li class="list-group-item">
                                {{ $childDocument->title }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach
</ul>