@extends('bar')

@section('content')
    <style>
        .manage-home-body {
            width: 80%;
        }

        .manage-home-body form button {
            margin: 20px;
        }

        .manage-home-body form {
            margin-top: 20px;
        }
    </style>
    <div class="container my-4">
        <h3 class="mb-5">Add Images to Home Page</h3>
        <form method="POST" action="{{ route('home.images.store') }}" enctype="multipart/form-data" class="form-inline mb-4">
            @csrf
            @method('PUT')
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" Name="img[]" accept="image/*"
                        multiple>
                </div>
            </div>
            <button class="btn brandcolor" type="submit">ADD</button>
        </form>
        <table class="table">
            <tbody>
                @forelse($home_images as $image)
                    <tr>
                        <th scope="row"><img height="150" src={{ URL::asset("images/{$image->name}") }}></th>
                        <td><a href="{{ route('home.images.delete', ['id' => $image->id]) }}">
                                <button type="button" class="btn btn-default" style="margin-bottom:10px;"
                                    style="color:black;"><b>Delete</b></button></a></td>
                    </tr>
                @empty
                    <p style="color:red;margin-left:50px;">No Images</p>
                @endforelse
            </tbody>
        </table>

        <h3 class="mb-5 mt-5">Add Sliding Text to Home Page</h3>

        @if (count($home_top_titles) == 0)
            <form method="POST" class="form-inline" action="{{ route('home.titles.store') }}">
                @csrf
                @method('PUT')
                <textarea class="form-control" name="content" placeholder="English" required></textarea>
                <textarea class="form-control" name="content_ar" placeholder="Arabic" required></textarea>
                <button type="submit" class="btn brandcolor raleway">Add</button>
            </form>
        @else
            @foreach ($home_top_titles as $home_top_title)
                <form method="POST"
                    action="{{ route('home.titles.update', ['id' => $home_top_title->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="content-en" class='mb-3'>English Content</label>
                        <textarea id="content-en" class="form-control mb-3" name="content" required>{{ $home_top_title->content }}</textarea>
                    </div>

                    <!-- Label and Textarea for Arabic Content -->
                    <div class="form-group mt-4">
                        <label for="content-ar" class='mb-3'>Arabic Content</label>
                        <textarea id="content-ar" class="form-control mb-3" name="content_ar" required>{{ $home_top_title->content_ar }}</textarea>
                    </div>
                    <button type="submit" class="btn brandcolor raleway">Edit</button>
                    <a href="{{ route('home.titles.delete', ['id' => $home_top_title->id]) }}"
                        onclick="return confirm('Are you sure to delete {{ $home_top_title->content }}?')"
                        class="btn btn-danger raleway">
                        Delete
                    </a>
                </form>
            @break
        @endforeach
    @endif
</div>
@endsection
