@extends('bar')

@section('content')

<style>
.manage-home-body{
    width:80%;
}
.manage-home-body form button{
margin:20px;
}
.manage-home-body form {
margin-top:20px;
}
</style>
<div class="manage-home-body center-block">
<table class="table">
           
           <tbody>
        @forelse($home_images as $image)
                <tr>
                <th scope="row"><img height="150"  src={{ URL::asset("images/{$image->name}")}}></th>
                <td><a href="{{route('home.images.delete',['id' => $image->id])}}">
                <button type="button" class="btn btn-default" style="margin-bottom:10px;" style="color:black;"><b>Delete</b></button></a></td>
                </tr>
                @empty
                <p style="color:red;margin-left:50px;">No Images</p>

                @endforelse
       
            </tbody>
            </table>
            <form method="POST" action="{{route('home.images.store')}}" 
            enctype="multipart/form-data" class="form-inline text-center">
                @csrf
                @method('PUT')
                <div class="form-group">

                <label >Add images</label>
                    <div class="custom-file">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" Name="img[]"  accept="image/*" multiple>
                </div>
                </div>
                <button class="btn brandcolor" type="submit">ADD</button>
            </form>
            <form method="POST" class="form-inline text-center" action="{{route('home.titles.store')}}">
            @csrf
                @method('PUT')
                    <textarea class="form-control" name="content" placeholder="Enter text"></textarea>
                    <button type="submit" class="btn brandcolor raleway">Add</button>
                </form>
                @foreach($home_top_titles as $home_top_title)

            <form method="POST" class="form-inline text-center" 
                action="{{route('home.titles.update',['id' => $home_top_title->id])}}">
                @csrf
                @method('PUT')   
                <textarea class="form-control" name="content"> {{$home_top_title->content}}</textarea>
                    <button type="submit" class="btn brandcolor raleway">Edit</button>
                    <a href="{{route('home.titles.delete',['id' => $home_top_title->id])}}"
                        onclick="return confirm('Are you sure to delete {{$home_top_title->content}}?')"    
                        class="btn btn-danger raleway">
                        Delete
                    </a>
                </form>
                @endforeach
</div>
@endsection