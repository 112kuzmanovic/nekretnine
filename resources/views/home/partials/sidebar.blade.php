<a href="{{ route('adsFromUser', ['id'=>Auth::user()->id]) }}" class="btn btn-danger form-control m-2">{{Auth::user()->name}}</a><br><br><br>
<a href="" class="btn btn-success form-control m-2">Deposit:{{(Auth::user()->deposit) ? Auth::user()->deposit : 0}}</a>
<a href="{{ route('home.addDeposit') }}" class="btn btn-secondary form-control m-2">Add deposit</a>
<a href="{{ route('home.showMessages') }}" class="btn btn-secondary form-control m-2" style="background-color:">Messages:{{count($msg)}}</a>
<a href="{{ route('home.showAddForm') }}" class="btn btn-info form-control m-2">New Ad</a>
        


