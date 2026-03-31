<x-crm.layout.app>
    <style>
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
                        <h5 class="m-b-10">Category List</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item">Category List</li>
                    </ul>
                </div>

                <div class="page-header-right ms-auto d-flex" style="gap:10px;">
                    <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne">
                        Filter
                    </a>
                    <a href="{{ route('category.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>

            <div id="collapseOne"
                class="accordion-collapse collapse page-header-collapse {{ request('name') || request('status') ? 'show' : '' }}">
                <div class="accordion-body pb-2">
                    <form method="GET" action="{{ url()->current() }}" class="mb-3 row g-2">
                        <div class="col-md-4">
                            <input type="text" name="name" class="form-control" placeholder="Search by Name"
                                value="{{ request('name') }}">
                        </div>

                        <div class="col-md-4">
                            <select name="status" class="form-select" data-select2-selector="status">
                                <option value="">All Status</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Images</th>
                            <th>Status</th>
                            <th>Sort Order</th>
                            <th>Type</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    @if($category->images)
                                        <img src="{{ asset($category->images) }}" alt="Category Image" style="max-width: 80px; max-height: 60px; border-radius: 4px;">
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $category->status ? 'bg-success' : 'bg-danger' }}">
                                        {{ $category->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{ $category->sort_order }}</td>
                                <td>
                                    @if($category->main_menu === 0)
                                    <span >Category</span>
                                    @else
                                    <span >Section </span>
                                    @endif
                                </td>
                                <td>{{ $category->created_at?->format('d M Y') }}</td>
                                <td>
                                    <div class="action-links">
                                        <a href="{{ route('category.edit', ['id' => $category->id]) }}" class="btn-edit"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button type="button" class="btn-delete" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $category->id }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1"
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
                                                        Are you sure you want to delete this category?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <form action="{{ route('category.delete', $category->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
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
                                <td colspan="6">No categories found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="m-4" style="display:flex;justify-content:center;">
                {{ $categories->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</x-crm.layout.app>