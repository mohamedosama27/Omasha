@extends('bar')

@section('content')
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="csrf-token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="/css/chat.css">

<div class=" chat">
<input id="senderid" value="{{$sender_id}}" hidden/>
<input type="number" id="countMessages" value="{{count($messages)}}" hidden/>
@foreach($messages as $message)
@if($message->sender_id == Auth::user()->id)

<div class="msg-right msg" @if($loop->last) style="margin-bottom:50px" @endif>
  
 {{$message->message}} 
</div>
<br clear="all" />

@elseif($message->sender_id == 0 && Auth::user()->type==1)


<div class="msg-right msg" @if($loop->last) style="margin-bottom:50px" @endif>
  
{{$message->message}} 
</div>
<br clear="all" />


@else
<div class="msg-left msg"  @if($loop->last) style="margin-bottom:50px" @endif>
{{$message->message}}
</div>

<br clear="all" />
@endif
@endforeach
<div class="chatfooter">

<input class="form-control messageinput" id="message" autocomplete="off">
  <button type="button" class="messagebutton btn-send"> <i class="fa fa-paper-plane sendicon" ></i></button>
</div>

<div>

<script type="text/javascript">

   

$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

});
setInterval(getmessage, 2000);
$(document).on("click", '.btn-send', function(e) { 

    e.preventDefault();
   
        var message =  $("#message"). val();
        var id =  $("#senderid"). val();
    $.ajax({

        type:'POST',
        _token: $('meta[name=csrf_token]').attr('content'),

        url:"{{ route('sendmessage') }}",

        data:{message:message,id:id},
        datatype:'json',

        success:function(data){
            $("#message").val('');
            $('.msg').css('margin-bottom','0px')
            $( ".chat" ).append( $( data.output ) );
            if($("#countMessages").val()==0){
                $("#countMessages").val('1')
                automatedmessage();  
            }
       $(function(){
    $('html, body').animate({scrollTop: $(document).height()-$(window).height()}, 0);
      });
        }

    });

});
function getmessage() { 

    var sender_id =  $("#senderid"). val();

$.ajax({

    type:'POST',
    _token: $('meta[name=csrf_token]').attr('content'),

    url:"{{ route('getmessage') }}",

    data:{sender_id:sender_id},
    datatype:'json',

    success:function(data){
      if(data.output!=''){
        $("#countMessages").val('1')
        $('.msg').css('margin-bottom','0px')
        $( ".chat" ).append( $( data.output ) );
        $(function(){
$('html, body').animate({scrollTop: $(document).height()-$(window).height()}, 0);
  });
    }
  
    }

});

}
function automatedmessage() { 


$.ajax({

type:'POST',
_token: $('meta[name=csrf_token]').attr('content'),

url:"{{ route('automatedmessage') }}",

data:{},
datatype:'json',

success:function(data){

  if(data.output!=''){
    $('.msg').css('margin-bottom','0px')
    $( ".chat" ).append( $( data.output ) );
    $(function(){
$('html, body').animate({scrollTop: $(document).height()-$(window).height()}, 0);
});
}

}

});

}
$(function(){
    $('html, body').animate({scrollTop: $(document).height()-$(window).height()}, 0);
});
</script>
@endsection
