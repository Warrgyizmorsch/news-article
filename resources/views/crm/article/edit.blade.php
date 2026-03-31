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
                        <h5 class="m-b-10">Edit Article</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Article List</a></li>
                        <li class="breadcrumb-item">Edit</li>
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
                <form id="articleForm" action="{{ route('articles.update', $article->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3 align-items-start mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Featured Image</label>
                        <div class="col-lg-9">
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <div class="image-preview" id="thumbPreview">
                                    @if($article->featured_image)
                                    <img src="{{ asset('storage/' . $article->featured_image) }}" alt="preview">
                                    @else
                                    <img src="/images/blank.jpeg" alt="preview">
                                    @endif
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
                        <label class="col-lg-3 col-form-label fw-semibold">Section</label>
                        <div class="col-lg-9">
                            <select name="section_id" id="sectionSelect" class="form-select" data-select2-selector="tag" required>
                                <option value="">Select Section</option>
                                @foreach($sections as $section)
                                <option value="{{ $section->id }}" {{ old('section_id', $article->section_id) == $section->id ? 'selected' : '' }}>
                                    {{ $section->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('section_id')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Category</label>
                        <div class="col-lg-9">
                            <select name="category_id" class="form-select" data-select2-selector="tag" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
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
                            <input type="text" class="form-control" id="titleInput" name="title"
                                value="{{ old('title', $article->title) }}" required>
                            @error('title')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Slug</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" id="slugInput" name="slug"
                                value="{{ old('slug', $article->slug) }}">
                            @error('slug')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Excerpt</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="excerpt" rows="3">{{ old('excerpt', $article->excerpt) }}</textarea>
                            @error('excerpt')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4" id="contentSection">
                        <label class="col-lg-3 col-form-label fw-semibold">Content</label>
                        <div class="col-lg-9">
                            <textarea id="summernote" name="content">{{ old('content', $article->content) }}</textarea>
                            @error('content')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4 d-none" id="pdfUploadSection">
                        <label class="col-lg-3 col-form-label fw-semibold">Upload PDF</label>
                        <div class="col-lg-9">
                            <input type="file" name="pdf_file" class="form-control" accept=".pdf">

                            @if($article->pdf_file)
                            <p class="mt-2">
                                Current:
                                <a href="{{ asset('storage/'.$article->pdf_file) }}" target="_blank">View PDF</a>
                            </p>
                            @endif
                        </div>
                    </div>

                    <div class="row g-3 mb-4 d-none" id="imageUploadSection">
                        <label class="col-lg-3 col-form-label fw-semibold">Upload Images</label>
                        <div class="col-lg-9">
                            <input type="file" id="multiImageInput" name="images[]" class="form-control" multiple >

                            <!-- Existing Images -->
                            <div id="existingImages" class="d-flex flex-wrap gap-2 mt-3">
                                @foreach($article->images as $img)
                                <div class="preview-wrapper existing-image" data-id="{{ $img->id }}">
                                    <img src="{{ asset('storage/'.$img->image) }}" class="preview-img">
                                    <button type="button" class="remove-btn remove-existing">&times;</button>
                                </div>
                                @endforeach
                            </div>

                            <!-- New Images Preview -->
                            <div id="imagePreviewContainer" class="d-flex flex-wrap gap-2 mt-3"></div>

                            <!-- Hidden input for deleted images -->
                            <input type="hidden" name="deleted_images" id="deletedImages">
                        </div>
                    </div>

                    <div class="row g-3 mb-4" style="margin-top: 80px;">
                        <label class="col-lg-3 col-form-label fw-semibold">Meta Title</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="meta_title"
                                value="{{ old('meta_title', $article->meta_title) }}">
                            @error('meta_title')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Meta Description</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="meta_description" rows="3">{{ old('meta_description', $article->meta_description) }}</textarea>
                            @error('meta_description')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Tags</label>
                        <div class="col-lg-9">
                            @php
                            $selectedTags = old('tags', $article->tags->pluck('id')->toArray());
                            @endphp

                            <select name="tags[]" class="form-select" data-select2-selector="language" multiple>
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{ in_array($tag->id, $selectedTags) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('tags')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                            @error('tags.*')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Status</label>
                        <div class="col-lg-9">
                            <select name="status" class="form-select" data-select2-selector="status" required>
                                <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>
                                    Draft
                                </option>
                                <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>
                                    Published
                                </option>
                                <option value="archived" {{ old('status', $article->status) == 'archived' ? 'selected' : '' }}>
                                    Archived
                                </option>
                            </select>
                            @error('status')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                     <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Auther</label>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="auther" placeholder="Enter Auther Name" value="{{ old('auther', $article->auther) }}">
                            @error('auther')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                     <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Auther Description</label>
                        <div class="col-lg-9">
                            <textarea class="form-control" name="auther_description" placeholder="Enter Auther Description"
                                rows="3">{{ old('auther_description', $article->auther_description) }}</textarea>
                            @error('auther_description')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Published At</label>
                        <div class="col-lg-9">
                            <input type="datetime-local" name="published_at" class="form-control"
                                value="{{ old('published_at', $article->published_at ? $article->published_at->format('Y-m-d\TH:i') : '') }}">
                            @error('published_at')
                            <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Views</label>
                        <div class="col-lg-9">
                            <input type="number" class="form-control" value="{{ $article->views }}" disabled>
                            <div class="form-text">Views are auto-managed from frontend article page.</div>
                        </div>
                    </div>

                    <!-- <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Options</label>
                        <div class="col-lg-9 d-flex flex-column gap-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1"
                                    id="isFeatured" {{ old('is_featured', $article->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="isFeatured">Featured Article</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_breaking" value="1"
                                    id="isBreaking" {{ old('is_breaking', $article->is_breaking) ? 'checked' : '' }}>
                                <label class="form-check-label" for="isBreaking">Breaking News</label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_hero" value="1"
                                    id="isHero" {{ old('is_hero', $article->is_hero) ? 'checked' : '' }}>
                                <label class="form-check-label" for="isHero">Hero Slider</label>
                            </div>
                        </div>
                    </div> -->

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Article</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <style>
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

            function toggleSections() {
                const selectedText = $('#sectionSelect').find(':selected').text().toLowerCase();

                if (selectedText.includes('monthly edition')) {
                    $('#contentSection').addClass('d-none');
                    $('#pdfUploadSection').removeClass('d-none');
                    $('#imageUploadSection').removeClass('d-none');
                } else {
                    $('#contentSection').removeClass('d-none');
                    $('#pdfUploadSection').addClass('d-none');
                    $('#imageUploadSection').addClass('d-none');
                }
            }

            $('#sectionSelect').on('change', toggleSections);

            toggleSections(); // page load
        });

        let deletedImages = [];

        $(document).on('click', '.remove-existing', function() {
            const wrapper = $(this).closest('.existing-image');
            const id = wrapper.data('id');

            deletedImages.push(id);
            $('#deletedImages').val(deletedImages.join(','));

            wrapper.remove();
        });

        let selectedFiles = [];

        $('#multiImageInput').on('change', function(e) {

            const files = Array.from(e.target.files);
            const previewContainer = $('#imagePreviewContainer');

            previewContainer.html('');
            selectedFiles = files;

            files.forEach((file, index) => {

                const reader = new FileReader();

                reader.onload = function(ev) {
                    const html = `
                <div class="preview-wrapper" data-index="${index}">
                    <img src="${ev.target.result}" class="preview-img">
                    <button type="button" class="remove-btn remove-new">&times;</button>
                </div>
            `;
                    previewContainer.append(html);
                };

                reader.readAsDataURL(file);
            });
        });

        $(document).on('click', '.remove-new', function() {

            const wrapper = $(this).closest('.preview-wrapper');
            const index = wrapper.data('index');

            selectedFiles.splice(index, 1);

            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));

            $('#multiImageInput')[0].files = dataTransfer.files;

            wrapper.remove();
        });
    </script>
</x-crm.layout.app>