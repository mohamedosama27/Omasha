
  <div class="modal fade" id="send_mails">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">
        <form id="subscribe">
    <!-- @csrf
    @method('PUT') -->
          <textarea class="form-control" id="message" placeholder="Enter message here .." required></textarea>


   
        </div>
        
        <div class="modal-footer">
          <button type="submit" name="submit" class="btn btn-primary">Send</button>

        </div>
        </form>
        
      </div>
    </div>
  </div>



  <script type="text/javascript">

  $('#subscribe').on('submit',function(event){
      event.preventDefault();

      sending="Sending..."
      $('#messaga').text(sending);
      $('#errormessage').modal();

      message = $('#message').val();
      $('#send_mails').modal('toggle');

      // $.ajax({
      //   url: "{{route('send-mails')}}",
      //   type:"POST",
      //   data:{       
      //     message:message,
      //   },
      //   success:function(response){
      //     $("#message").val('');
      //     $('#messaga').text('Sent Successfully');

      //   },
      // });
      $.post("{{route('send-mails')}}", {message:message},
        
        function(result){
                  $('#messaga').text('Sent Successfully');

         });
      });
  </script>