<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        // $adFromUser = Ad::where('user_id',auth()->id())->get();
        $adFromUser = Auth::user()->ads;
        return view('home',[
            'adFromUser'=>$adFromUser
        ]);
    }

    public function addDeposit(){
        return view('home.addDeposit');
    }

    public function updateDeposit(Request $request){
        $user = Auth::user();
        $request->validate([
            "deposit"=>"required | max:4"
        ],
    [
        "deposit.max"=>"Cant add more then 9999 $ at once"
    ]);
    $user->deposit = $user->deposit + $request->deposit;
    $user->save();

    return redirect(route('home'))->with('addDeposit','You have successfully added your deposit');
    }

    public function showAddForm(){
        $allCategories = Category::all();
        return view('home.showAddForm',[
            'categories'=>$allCategories
        ]);
    }

    public function saveAd(Request $request){
        $user = Auth::user();
        $request->validate([
            "title"=>'required |max:255',
            "body"=>"required",
            "price"=>"required",
            "image1"=>"mimes:jpg,jpeg,png",
            "image2"=>"mimes:jpg,jpeg,png",
            "image3"=>"mimes:jpg,jpeg,png",
            "category"=>"required"

        ]);
        if($request->hasFile('image1')){
            $image1 = $request->file('image1');
            $image1_name = time().'1.'.$image1->extension();
            $image1->move(public_path('ad_images'),$image1_name);
        }
        if($request->hasFile('image2')){
            $image2 = $request->file('image2');
            $image2_name = time().'2.'.$image2->extension();
            $image2->move(public_path('ad_images'),$image2_name);
        }
        if($request->hasFile('image3')){
            $image3 = $request->file('image3');
            $image3_name = time().'3.'.$image3->extension();
            $image3->move(public_path('ad_images'),$image3_name);
        }
        if($user->deposit>=100){

        Ad::create([
            'title'=>$request->title,
            'body'=>$request->body,
            'price'=>$request->price,
            'image1'=>(isset($image1_name)) ? $image1_name : null,
            'image2'=>(isset($image2_name)) ? $image2_name : null,
            'image3'=>(isset($image3_name)) ? $image3_name : null,
            'user_id'=>Auth::user()->id,
            'category_id'=>$request->category

        ]);
        $user->deposit = $user->deposit-100;
        $user->save();
        return redirect('home')->with('create','You have successfully added your ad!');
    }else{
        return redirect('home')->with('noCreate','We are sorry, the amount of your deposit is not enough to publish the ad. You must have a minimum of 100 tokens.You currently have-'.$user->deposit.' '.'tokens.');

    }

    }

    public function delete($id){
        $ad = Ad::find($id);
        $ad->delete();
        return redirect ('home')->with('delete','You have successfully deleted your ad!');
    }

    public function showSingleAd($id){
        $singleAd = Ad::find($id);
        if($singleAd->user_id != Auth::user()->id){
            $singleAd->increment('views');
        }
        return view('home.singleAd',[
            'singleAd'=>$singleAd
        ]);
    }

    public function showMessages(){
        $messages = Message::where('recipient_id',Auth::user()->id)->get();
       
        return view('home.messages',[
            'messages'=>$messages
        ]);
    }

    public function showSingleMsg($id){
        $msg = Message::find($id);
       
        if($msg->status==0){
            DB::update("UPDATE messages SET status=1 WHERE id=$id");
        return view('showSingleMsg',['msg'=>$msg]);

        }else{
        return view('showSingleMsg',['msg'=>$msg]);

        }
        
    }
    // public function replay(){
    //     $sender_id=request()->sender_id;
    //     $ad_id = request()->ad_id;
    //     $messages = Message::where('sender_id',$sender_id)->where('ad_id',$ad_id)->get();

    //     return view('home.replay','ad_id','messages');

    // }
}
