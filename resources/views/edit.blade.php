@section('title')
Edit
    
@endsection
@extends('layouts.app')
@section('content')

<h4 class="display-4 text-center">Edit</h4>

    <div class="row">
        <div class="col-6 offset-3">
            <form action="{{ route('update', ['id'=>$ad->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="title">Title</label>
                <input type="text" name="title" value="{{$ad->title}}" class="form-control"><br>

                <label for="price">Price</label>
                <input type="number" name="price" value="{{$ad->price}}" class="form-control"><br>
                <label for="category">Category</label>
                <select name="category" class="form-control">
                    <option value="{{$ad->category->id}}">{{$ad->category->name}}</option>
                    @foreach ($category as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                    @endforeach
                </select><br>

                <label for="body">Description</label>
                <textarea name="body"class="form-control" cols="30" rows="10">{{$ad->body}}</textarea><br>

                <input type="hidden" value="{{$ad->image1}}" name="img1old">
                <img src="/ad_images/{{$ad->image1}}"style="width: 205px;height:100px">

                <input type="hidden" value="{{$ad->image2}}" name="img2old">
                <img src="/ad_images/{{$ad->image2}}" style="width: 205px;height:100px">

                <input type="hidden" value="{{$ad->image3}}" name="img3old">
                <img src="/ad_images/{{$ad->image3}}"style="width: 205px;height:100px"><br><br>

                <input type="file" name="image1" class="form-control"><br>
                <input type="file" name="image2" class="form-control"><br>
                <input type="file" name="image3" class="form-control"><br>

                <button class="btn btn-primary form-control" type="submit">Save</button>



            </form>
        </div>
    </div>
@endsection