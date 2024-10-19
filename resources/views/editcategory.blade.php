@extends('bar')

@auth
    @if (Auth::user()->type == 1)
        @include('addcategory')
    @endif
@endauth

@section('content')
    <div class="container my-4">
        <h3 class="pb-4">Parent Categories</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Arabic Name</th>
                    <th scope="col" colspan='2'>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parentCategories as $parentCategory)
                    <tr>
                        <form method="POST" action="{{ route('category.update', ['id' => $parentCategory->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <td>
                                <input type="Text" class="form-control"Name="name" value ="{{ $parentCategory->name }}"
                                    required>
                            </td>
                            <td>
                                <input type="Text" class="form-control"Name="name_ar" value ="{{ $parentCategory->name_ar }}"
                                    required>
                            </td>
                            <td>
                                <button type="submit" name="submit" class="btn btn-primary mb-2">Save</button>
                        </form>
                        <a href="{{ route('category.delete', ['id' => $parentCategory->id]) }}">
                            <button class="btn btn-danger mb-2">Delete</button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3 class="py-4">Child Categories</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Arabic Name</th>
                    <th scope="col">Parent Category</th>
                    <th scope="col" colspan='2'>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($childCategories as $childCategory)
                    <tr>
                        <form method="POST" action="{{ route('category.update', ['id' => $childCategory->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <td>
                                <input type="Text" class="form-control"Name="name" value ="{{ $childCategory->name }}"
                                    required>
                            </td>
                            <td>
                                <input type="Text" class="form-control"Name="name_ar" value ="{{ $childCategory->name_ar }}"
                                    required>
                            </td>
                            <td>
                                <!-- Dropdown for selecting parent category -->
                                <select class="form-control" name="parent_category_id">
                                    @foreach ($parentCategories as $parentCategory)
                                        <option value="{{ $parentCategory->id }}"
                                            {{ $childCategory->parent_category_id == $parentCategory->id ? 'selected' : '' }}>
                                            {{ $parentCategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <button type="submit" name="submit" class="btn btn-primary mb-2">Save</button>
                        </form>
                        <a href="{{ route('category.delete', ['id' => $childCategory->id]) }}">
                            <button class="btn btn-danger mb-2">Delete</button></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-5 ml-2">
            <button type="button" class="btn btn-primary brandcolor" data-toggle="modal" data-target="#addcategory">
                <i class="fa fa-plus actionicons"></i> Add Category
            </button>
        </div>
    </div>
@endsection
