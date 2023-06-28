@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-2">
        
        @include('home.partials.sidebar')
    </div>

    <div class="col-8">
        <div class="row">
            <h3 class="display-4">All messages</h3>
        </div>
        <div class="row">
            <div class="col-6 offset-1">
                
                    @foreach ($messages as $msg)
                    <a href="{{ route('showSingleMsg', ['id'=>$msg->id]) }}"class="badge badge-info"style="background-color:{{$msg->status==0 ? 'red' : ''}}">{{$msg->sender->name}}</a>
                    <p><small>{{$msg->created_at->format('d M Y')}}</small></p>
                    
                    
                        
                    @endforeach
                
               
            </div>
            
        </div>
    </div>



    
   </div>
</div>
@endsection
