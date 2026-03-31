<x-crm.layout.app>
    <main>
        <div>
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Create Category</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category List</a></li>
                        <li class="breadcrumb-item">Create</li>
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
                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Name</label>
                        <div class="col-lg-9">
                            <input id="nameInput" type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Category Name" required>
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Slug</label>
                        <div class="col-lg-9">
                            <input id="slugInput" type="text" name="slug" class="form-control" value="{{ old('slug') }}"
                                placeholder="Leave blank to auto-generate from name">
                            @error('slug')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Description</label>
                        <div class="col-lg-9">
                            <textarea name="description" class="form-control"
                                rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Sort Order</label>
                        <div class="col-lg-9">
                            <input type="number" name="sort_order" class="form-control"
                                value="{{ old('sort_order', 0) }}">
                            @error('sort_order')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                     <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Content Type</label>
                        <div class="col-lg-9">
                            <select name="main_menu" class="form-select" data-select2-selector="status" required>
                                <option value="0" {{ old('main_menu') == '0' ? 'selected' : '' }}>Category</option>
                                <option value="1" {{ old('main_menu') == '1' ? 'selected' : '' }}>Section</option>
                            </select>
                            @error('main_menu')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Status</label>
                        <div class="col-lg-9">
                            <select name="status" class="form-select" data-select2-selector="status" required>
                                <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Add Images</label>
                        <div class="col-lg-9">
                            <input type="file" name="images" id="imageInput" class="form-control" accept="image/*">
                            <small class="d-block mt-2 text-muted">Upload image file (JPG, PNG, etc.) - Max 10MB</small>
                            @error('images')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                            
                            <!-- Image Preview -->
                            <div id="imagePreview" class="mt-4" style="display: none;">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Preview:</label>
                                    <div class="border rounded p-3" style="background-color: #f8f9fa; display: inline-block;">
                                        <img id="previewImg" src="" alt="Image Preview" class="img-fluid" style="max-width: 200px; max-height: 300px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('category.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const imageInput = document.getElementById('imageInput');
        const previewDiv = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
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

        const hasFormErrors = {{ $errors->any() ? 'true' : 'false' }};

        // Restore preview from localStorage on page load (if validation error occurred) or clear stale image for fresh form
        window.addEventListener('load', function() {
            if (!hasFormErrors) {
                localStorage.removeItem('categoryImageData');
                previewImg.src = '';
                previewDiv.style.display = 'none';
                return;
            }

            const savedImage = localStorage.getItem('categoryImageData');
            if (savedImage) {
                previewImg.src = savedImage;
                previewDiv.style.display = 'block';
            } else {
                previewImg.src = '';
                previewDiv.style.display = 'none';
            }
        });

        // Save image to localStorage when user selects a file
        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imageData = e.target.result;
                    previewImg.src = imageData;
                    previewDiv.style.display = 'block';
                    // Store in localStorage so it persists even if form validation fails
                    localStorage.setItem('categoryImageData', imageData);
                };
                reader.readAsDataURL(file);
            } else if (file) {
                previewImg.src = '';
                previewDiv.style.display = 'none';
                localStorage.removeItem('categoryImageData');
                alert('Please select a valid image file');
            } else {
                // if user cleared the selection
                previewImg.src = '';
                previewDiv.style.display = 'none';
                localStorage.removeItem('categoryImageData');
            }
        });

        // Clear localStorage when form is successfully submitted
        document.querySelector('form').addEventListener('submit', function() {
            // Only clear on successful submit (user won't see this as page redirects)
            setTimeout(() => {
                localStorage.removeItem('categoryImageData');
            }, 100);
        });
    </script>
</x-crm.layout.app>