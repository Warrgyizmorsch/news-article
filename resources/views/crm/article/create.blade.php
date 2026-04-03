<x-crm.layout.app>
    <style>
        .image-preview {
            width: 220px;
            height: 150px;
            border-radius: .5rem;
            overflow: hidden;
            background: var(--bs-body-bg);
            border: 1px solid var(--bs-border-color);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .note-editor .note-editable {
            min-height: 400px;
        }
    </style>

    <main>
        <div>
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Create Article</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Article List</a></li>
                        <li class="breadcrumb-item">Create</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto d-flex" style="gap:10px;">
                    <a href="{{ route('articles.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </main>

    <div class="crm-page-container">
        <div class="card">
            <div class="card-body">
                <form id="articleForm" action="{{ route('articles.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3 align-items-start mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Featured Image</label>
                        <div class="col-lg-9">
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <div class="image-preview" id="thumbPreview">
                                    <img src="/images/blank.jpeg" alt="preview">
                                </div>
                                <div>
                                    <label class="form-label mb-1">Upload image</label>
                                    <input type="file" name="featured_image" class="form-control"
                                        accept=".png,.jpg,.jpeg,.webp" id="thumbInput">
                                    <div class="form-text">Allowed file types: png, jpg, jpeg, webp.</div>
                                    @error('featured_image')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Featured Image Description</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="featured_image_description" rows="2"
                                placeholder="Enter featured image description">{{ old('featured_image_description') }}</textarea>
                    
                            @error('featured_image_description')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4" >
                        <label class="col-lg-3 col-form-label fw-semibold">Section</label>
                        <div class="col-lg-9">
                            <select name="section_id" id="sectionSelect" class="form-select" data-select2-selector="tag" required>
                                <option value="">Select Section</option>
                                @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('section_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-3 mb-4" id="categorySection">
                        <label class="col-lg-3 col-form-label fw-semibold">Category</label>
                        <div class="col-lg-9">
                            <select name="category_id" class="form-select" data-select2-selector="tag">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Title</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="titleInput" name="title" placeholder="Enter Title"
                                value="{{ old('title') }}" required>
                            @error('title')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Slug</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="slugInput" name="slug" value="{{ old('slug') }}"
                                placeholder="Leave blank to auto-generate from title">
                            @error('slug')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Excerpt</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="excerpt" rows="3">{{ old('excerpt') }}</textarea>
                            @error('excerpt')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4" id="contentSection">
                        <label class="col-lg-3 col-form-label fw-semibold">Content</label>
                        <div class="col-lg-9">
                            <textarea id="summernote" name="content">{{ old('content') }}</textarea>
                            @error('content')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4" >
                        <label class="col-lg-3 col-form-label fw-semibold">Upload PDF</label>
                        <div class="col-lg-9">
                            <input type="file" name="pdf_file" class="form-control" accept=".pdf">
                        </div>
                    </div>

                    <!-- Multiple Images Upload -->
                    <div class="row g-3 mb-4 d-none" id="imageUploadSection">
                        <label class="col-lg-3 col-form-label fw-semibold">Upload Images</label>
                        <div class="col-lg-9">
                            <input type="file" id="multiImageInput" name="images[]" class="form-control" multiple accept=".png,.jpg,.jpeg,.webp">
                            <div id="imagePreviewContainer" class="d-flex flex-wrap gap-2 mt-3"></div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4" style="margin-top: 80px;">
                        <label class="col-lg-3 col-form-label fw-semibold">Meta Title</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="meta_title" placeholder="Enter Meta Title" value="{{ old('meta_title') }}">
                            @error('meta_title')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Meta Description</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="meta_description" placeholder="Enter Meta Description"
                                rows="3">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Tags</label>
                        <div class="col-lg-9">
                            <select name="tags[]" class="form-select" data-select2-selector="language" multiple>
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ collect(old('tags'))->contains($tag->id) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('tags')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Status</label>
                        <div class="col-lg-9">
                            <select name="status" class="form-select" data-select2-selector="status" required>
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published
                                </option>
                                <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived
                                </option>
                            </select>
                            @error('status')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Country</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="country" placeholder="Enter Country Name" value="{{ old('country') }}">
                            @error('country')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                     <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Auther</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="auther" placeholder="Enter Auther Name" value="{{ old('auther') }}">
                            @error('auther')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                     <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Auther Description</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="auther_description" placeholder="Enter Auther Description"
                                rows="3">{{ old('auther_description') }}</textarea>
                            @error('auther_description')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Published At</label>
                        <div class="col-lg-9">
                            <input type="datetime-local" name="published_at" class="form-control"
                                value="{{ old('published_at') }}">
                            @error('published_at')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Options</label>
                        <div class="col-lg-9 d-flex flex-column gap-2">
                            <!-- <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1"
                                    id="isFeatured" {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="isFeatured">Featured Article</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_breaking" value="1"
                                    id="isBreaking" {{ old('is_breaking') ? 'checked' : '' }}>
                                <label class="form-check-label" for="isBreaking">Breaking News</label>
                            </div> -->

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_hero" value="1"
                                    id="isHero" {{ old('is_hero') ? 'checked' : '' }}>
                                <label class="form-check-label" for="isHero">Hero Article</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Article</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .preview-img {
            width: 120px;
            height: 100px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        .preview-wrapper {
            position: relative;
            display: inline-block;
        }

        .preview-img {
            width: 120px;
            height: 100px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        .remove-btn {
            position: absolute;
            top: -1px;
            right: -1px;
            background: red;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 14px;
            cursor: pointer;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>

    <script>
        $('#summernote').summernote({
            placeholder: 'Write article content here...',
            tabsize: 2,
            height: 250,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['codeview', 'help']]
            ]
        });

        (function() {
            const input = document.getElementById('thumbInput');
            const preview = document.querySelector('#thumbPreview img');
            if (input) {
                input.addEventListener('change', (e) => {
                    const file = e.target.files?.[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = (ev) => {
                        preview.src = ev.target.result;
                    };
                    reader.readAsDataURL(file);
                });
            }
        })();

        $(document).ready(function() {

            $('#sectionSelect').on('change select2:select', function() {

                const selectedText = $(this).find(':selected').text().toLowerCase();

                if (selectedText.includes('monthly edition')) {
                    // Hide editor
                    $('#contentSection').addClass('d-none');
                    $('#categorySection').addClass('d-none');

                    // Show PDF + Images
                    $('#imageUploadSection').removeClass('d-none');
                } else {
                    // Show editor
                    $('#contentSection').removeClass('d-none');
                    $('#categorySection').removeClass('d-none');

                    // Hide PDF + Images
                    $('#imageUploadSection').addClass('d-none');
                }

            });

            // page load par bhi run ho
            $('#sectionSelect').trigger('change');

        });

        $(document).ready(function() {

            let selectedFiles = [];

            $('#multiImageInput').on('change', function(e) {

                const files = Array.from(e.target.files);
                const previewContainer = $('#imagePreviewContainer');

                // reset
                previewContainer.html('');
                selectedFiles = files;

                files.forEach((file, index) => {

                    if (!file.type.startsWith('image/')) return;

                    const reader = new FileReader();

                    reader.onload = function(ev) {

                        const html = `
                    <div class="preview-wrapper" data-index="${index}">
                        <img src="${ev.target.result}" class="preview-img">
                        <button type="button" class="remove-btn">&times;</button>
                    </div>
                `;

                        previewContainer.append(html);
                    };

                    reader.readAsDataURL(file);
                });

            });

            // ❌ Remove image
            $(document).on('click', '.remove-btn', function() {

                const wrapper = $(this).closest('.preview-wrapper');
                const index = wrapper.data('index');

                // remove from array
                selectedFiles.splice(index, 1);

                // re-create FileList (important 🔥)
                const dataTransfer = new DataTransfer();
                selectedFiles.forEach(file => dataTransfer.items.add(file));

                $('#multiImageInput')[0].files = dataTransfer.files;

                // remove preview
                wrapper.remove();
            });

        });

        let isSlugEdited = false;

        const titleInput = document.getElementById('titleInput');
        const slugInput = document.getElementById('slugInput');

        slugInput.addEventListener('input', function() {
            isSlugEdited = true;
        });

        titleInput.addEventListener('input', function() {
            if (!isSlugEdited) {
                slugInput.value = this.value
                    .toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .trim()
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
            }
        });
    </script>
</x-crm.layout.app>