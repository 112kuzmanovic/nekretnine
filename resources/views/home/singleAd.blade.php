@section('title')
SingleAd
    
@endsection
@extends('layouts.app')

@section('content')
<div class="glavni">
    <div class="naslov text-center">
        <h4 class="display-4">{{$singleAd->title}}</h4>
        <a href="{{ route('adsFromUser', ['id'=>$singleAd->user->id]) }}" class="badge badge-danger badge-pill">{{$singleAd->user->name}}</a>
        <a href="{{ route('cat', ['id'=>$singleAd->category->id]) }}" class="badge badge-warning badge-sm">{{$singleAd->category->name}}</a>
        <p>Datum objave:<small>{{$singleAd->created_at}}</small></p>
        <span class="badge badge-primary badge-pill p-1">Pregleda:{{$singleAd->views}}</span>

    </div><br>


    <div class="img1">
        @if (isset($singleAd->image1))
        <img src="/ad_images/{{$singleAd->image1}}" id="current">
            
        @endif
    </div>


    <div class="img2">
        @if (isset($singleAd->image1))
        <img src="/ad_images/{{$singleAd->image1}}" class="second">
        @endif

        @if (isset($singleAd->image2))
        <img src="/ad_images/{{$singleAd->image2}}" class="second">    
        @endif
        
        @if (isset($singleAd->image3))
        <img src="/ad_images/{{$singleAd->image3}}" class="second">
        @endif
    </div><br>


    <p class="text-center">{{$singleAd->body}}</p>
    @if (auth()->check() && $singleAd->user->id != Auth::user()->id)
    <form action="{{ route('sendMsg', ['id'=>$singleAd->id]) }}" method="POST">
        @csrf
        <textarea name="msg" id="" cols="80" rows="5" class="form-control" placeholder="Send message to {{$singleAd->user->name}}"></textarea>
        <button class="btn btn-primary form-control"type="submit">Send</button>
    </form>
        
    @endif
</div>
@endsection

@section('scripts')
    <script>
        var current=document.getElementById('current');
        var slike=document.getElementsByClassName('second');

        for(var i=0;i<slike.length;i++){
        slike[i].addEventListener('click',display);
        }
        function display(){
        var sl=this.getAttribute('src');
        current.setAttribute('src',sl);
        }
    </script>
@endsection