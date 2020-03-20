@extends('bar')

@section('content')
<style>
    label {
        color: lightskyblue;
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
        <h1 style="color:lightskyblue;">New item</h1>

            <label for="exampleInputEmail1">Item Name</label>
            <input @if($item->name) value="{{$item->name}}"@endif type="Text" class="form-control" id="text" Name="Name" placeholder="Item Name" required>

            <label for="exampleInputEmail1">Description</label>
            <input @if($item->description) value="{{$item->description}}"@endif type="Text" class="form-control" id="text" Name="Description" placeholder="Description">

            <label for="exampleInputEmail1">Price</label>
            <input @if($item->price) value="{{$item->price}}"@endif type="Text" class="form-control" id="text" Name="Price" placeholder="EGP..." required>

            <label for="exampleInputEmail1">Quantity</label>
            <input @if($item->quantity) value="{{$item->quantity}}"@endif type="Text" class="form-control" id="text" Name="Quantity" placeholder="Quantity" required>

            <label for="exampleInputEmail1">Image Path</label>
            <!-- <input type="file" id="text" Name="img" required> -->

            <div class="custom-file">
            <input type="file" class="custom-file-input" id="validatedCustomFile" Name="img[]"  multiple>
            <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
            </div>
          

             <div class="form-group">
                    <label for="sel1" Name="Category">Category</label>
                    <select class="form-control" id="sel1" Name="Category">
                    <option value="" disabled selected>Choose your option</option>

                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                    </select>
                    </div>
            <input type="submit" name="submit" style="border:none; width:100%; background-color:#c1e2b3;">
            <br><br>
            <input type="reset" style="border:none; width:100%; background-color:#d43f3a;">

            <br>
            <br>

    </form>


@endsection
