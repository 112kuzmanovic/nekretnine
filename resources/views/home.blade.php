@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-2">
        
        @include('home.partials.sidebar')
    </div>





    <div class="col-10">
        <div class="row">
            <div class="col-10">
                <div class="row">
                    @foreach ($adFromUser as $ad)
                        <a href="{{ route('home.singleAd', ['id'=>$ad->id]) }}"style="text-decoration:none">
                            <div class="card mt-4 ml-4">
                                <div class="card-header"><img src="ad_images/{{$ad->image1}}" style="width: 300px;height:200px"></div>
                                <div class="card-body">
                                    <h5>{{$ad->title}}</h5>
                                    <button class="btn btn-outline-success btn-sm float-left mb-1">{{$ad->price}} KM</button>
                                    <span class="badge badge-primary badge-pill p-1 float-right">Pregleda:{{$ad->views}}</span>

                                </div>
                                <div class="card-footer">
                                    <a href="{{ route('delete', ['id'=>$ad->id]) }}"class="badge badge-danger badge-pill float-left">Delete</a>
                                    <a href="{{ route('edit', ['id'=>$ad->id]) }}"class="badge badge-warning badge-pill float-right">Update</a>

                                </div>
                            </div>
                        </a>
                
                    @endforeach

                </div>
            </div>
        </div>
        
            
        
    </div>
   </div>
</div>
@endsection
