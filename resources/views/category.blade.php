
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron text-center">
        <h3 class="display-4">{{$catName->name}}</h3>
        
    </div>
    @include('templates/allAdsTemplate')
</div>
    
@endsection