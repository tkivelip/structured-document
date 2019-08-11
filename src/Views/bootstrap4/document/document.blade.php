@extends('lsd::layout.base')

@section('document_title', $document->title)

@section('body')
    <div class="container">
        <lsd::render :item="$document->layer('jumbotron')"/>
        <lsd::render :item="$document->layer('teaser')"/>
    </div>
@endsection