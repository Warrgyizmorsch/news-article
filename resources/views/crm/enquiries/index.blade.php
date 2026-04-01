<x-crm.layout.app>
    <style>
        .action-links {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .action-links .btn-view,
        .action-links .btn-delete {
            background: transparent;
            border: none;
            padding: 6px 8px;
            cursor: pointer;
        }

        .action-links .btn-view i {
            color: #0d6efd;
        }

        .action-links .btn-delete i {
            color: #dc3545;
        }

        /* Fix for modal backdrop issue in some CRM layouts */
        .modal-backdrop.show {
            opacity: 0;
        }

        .modal-backdrop {
            position: static;
        }
    </style>

    <main>
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Contact Enquiries</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item">Enquiries</li>
                </ul>
            </div>
        </div>
    </main>

    <div class="crm-page-container">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message Preview</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enquiries as $item)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $item->created_at->format('d M, Y') }}</div>
                                    <small class="text-muted">{{ $item->created_at->format('h:i A') }}</small>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $item->name }}</div>
                                </td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone ?? '-' }}</td>
                                <td class="text-muted">{{ Str::limit($item->message, 40) }}</td>
                                <td>
                                    <div class="action-links justify-content-end">
                                        <button type="button" class="btn-view" data-bs-toggle="modal"
                                            data-bs-target="#viewModal{{ $item->id }}" title="View Message">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <button type="button" class="btn-delete" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $item->id }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                    <div class="modal fade" id="viewModal{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Enquiry from {{ $item->name }}</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Website:</strong> {{ $item->website ?? 'N/A' }}</p>
                                                    <hr>
                                                    <p class="mb-0">{{ $item->message }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <a href="mailto:{{ $item->email }}" class="btn btn-primary">Reply via
                                                        Email</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to permanently delete this enquiry?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('enquiries.delete', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete
                                                            Permanently</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No enquiries found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="m-4 d-flex justify-content-center">
                {{ $enquiries->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</x-crm.layout.app>