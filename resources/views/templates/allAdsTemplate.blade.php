<div class="col-12 ">
    <div class="row">
        <div class="col-12">
            <div class="row">
                @foreach ($allAds as $ad)
            <a href="{{ route('home.singleAd', ['id'=>$ad->id]) }}" style="text-decoration: none">
                <div class="card mt-4 ml-4">
                    <div class="card-header">
                        <img src="/ad_images/{{$ad->image1}}" style="width: 300px;height:200px">
                    </div>
                    <div class="card-body">
                        <h6 class="float-left">{{$ad->title}}</h6>
                        <span class="badge badge-warning badge-pill p-1 float-right">Pregleda:{{$ad->views}}</span>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success btn-sm float-left">{{$ad->price}} KM</button>
                        <a href="{{ route('adsFromUser', ['id'=>$ad->user_id]) }}" class="badge badge-info badge-sm float-right">{{$ad->user->name}}</a><br>

                    </div>
                </div>
            </a>
                
            @endforeach
            </div>
        </div>
    </div>
</div>