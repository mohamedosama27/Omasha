<?php

namespace App\Http\Controllers;

use App\message;
use Illuminate\Http\Request;
use DB;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages= DB::table('mails')->select('*')->where('status',0)->get();
        return view('view_mails_admin', ['messages'=>$messages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $message = new  \App\message;
        $message->message = $request['message'];
        $message->sender_id = auth()->id();
        if(auth()->user()->type==NULL){
        $message->recivier_id = '0';
        }
        else{
            $message->recivier_id =$request['id'];
        }
        $message->save();
        $output='
      <div class="container darker right" style="margin-bottom:50px" >
        
        <p>'.$message->message.'</p> <span class="time-right">'.$message->created_at.'</span>
      </div>';
        return response()->json(['output'=>$output]);
    }
    public function getmessage(Request $request)
    {
        if(auth()->user()->type==NULL){   
        $messages = \App\message::where('recivier_id','=',auth()->id())
        ->Where('status','=',NULL)->get();
        }
        else{
            $messages = \App\message::where('recivier_id','=',0)
        ->Where('status','=',NULL)->get();
        }
        $output='';
        foreach($messages as $message){
            $message->status=1;
            $message->save();
        $output.='
        <input id="id" value="'.$message->sender_id.'" hidden/>

      <div class="container left" style="margin-bottom:50px" >
        
        <p>'.$message->message.'</p> <span class="time-right">'.$message->created_at.'</span>
      </div>';
        }
        return response()->json(['output'=>$output]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Answer=$request->Answer;
        DB::table('mails')
            ->where('id',$_GET['hiddenMessageID'])
            ->update(['answer' =>$Answer ,'status' => 1]);

        return redirect('/viewmails');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        if(auth()->user()->type==NULL){   

        $messages = \App\message::where('sender_id','=',auth()->id())
                                ->orWhere('recivier_id','=',auth()->id())->get();
        }
        else{
            $messages = \App\message::where('sender_id','=',0)
                                ->orWhere('recivier_id','=',0)->get();

        }
            
            return view('chat',[
                'messages'=>$messages,
            ]);
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function edit(mail $mail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, mail $mail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\mail  $mail
     * @return \Illuminate\Http\Response
     */
    public function destroy(mail $mail)
    {
        //
    }
}
