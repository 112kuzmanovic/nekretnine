@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-4">
        @include('home.partials.sidebar')
    </div>





    <div class="col-8">
        <form action="{{ route('home.saveAd') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <select name="category" class="form-control">
                @foreach ($categories as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select><br>
            <input type="text" name="title" class="form-control" style="background-color:{{$errors->has('title') ? 'red' : ''}}" placeholder="title"><br>
            <textarea name="body" class="form-control"placeholder="body" cols="30" rows="10"style="background-color:{{$errors->has('body') ? 'red' : ''}}" placeholder="title"></textarea><br>
            <input type="number" name="price" placeholder="price" class="form-control" style="background-color:{{$errors->has('price') ? 'red' : ''}}" placeholder="title"><br>
            <input type="file"name="image1"class="form-control"><br>
            <input type="file"name="image2"class="form-control"><br>
            <input type="file"name="image3"class="form-control"><br>

            <button type="submit" class="btn btn-info">Save</button>
        </form>
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                Error! Please try again.
            </div>       
        @endif
    </div>
   </div>
</div>
@endsection