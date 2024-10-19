<div class="modal fade" id="addcategory">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Modal body -->
                <div class="modal-body">
                    <label for="exampleInputEmail1">Category English Name</label>
                    <input type="Text" class="form-control mt-2" id="text" Name="name"
                        placeholder="English" required>

                    <label for="exampleInputEmail1" class='mt-4'>Category Arabic Name</label>
                    <input type="Text" class="form-control mt-2" id="text" Name="name_ar"
                        placeholder="Arabic" required>

                    <div class="form-check mt-4">
                        <input type="checkbox" class="form-check-input mr-2" id="is_child_category" name="is_child_category">
                        <label class="form-check-label" for="is_child_category">Is Child Category?</label>
                    </div>

                    <!-- Parent Category Dropdown (Initially Hidden) -->
                    <div class="form-group mt-4" id="parent_category_dropdown" style="display:none;">
                        <label for="parent_category">Select Parent Category</label>
                        <select class="form-control mt-2" id="parent_category" name="parent_category">
                            @foreach ($parentCategories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('is_child_category').addEventListener('change', function() {
        var dropdown = document.getElementById('parent_category_dropdown');
        if (this.checked) {
            dropdown.style.display = 'block';
        } else {
            dropdown.style.display = 'none';
        }
    });
</script>
