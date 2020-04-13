@extends('bar')

@section('content')
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}" />

<input type="text" name="search" id="search" class="form-control" placeholder="Search by name"/>
<div id="result">
@foreach($messages as $message)
<a class="chatlink" href="{{route('chat',['id' => $message->sender->id])}}">
                <div class="chat_list">
                <div class="chat_people">
                  <div class="chat_ib">
                    <h3>{{$message->sender->name}} <span class="chat_date">{{$message->created_at}}</span></h3>
                    <p>{{$message->message}}</p>                 
                  </div>
                </div>
              </div>
              </a>
 @endforeach 
 </div>
 <script type="text/javascript">

   

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });
    $(document).on('keyup', '#search', function(e)
    {
        e.preventDefault();


        var query = $(this).val();

        $.ajax({

        type:'POST',

        url:"{{ route('user.search') }}",

        data:{query:query},

        success:function(data)
        {

            $('#result').html(data.users);

        }

        });

        
    });
</script>
@endsection
