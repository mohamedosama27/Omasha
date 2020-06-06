@extends('bar')

@section('content')
<style>
    label {
        margin:5px;
    }
    input{
        margin:10px;
    }
.custom-file-input{
    background-color:white;
}
</style>
<script>
var form=documentElementById('upload');
var request = new XMLHttpRequest();
form.addEventLisener('submit,function(e){
    e.preventDefault();
    var formdata = new FormData(form);

    request.open('post','/createitem');
    request.addEventListener('load',transferComplete);
    request.send(formdata);
    });
    function transferComplete(data){
        console.log(data.currentTarget.response);
        
    }
</script>
{{--Form of inserting a new Item--}}

    <form method="POST" action="{{route('item.store')}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
        <h1 class="text-center">New item</h1>

            <label>Item Name</label>
            <input type="Text" class="form-control" Name="name" placeholder="Item Name" value="{{ old('name') }}" required>
            @error('name')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror  
            <label>Bar Code</label>
            <input type="Text" class="form-control" Name="barcode" placeholder="Bar code" value="{{ old('name') }}" required>
            @error('barcode')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror  
            <label >Description</label>
            <input type="Text" class="form-control" Name="description" placeholder="Description" value="{{ old('description') }}">
            @error('Description')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror  
            <label>Price</label>
            <input type="Text" class="form-control" Name="price" placeholder="EGP..." value="{{ old('price') }}" required>
            @error('price')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
            <label>Cost</label>
            <input type="Text" class="form-control" Name="cost" placeholder="EGP..." value="{{ old('cost') }}" required>
            @error('cost')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
            <label>Quantity</label>
            <input type="Text" class="form-control" Name="quantity" placeholder="Quantity" value="{{ old('quantity') }}" required>
            @error('quantity')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
            <label>Choose images</label>
            
            <div class="custom-file">
            <input type="file"  id="validatedCustomFile" Name="img[]"  accept="image/*" multiple>
            <!-- <label class="custom-file-label" for="validatedCustomFile">Choose file...</label> -->
            </div>
            <!-- <script>
             $('.custom-file input').change(function (e) {
                var files = [];
               
                $(this).next('.custom-file-label').html("you choose : "+ $(this)[0].files.length+" images");
            });
            </script> -->
          

             <div class="form-group">
                    <label for="sel1" Name="Category">Category</label>
                    <select class="form-control" id="sel1" Name="category">
                    <option value="" disabled selected>Choose your option</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    </select>
                    </div>
                    <div class="form-group">
                    <label for="sel1" Name="Category">Product type</label>
                    <select class="form-control" id="sel1" Name="product">
                    <option value="" disabled selected>Choose your option</option>
                        <option value="0">Socks</option>
                        <option value="1">Wristbands</option>
                    </select>
            </div>
                    <button type="submit" class="w3-btn btn-block w3-round-xxlarge w3-blue" style="margin-bottom:10px;">ADD</button>

            <br>
            <br>

    </form>


@endsection
