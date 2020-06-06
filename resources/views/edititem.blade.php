@extends('bar')

@section('content')
<style>
    label {
        margin:5px;
    }
    input{
        margin:10px;
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

    <form method="POST" action="{{route('item.update',['id' => $item->id])}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <h1 class="text-center">Edit item</h1>

            <label  >Item Name</label>
            <input @if($item->name) value="{{$item->name}}"@endif type="Text" class="form-control" id="text" Name="name" placeholder="Item Name" required>
            <label  >Bar Code</label>
            <input @if($item->barcode) value="{{$item->barcode}}" @endif type="Text" class="form-control" id="text" Name="barcode" placeholder="Bar code" required>

            <label  >Description</label>
            <input @if($item->description) value="{{$item->description}}"@endif type="Text" class="form-control" id="text" Name="description" placeholder="Description">

            <label  >Price</label>
            <input @if($item->price) value="{{$item->price}}"@endif type="Text" class="form-control" id="text" Name="price" placeholder="EGP..." required>
            <label  >Cost</label>
            <input @if($item->cost) value="{{$item->price}}"@endif type="Text" class="form-control" id="text" Name="cost" placeholder="EGP..." value="{{ old('cost') }}" required>
            @error('cost')
                                     <span role="alert" style="color:red;">
                                        <strong>{{ $message }}</strong>
                                    </span><br>
                                @enderror
            <label  >Quantity</label>
            <input @if($item->quantity) value="{{$item->quantity}}"@endif type="Text" class="form-control" id="text" Name="quantity" placeholder="Quantity" required>
            <label >Delete images</label>

            <table class="table">
           
            <tbody>
            @forelse($item->images as $image)
                <tr>
                <th scope="row"><img height="150" width="110" src={{ URL::asset("images/{$image->name}")}}></th>
                <td><a href="{{route('image.delete',['id' => $image->id])}}">
                <button type="button" class="btn btn-default" style="margin-bottom:10px;" style="color:black;"><b>Delete</b></button></a></td>
                </tr>
                @empty
                <p style="color:red;margin-left:50px;">No Images</p>

                @endforelse
       
            </tbody>
            </table>
            <label  >Add images</label>

            <div class="custom-file">
            <input type="file" class="custom-file-input" id="validatedCustomFile" Name="img[]"  accept="image/*" multiple>
            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
            </div>
            <script>
             $('.custom-file input').change(function (e) {
                var files = [];
               
                $(this).next('.custom-file-label').html("you choose : "+ $(this)[0].files.length+" images");
            });
            </script>
          

            <div class="form-group">
                    <label for="sel1" Name="category">Category</label>
                    <select class="form-control" id="sel1" Name="category">
                    @if($item->category_id) 
                    <option value="" disabled selected>Choose your option</option>
                    @endif
                    @foreach($categories as $category)
                        @if($category->id==$item->category_id)
                        <option value="{{$category->id}}" selected>{{$category->name}}</option>
                        @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
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
          
          

            <button type="submit" class="w3-btn btn-block w3-round-xxlarge w3-blue" style="margin-bottom:10px;">EDIT</button>


            <br>
            <br>

    </form>


@endsection
