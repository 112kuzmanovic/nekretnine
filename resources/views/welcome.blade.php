@section('title')
Home page
    
@endsection
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="jumbotron text-center">
            <h3 class="display-4">All Ads</h3>
            @include('templates/filter')
        </div>
        @include('templates/allAdsTemplate')
    </div>
@endsection