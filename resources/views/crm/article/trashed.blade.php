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
            flex-wrap: wrap;
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
                        <h5 class="m-b-10">Trashed Articles</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Article List</a></li>
                        <li class="breadcrumb-item">Trashed</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto d-flex" style="gap:10px;">
                    <a href="{{ route('articles.index') }}" class="btn btn-secondary">Back to Articles</a>
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
                            <th>Deleted At</th>
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
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->category->name ?? '-' }}</td>
                                <td>{{ $article->deleted_at?->format('d M Y h:i A') }}</td>
                                <td>
                                    <div class="action-links">
                                        <form action="{{ route('articles.restore', $article->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                        </form>

                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#forceDeleteModal{{ $article->id }}">
                                            Permanent Delete
                                        </button>

                                        <div class="modal fade" id="forceDeleteModal{{ $article->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog"
                                                style="display:flex;justify-content:center;align-items:center;height:100vh;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Permanent Delete</h5>
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        This action cannot be undone. Delete permanently?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <form action="{{ route('articles.forceDelete', $article->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete
                                                                Permanently</button>
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
                                <td colspan="5">No trashed articles found</td>
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