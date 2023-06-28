@section('title')
Ads from User
    
@endsection
@extends('layouts.app')
@section('content')

<div class="container">
    <div class="jumbotron text-center">
        <h3 class="display-4">All ads from {{$allAds[0]->user->name}}</h3>
    </div>
    @include('templates/allAdsTemplate')
</div>
    
@endsection