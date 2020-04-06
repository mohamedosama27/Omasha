@extends('bar')

@section('content')
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="csrf-token" content="{{ csrf_token() }}" />

<style>
.chat {
    
  margin: 0 auto;
  padding: 0 20px;
}

.container {
  background-color: #f1f1f1;
  height:auto;
  width:100%;
  border-radius: 5px;
  padding-top: 10px;
  margin: 10px;
  margin: 10px 0;
  

}
.left::before{
    width: 0;
    height: 0;
    content:"";
    top:-5px;
    left:-23px;
    position:relative;
    border-style: solid;
    border-width: 0 13px 13px 0;
    border-color: transparent #f1f1f1 transparent transparent;            
}
.right::after{
    width: 0;
    height: 0;
    content:"";
    top:-5px;

    left:calc(100% + 10px);
    position:relative;
    border-style: solid;
    border-width: 13px 13px 0 0;
    border-color:  #ddd transparent transparent transparent;           
}  

.darker {
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}




.time-right {
  float: right;
  color: #aaa;
}
.footer {
    height:50px;
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: white;
   color: black;
   
}
@media (min-width:992px){
    .footer {
        margin-left:300px;
        width:80%;

    }
    
  
}
.messageinput{
    margin:5px;
    width:85%;
    display:inline;
}
.messagebutton{
    background-color: blue;
    border:none;

    border-radius: 50%;
}
.sendicon{
    color:white;
}

</style>
<div class=" chat">

@foreach($messages as $message)
@if($message->sender_id != Auth::user()->id)

<input id="id" value="{{$message->sender_id}}" hidden/>
<div class="container left"  @if($loop->last) style="margin-bottom:50px" @endif>
  <p>{{$message->message}}</p>
  <span class="time-right">{{$message->created_at}}</span>
</div>
@else
<div class="container darker right" @if($loop->last) style="margin-bottom:50px" @endif>
  
  <p>{{$message->message}} </p> <span class="time-right">{{$message->created_at}}</span>
</div>
@endif
@endforeach
<div class="footer">

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
setInterval(getmessage, 1000);

$(document).on("click", '.btn-send', function(e) { 

    e.preventDefault();
   
        var message =  $("#message"). val();
        var id =  $("#id"). val();
    $.ajax({

        type:'POST',
        _token: $('meta[name=csrf_token]').attr('content'),

        url:"{{ route('sendmessage') }}",

        data:{message:message,id:id},
        datatype:'json',

        success:function(data){
            $("#message").val('');
            $('.container').css('margin-bottom','0px')
            $( ".chat" ).append( $( data.output ) );
       $(function(){
    $('html, body').animate({scrollTop: $(document).height()-$(window).height()}, 0);
      });
        }

    });

});
function getmessage() { 



    var message =  $("#message"). val();

$.ajax({

    type:'POST',
    _token: $('meta[name=csrf_token]').attr('content'),

    url:"{{ route('getmessage') }}",

    data:{message:message},
    datatype:'json',

    success:function(data){
      if(data.output!=''){
        $('.container').css('margin-bottom','0px')
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
