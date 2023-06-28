<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdController extends Controller
{
    public function index(){
        $allAds = new Ad;
        $of = request()->priceOf;
        $to = request()->priceTo;
        $cat = request()->category;
        
        if(isset(request()->priceOf) || isset(request()->priceTo)){
            if($of==null){
                $of=0;
            }
            if($to==null){
                $to=1000000000;
            }
            $allAds =Ad::where('category_id',$cat)->whereBetween('price',[$of,$to]);
           
           
        }
          
            $allAds = $allAds->get();
            return view('welcome',compact('allAds'));
           
            
        

        
    }

    public function showCat($id){
        $catName = Category::find($id);
        $category = Ad::where('category_id',$id)->get();
        return view('category',['allAds'=>$category,'catName'=>$catName]);
    }

    public function adsFromUser($id){
        $adsFromUser = Ad::where('user_id',$id)->get();
        return view('adsFromUser',[
            'allAds'=>$adsFromUser
        ]);
    }

    public function edit($id){
        $ad = Ad::find($id);
        return view('edit',[
            'ad'=>$ad
        ]);
    }

    public function update(Request $request,$id){
        $title = $request->title;
        $price = $request->price;
        $body = $request->body;
        $category_id = $request->category;
        $user_id = Auth::user()->id;
        
       

        $request->validate([
            'title'=>'required',
            'price'=>'required',
            'image1'=>'mimes:jpg,jpeg,png',
            'image2'=>'mimes:jpg,jpeg,png',
            'image3'=>'mimes:jpg,jpeg,png',

        ]);
        if($request->hasFile('image1')){
            $image1 = $request->file('image1');
            $image1_name = time().'1.'.$image1->extension();
            $image1->move(public_path('ad_images'),$image1_name);
        }else{
            $image1_name = $request->img1old;
        }
        if($request->hasFile('image2')){
            $image2 = $request->file('image2');
            $image2_name = time().'2.'.$image2->extension();
            $image2->move(public_path('ad_images'),$image2_name);
        }else{
            $image2_name = $request->img2old;
        }
        if($request->hasFile('image3')){
            $image3 = $request->file('image3');
            $image3_name = time().'3.'.$image3->extension();
            $image3->move(public_path('ad_images'),$image3_name);
        }else{
            $image3_name = $request->img3old;
        }
        if(Auth::user()->deposit>=10){
            Auth::user()->save();
        DB::update("UPDATE ads SET title= :title,price= :price,body= :body,image1= :image1,image2= :image2,image3= :image3,user_id= :user_id,category_id= :category_id WHERE id= :id",['id'=>$id,'title'=>$title,'body'=>$body,'price'=>$price,'image1'=>(isset($image1_name)) ? $image1_name : null,'image2'=>(isset($image2_name)) ? $image2_name : null,'image3'=>(isset($image3_name)) ? $image3_name : null,'user_id'=>$user_id,'category_id'=>$category_id]);

        Auth::user()->deposit =Auth::user()->deposit-10;
        return redirect('home')->with('update','You have successfully made changes to your ad');

        }else{
            return redirect('home')->with('noUpdate','We are sorry, the amount of your deposit is not enough to update the ad. You must have a minimum of 10 tokens.You currently have-'.Auth::user()->deposit.' '.'tokens.');
        }
        
        
    }
    public function sendMsg(Request $request){
        $ad = Ad::find($request->id);
        $ad_owner = $ad->user->id; //vlasnik oglasa
        //nova poruka
        $new_msg = new Message();
        $new_msg->text = $request->msg;
        $new_msg->sender_id = Auth::user()->id;
        $new_msg->recipient_id = $ad_owner;
        $new_msg->ad_id = $ad->id;
        $new_msg->status=0;
        $new_msg->save();

        return redirect()->back()->with('Message','Message sent');
    }

    public function replay(Request $request){
        $sender =User::find($request->sender_id);
        $ad = Ad::find($request->ad_id);
        $text = $request->text;
        $new_replay = new Message();
        $new_replay->text = $text;
        $new_replay->sender_id = Auth::user()->id;
        $new_replay->recipient_id = $sender->id;
        $new_replay->ad_id = $ad->id;
        $new_replay->status = 0;
        $new_replay->save();

        return redirect('home')->with('Message','Message sent');
    }

    public function deleteMsg($id){
        $msg = Message::find($id);
        $msg->delete();
        return redirect('home')->with('deleteMsg','The message has been deleted');
    }
   
}
