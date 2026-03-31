<x-crm.layout.app>
    <main>
        <div>
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Edit Category</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category List</a></li>
                        <li class="breadcrumb-item">Edit</li>
                    </ul>
                </div>

                <div class="page-header-right ms-auto d-flex" style="gap:10px;">
                    <a href="{{ route('category.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </main>

    <div class="crm-page-container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Name</label>
                        <div class="col-lg-9">
                            <input id="nameInput" type="text" name="name" class="form-control"
                                value="{{ old('name', $category->name) }}" required>
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Slug</label>
                        <div class="col-lg-9">
                            <input id="slugInput" type="text" name="slug" class="form-control"
                                value="{{ old('slug', $category->slug) }}">
                            @error('slug')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Description</label>
                        <div class="col-lg-9">
                            <textarea name="description" class="form-control"
                                rows="4">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Sort Order</label>
                        <div class="col-lg-9">
                            <input type="number" name="sort_order" class="form-control"
                                value="{{ old('sort_order', $category->sort_order) }}">
                            @error('sort_order')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                     <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Status</label>
                        <div class="col-lg-9">
                            <select name="main_menu" class="form-select" data-select2-selector="status" required>
                                 <option value="0" {{ old('status', $category->main_menu) == '0' ? 'selected' : '' }}>Category
                                </option>
                                <option value="1" {{ old('main_menu', $category->main_menu) == '1' ? 'selected' : '' }}>Section
                                </option>
                            </select>
                            @error('status')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Status</label>
                        <div class="col-lg-9">
                            <select name="status" class="form-select" data-select2-selector="status" required>
                                <option value="1" {{ old('status', $category->status) == '1' ? 'selected' : '' }}>Active
                                </option>
                                <option value="0" {{ old('status', $category->status) == '0' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            @error('status')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Add Image</label>
                        <div class="col-lg-9">
                            <input id="imageInput" type="file" name="images" class="form-control" accept="image/*">
                            <small class="d-block mt-2 text-muted">Leave empty to keep existing. Max 10MB.</small>
                            @error('images')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                            <div class="mt-3">
                                @if($category->images)
                                    <div class="mb-2">
                                        <strong>Current image:</strong>
                                    </div>
                                    <img id="previewImg" src="{{ asset($category->images) }}" alt="Current Image" class="img-fluid" style="max-width: 200px; max-height: 300px; border-radius: 4px;">
                                @else
                                    <div id="previewImg" style="display:none;"></div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const nameInput = document.getElementById('nameInput');
        const slugInput = document.getElementById('slugInput');

        let slugEdited = slugInput.value.trim() !== '';

        function slugify(value) {
            return value
                .toString()
                .trim()
                .toLowerCase()
                .replace(/\s+/g, '-')
                .replace(/[^a-z0-9\-]/g, '')
                .replace(/-+/g, '-')
                .replace(/^-+|-+$/g, '');
        }

        nameInput.addEventListener('input', function() {
            if (!slugEdited) {
                slugInput.value = slugify(nameInput.value);
            }
        });

        slugInput.addEventListener('input', function() {
            slugEdited = slugInput.value.trim() !== '';
        });

        const imageInput = document.getElementById('imageInput');
        imageInput?.addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewImg = document.getElementById('previewImg');
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</x-crm.layout.app>