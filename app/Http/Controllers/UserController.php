<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showAll()
    {
        $users = \App\User::where('type','=',NULL)->get();

        return view('users',[
            'users'=>$users,
            
        ]);
       
    }
    public function search(Request $request)
    {
        $output = '';
        $query = $request['query'];
        if($query != '')
      {
       $data = \App\User::where('type','=',NULL)->where('name', 'like', '%'.$query.'%')->get();
         
      }
      else{
        $data = \App\User::where('type','=',NULL)->get();
      }
   
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $user)
       {
        $output.='<a class="chatlink" href="'.route("chat",["id" => $user->id]).'"
        <div class="chat_list">
        <div class="chat_people">
          <div class="chat_ib">
            <h3>'.$user->name.' <span class="chat_date">17/5/2020</span></h3>
            <p>haiiii.</p>
          </div>
            </div>
        </div>
        </a>';
       }

     }
     return response()->json(['users'=>$output]);

    }
}
