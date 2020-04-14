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
    
    public function getSenders()
    {
        $messages = \App\message::where('recivier_id','=','0')
            ->Where('status','=',NULL)->get()->keyBy('sender_id');
            $output='';
            foreach($messages as $message){
                $output.='<a class="chatlink" href="'.route("chat",["id" => $message->sender->id]).'"
                <div class="chat_list">
                <div class="chat_people">
                  <div class="chat_ib">
                    <h3>'.$message->sender->name.' <span class="chat_date">'.$message->created_at.'</span></h3>
                    <p>'.$message->message.'.</p>
                  
                    </div>
                </div>
              </div>
              </a>';
            }
            return response()->json(['senders'=>$output]);
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
        ->Where('status','=',NULL)->Where('sender_id','=',$request['sender_id'])->get();
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
    public function automatedmessage(Request $request)
    {
        if(auth()->user()->type==NULL)
        {
        $message = $this->createmessage("Thanks",'0',auth()->id());
        $message->status=1;
        $message->save();
        
        $output='
      <div class="msg-left msg" style="margin-bottom:50px" >
        Thanks
      </div><br clear="all" />
      ';
        
        return response()->json(['output'=>$output]);
        }
        else{
            return response()->json(['output'=>'']);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function countmessage(Request $request)
    {
        if(auth()->user()->type!=1){   
            $messages = \App\message::where('recivier_id','=',auth()->id())
            ->Where('status','=',NULL)->count();
            }
        else
        {
            $messages = \App\message::where('recivier_id','=','0')
            ->Where('status','=',NULL)->count();
        }
        
            return response()->json(['countmessages'=>$messages]);


    }



    public function show($id)
    {
        if(auth()->user()->type==1 || auth()->user()->id == $id)
        {
           
        $messages = \App\message::where('sender_id','=',$id)
                                ->orWhere('recivier_id','=',$id)->orderBy('id')->get();
                         
      
        foreach($messages as $message){
            if($message->recivier_id==auth()->user()->id){
        $message->status=1;
        $message->save();
            }
            if(auth()->user()->type==1 && $message->recivier_id=='0'){
                $message->status=1;
                $message->save();
            }
    }
            
            return view('chat',[
                'messages'=>$messages,
                'sender_id'=>$id
            ]);
        
            }
            else{
                abort(404);
            }
    }

   
    public function changeStatus($id)
    {
        $message = \App\message::find($id);
        $message->status=2;
        $message->save();

        return redirect()->back();
    }

    
}
