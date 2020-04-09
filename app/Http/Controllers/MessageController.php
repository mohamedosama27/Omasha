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
        $messages= \App\message::where('recivier_id','=','0')
        ->Where('status','=','1')->get();
        return view('view_mails_admin', ['messages'=>$messages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function createmessage($message,$sender,$recivier)
    {
        $Newmessage = new  \App\message;
        $Newmessage->message = $message;
        $Newmessage->sender_id =$sender;
        $Newmessage->recivier_id =$recivier;

        $Newmessage->save();
        return $Newmessage;

    }
    public function create(Request $request)
    {
     
        if(auth()->user()->type==NULL)
        {
        $message = $this->createmessage($request['message'],auth()->id(),'0');

        }
        else{
        $message = $this->createmessage($request['message'],'0',$request['id']);

            
        }
        $output='
      <div class="msg-right msg" style="margin-bottom:50px" >
        
       '.$message->message.'
      </div>       <br clear="all" />
      '
      ;
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
        <input id="senderid" value="'.$message->sender_id.'" hidden/>

      <div class="msg-left msg" style="margin-bottom:50px" >
        
        '.$message->message.'
      </div><br clear="all" />
      ';
        }
        return response()->json(['output'=>$output]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function countmessage(Request $request)
    {
        if(auth()->user()->type==NULL){   
            $messages = \App\message::where('recivier_id','=',auth()->id())
            ->Where('status','=',NULL)->count();
            }
            return response()->json(['countmessages'=>$messages]);


    }
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
    public function show($id)
    {
        
        $messages = \App\message::where('sender_id','=',$id)
                                ->orWhere('recivier_id','=',$id)->get();
       
      
        foreach($messages as $message){
        $message->status=1;
        $message->save();
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
