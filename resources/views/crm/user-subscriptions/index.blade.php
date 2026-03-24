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
                        <h5 class="m-b-10">User Subscription List</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item">User Subscriptions</li>
                    </ul>
                </div>

                <div class="page-header-right ms-auto d-flex" style="gap:10px;">
                    <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne">
                        Filter
                    </a>
                    <a href="{{ route('user-subscriptions.create') }}" class="btn btn-primary">Create</a>
                </div>
            </div>

            <div id="collapseOne"
                class="accordion-collapse collapse page-header-collapse {{ request('user') || request('status') ? 'show' : '' }}">
                <div class="accordion-body pb-2">
                    <form method="GET" action="{{ url()->current() }}" class="mb-3 row g-2">
                        <div class="col-md-4">
                            <input type="text" name="user" class="form-control"
                                placeholder="Search by user name or email" value="{{ request('user') }}">
                        </div>

                        <div class="col-md-4">
                            <select name="status" class="form-select" data-select2-selector="status">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="expired" {{ request('status') === 'expired' ? 'selected' : '' }}>Expired
                                </option>
                                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending
                                </option>
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
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Plan</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Payment Status</th>
                            <th>Reference</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subscriptions as $subscription)
                            <tr>
                                <td>
                                    <div>{{ $subscription->user?->name }}</div>
                                    <small class="text-muted">{{ $subscription->user?->email }}</small>
                                </td>
                                <td>{{ $subscription->plan?->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($subscription->start_date)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($subscription->end_date)->format('d M Y') }}</td>
                                <td>
                                    @if($subscription->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @elseif($subscription->status === 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($subscription->status === 'expired')
                                        <span class="badge bg-secondary">Expired</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>{{ $subscription->payment_status ?: '-' }}</td>
                                <td>{{ $subscription->payment_reference ?: '-' }}</td>
                                <td>
                                    <div class="action-links">
                                        {{-- APPROVE --}}
        @if($subscription->status === 'pending')
            <form action="{{ route('user-subscriptions.approve', $subscription->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">
                    Approve
                </button>
            </form>

            <form action="{{ route('user-subscriptions.reject', $subscription->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    Reject
                </button>
            </form>
        @endif
                                        <a href="{{ route('user-subscriptions.edit', $subscription->id) }}" class="btn-edit"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button type="button" class="btn-delete" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $subscription->id }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                        <div class="modal fade" id="deleteModal{{ $subscription->id }}" tabindex="-1"
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
                                                        Are you sure you want to delete this subscription?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <form
                                                            action="{{ route('user-subscriptions.delete', $subscription->id) }}"
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
                                <td colspan="8">No subscriptions found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="m-4" style="display:flex;justify-content:center;">
                {{ $subscriptions->withQueryString()->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</x-crm.layout.app>