<x-crm.layout.app>
    <style>
        .thumb-img {
            width: 40px;
            height: 40px;
            border-radius: 6px;
            overflow: hidden;
        }

        .thumb-img img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .action-links {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .action-links .btn-edit,
        .action-links .btn-delete {
            background: transparent;
            border: none;
            padding: 6px 8px;
            cursor: pointer;
        }

        .action-links .btn-edit i {
            color: #0d6efd;
        }

        .action-links .btn-delete i {
            color: #dc3545;
        }

        .badge-soft {
            font-size: 12px;
            padding: 5px 8px;
            border-radius: 6px;
            display: inline-block;
            margin-right: 4px;
        }

        .modal-backdrop.show {
            opacity: 0;
        }

        .modal-backdrop {
            position: static;
        }
    </style>

    <main>
        <div>
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Article List</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item">Article List</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto d-flex" style="gap:10px;">
                    <a href="{{ route('articles.trashed') }}" class="btn btn-warning">Trashed</a>
                    <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne">
                        Filter
                    </a>
                    <a href="{{ route('articles.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>

            <div id="collapseOne"
                class="accordion-collapse collapse page-header-collapse {{ request('title') || request('status') || request('category_id') ? 'show' : '' }}">
                <div class="accordion-body pb-2">
                    <form method="GET" action="{{ url()->current() }}" class="mb-3 row g-2">
                        <div class="col-md-4">
                            <input type="text" name="title" class="form-control" placeholder="Search by Title"
                                value="{{ request('title') }}">
                        </div>

                        <div class="col-md-4">
                            <select name="status" class="form-select" data-select2-selector="tag">
                                <option value="">All Status</option>
                                <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>
                                    Published</option>
                                <option value="archived" {{ request('status') === 'archived' ? 'selected' : '' }}>Archived
                                </option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <select name="category_id" class="form-select" data-select2-selector="tag">
                                <option value="">All Categories</option>
                                @foreach($allCategories ?? [] as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 d-flex">
                            <button class="btn btn-primary me-2" type="submit">Filter</button>
                            <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <div class="crm-page-container">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Flags</th>
                            <th>Status</th>
                            <th>Views</th>
                            <th>Published</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                            <tr>
                                <td>
                                    <div class="thumb-img">
                                        @if(!empty($article->featured_image))
                                            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="thumb">
                                        @else
                                            <img src="/images/blank.jpeg" alt="default_thumb">
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $article->title }}</div>
                                    <small class="text-muted">{{ $article->slug }}</small>
                                </td>
                                <td>{{ $article->category->name ?? '-' }}</td>
                                <td>
                                    @if($article->is_featured)
                                        <span class="badge bg-primary">Featured</span>
                                    @endif
                                    @if($article->is_breaking)
                                        <span class="badge bg-danger">Breaking</span>
                                    @endif
                                    @if(!$article->is_featured && !$article->is_breaking)
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span
                                        class="badge
                                            {{ $article->status === 'published' ? 'bg-success' : ($article->status === 'archived' ? 'bg-secondary' : 'bg-warning text-dark') }}">
                                        {{ ucfirst($article->status) }}
                                    </span>
                                </td>
                                <td>{{ number_format($article->views) }}</td>
                                <td>{{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}</td>
                                <td>
                                    <div class="action-links">
                                        <a href="{{ route('articles.edit', ['id' => $article->id]) }}" class="btn-edit"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button type="button" class="btn-delete" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $article->id }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <div class="modal fade" id="deleteModal{{ $article->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog"
                                                style="display:flex;justify-content:center;align-items:center;height:100vh;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Delete</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to move this article to trash?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <form action="{{ route('articles.delete', $article->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Move to
                                                                Trash</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No articles found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="m-4" style="display:flex;justify-content:center;">
                {{ $articles->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</x-crm.layout.app>