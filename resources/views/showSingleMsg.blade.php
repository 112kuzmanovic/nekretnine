@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-2">
        
        
    </div>

    <div class="col-4">
        <div class="row">
            <span class="badge badge-warning badge-pill">{{$msg->sender->name}}</span>

        </div>
        <div class="row">
            <div class="col-8">
                <p><small class="float-left">{{$msg->created_at->format('d M Y')}}</small></p>
                <p><strong>{{$msg->text}}</strong></p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-3">
                <form action="{{ route('replay') }}" method="POST">
                    @csrf
                    <input type="hidden" name="sender_id" value="{{$msg->sender->id}}">
                    <input type="hidden" name="ad_id" value="{{$msg->ad->id}}">
                    <textarea name="text" id="" cols="25" rows="3" required></textarea>
                    <button class="badge badge-info form-control float-left">Replay</button>
                </form>
                <a href="{{ route('deleteMsg', ['id'=>$msg->id]) }}" class="badge badge-danger badge-pill">Delete</a>
            </div>
        </div>
    </div>



    
   </div>
</div>
@endsection
