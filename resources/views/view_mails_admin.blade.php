@extends('bar')

@section('content')

@php
    session_start();
@endphp

<style>
x
</style>

<?php
if(isset($_GET['Reply'])){
echo "<script>alert('Message delivered')</script>";
DB::table('mail_us')
    ->where('MessageID',$_GET['hiddenMessageID'])
->update(['Answer' => $_GET['Answer'],'Status' => 'Answered']);
echo "<script>window.location='Mail_us_Admin'</script>";
}
?>

<body>



<div class="container" style='width:100%'>
    <h1 align='center'>Mail Inbox</h1> <br>
    <h3 align='left'>Messages</h3> <br>
    <?php $message_Count=0;?>


    <table class="table table-hover">
        <th>Message ID</th>
        <th>Question</th>
        <th>From</th>
        <th>Answer</th>
        <th>Reply Button</th>

        @foreach($messages as $message)
            <?php  $message_Count+=1;?>

            <form method='get' action='Mail_us_Admin?action=add&MessageID={{$message->id}};'>
                <tr>
                    <td>{{$message->id}}</td>
                    <td>{{$message->message}}</td>
                    <td>{{$message->sender_id}}</td>
                    <td><textarea class="form-control" rows="5" style="width:100%;" name="Answer"></textarea></td>
                    <td><input type='submit' name='Reply' style='margin-top:5px;' class='btn btn-sucess' value='Reply'>
                    </td>

                    <input type="hidden" name="hiddenMessageID" value={{$message->id}}>
                </tr>
            </form>
        @endforeach
        <h5 align='left'>You have <?php echo $message_Count;?> unopened messages.</h5> <br>
    </table>
</div>

</body>
</html>
@endsection

