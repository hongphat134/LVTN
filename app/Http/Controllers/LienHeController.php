<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LienHe;
use Mail;

class LienHeController extends Controller
{
    //
    public function getContact(){
    	return view('pages.contact');
    }

    public function sendMessage(Request $rq){
    	$post = new LienHe;

    	$post->from_email = $rq->email;
    	$post->ho = $rq->fname;
    	$post->ten = $rq->lname;
    	$post->tieude = $rq->subject;
    	$post->noidung = $rq->message;

    	$post->remember_token = $rq->_token;

    	$post->save();

    	return redirect()->route('notification')->with(['alert' => 'Bạn đã gửi form liên hệ thành công! Cảm ơn bạn đã quan tâm! Hãy đợi phản hồi từ chúng tôi nhé!']);
    }

    public function reponseMessage(Request $rq,$id){
        // Set trạng thái = true
        $user = LienHe::find($id);

        $repond = $rq->message;
       
    	// Gửi Mail => Thành công hay thất bại cũng đéo bik :D (Hàm chả trả về cm gì cả?)
        Mail::send('emails.contact', 
            ['user' => $user, 'repond' => $repond], 
            function ($m) use ($user) {
            // $m->from('hello@app.com', 'Your Application');
            
            $m->to($user->from_email, $user->ten)->subject('Thông tin liên hệ HTP!');
        });

        $user->trangthai = 1;
        $user->update();

        return redirect()->back()->with(['success' => "Phản hồi thông tin $id thành công!"]);
    }
}