
  <div class="modal fade" id="addaddress">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title text-center raleway">Add order address</h4>
          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
        <form method="POST" action="{{route('checkout')}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
          <textarea class="form-control" Name="address" placeholder="Enter address in details here .." required></textarea>
         <br>
          <select class="form-control"  Name="city" id="city">
                    <option value="" disabled selected>Choose city</option>
                    @foreach($fees as $fee)
                      <!-- <label id = "{{$fee->id}}" hidden>{{$fee->value}}" </label> -->
                        <option value="{{$fee->id}}" data-value="{{$fee->value}}">{{$fee->name}}</option>
                    @endforeach
                    </select>

          <br clear="all"/>

          <div class="price invoice pull-right">
            <label class="raleway">Shipping : </label>
            <div class="totals-value inline" id="cart-tax"></div>
          </div>
    <br clear="all"/>
   
    <!-- <div class="price invoice pull-right">
      <label class="raleway" data-value="{{$totalprice}}">Total Price : </label>
      <div class="inline" id="cart-total"></div>
    </div>
    <br clear="all"/> -->

        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="submit" name="submit" class="btn brandcolor" style="color:white;">Checkout</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

        </div>
        </form>
        
      </div>
    </div>
  </div>