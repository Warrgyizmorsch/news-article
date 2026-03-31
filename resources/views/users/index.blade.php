<x-crm.layout.app>
    <style>
    /* Styling for a cleaner input group look */
    #collapseadd .input-group-text {
        color: #6c757d;
        border-radius: 4px 0 0 4px;
    }
    #collapseadd .form-control:focus, #collapseadd .form-select:focus {
        box-shadow: none;
        border-color: #ced4da;
    }
    #collapseadd .input-group:focus-within {
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        border-radius: 4px;
    }
</style>
<main>
    <div class="p-3">
        <div class="page-header d-flex align-items-center">
            <div class="page-header-left">
                <div class="page-header-title">
                    <h5 class="m-b-10">User Master</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item">User Management</li>
                </ul>
            </div>

            <div class="page-header-right ms-auto d-flex" style="gap:10px;">
                <button type="button" class="btn btn-icon btn-light-danger d-none" id="btnDeleteSelected">
                    <i class="feather feather-trash"></i>
                </button>
                <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse" data-bs-target="#collapseFilter">
                    <i class="feather feather-filter"></i>
                </a>
                <a href="{{ route('users.create') }}" class="btn btn-icon btn-light-brand">
                    <i class="feather feather-plus"></i>
                </a>
            </div>
        </div>

        <div id="collapseadd" class="accordion-collapse collapse {{ (isset($createMode) || isset($editMode)) ? 'show' : '' }}">
            <div class="accordion-body pb-3 border-bottom bg-white rounded shadow-sm p-4 mt-2">
                
                <h6 class="mb-4 text-primary border-bottom pb-2 fw-bold d-flex align-items-center">
                    <i class="feather {{ isset($user) ? 'feather-edit' : 'feather-plus-circle' }} me-2" style="font-size: 18px;"></i>
                    {{ isset($user) ? 'Edit User Details' : 'Add New User Record' }}
                </h6>

                <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
                    @csrf
                    @if(isset($user)) @method('PUT') @endif

                    <div class="row g-4 align-items-end">
                        
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-uppercase small text-muted mb-1">Full Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="feather feather-user text-muted"></i></span>
                                <input type="text" name="name" class="form-control border-start-0 ps-0" value="{{ $user->name ?? old('name') }}" required placeholder="e.g. John Doe">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-uppercase small text-muted mb-1">Email Address <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="feather feather-mail text-muted"></i></span>
                                <input type="email" name="email" class="form-control border-start-0 ps-0" value="{{ $user->email ?? old('email') }}" required placeholder="user@company.com">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-uppercase small text-muted mb-1">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="feather feather-phone text-muted"></i></span>
                                <input type="text" name="phone" class="form-control border-start-0 ps-0" value="{{ $user->phone ?? old('phone') }}" placeholder="+91 9876543210">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-uppercase small text-muted mb-1">User Role <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="feather feather-shield text-muted"></i></span>
                                <select name="role" class="form-select border-start-0 ps-0">
                                    <option value="user" {{ (isset($user) && $user->role == 'user') ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ (isset($user) && $user->role == 'admin') ? 'selected' : '' }}>Admin</option>
                                    <option value="author" {{ (isset($user) && $user->role == 'aurhor') ? 'selected' : '' }}>Author</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-uppercase small text-muted mb-1">
                                Password {!! isset($user) ? '<span class="text-primary fw-normal text-lowercase">(Leave blank to keep current)</span>' : '<span class="text-danger">*</span>' !!}
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="feather feather-lock text-muted"></i></span>
                                <input type="password" name="password" class="form-control border-start-0 ps-0" {{ isset($user) ? '' : 'required' }} placeholder="Enter strong password">
                            </div>
                        </div>

                        @if(!isset($user))
                        <div class="col-md-4">
                            <label class="form-label font-weight-bold text-uppercase small text-muted mb-1">Confirm Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="feather feather-check-circle text-muted"></i></span>
                                <input type="password" name="password_confirmation" class="form-control border-start-0 ps-0" required placeholder="Re-enter password">
                            </div>
                        </div>
                        @endif

                        <div class="col-12 mt-4 pt-4 border-top d-flex align-items-center gap-3">
                            <button type="submit" class="btn btn-primary px-4 py-2 shadow-sm text-uppercase fw-bold" style="width: auto;">
                                <i class="feather {{ isset($user) ? 'feather-check' : 'feather-save' }} me-1"></i>
                                {{ isset($user) ? 'Update Record' : 'Save User' }}
                            </button>
                            
                            <a href="{{ route('users.index') }}" class="btn btn-light border px-4 py-2 text-dark text-uppercase fw-bold" style="width: auto; background-color: #f8f9fa;">
                                Cancel
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <div id="collapseFilter" class="accordion-collapse collapse {{ request('filter_name') || request('filter_role') ? 'show' : '' }}">
            <div class="accordion-body pb-3 bg-white rounded shadow-sm p-4 mt-2 mb-3 border-top border-3">
                
                <h6 class="mb-3 text-primary border-bottom pb-2 fw-bold d-flex align-items-center">
                    <i class="feather feather-filter me-2" style="font-size: 18px;"></i>
                    Filter Users
                </h6>

                <form method="GET" action="{{ route('users.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label font-weight-bold text-uppercase small text-muted mb-1">Search Keyword</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="feather feather-search text-muted"></i></span>
                            <input type="text" name="filter_name" class="form-control border-start-0 ps-0" placeholder="Name or email..." value="{{ request('filter_name') }}">
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label font-weight-bold text-uppercase small text-muted mb-1">User Role</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="feather feather-shield text-muted"></i></span>
                            <select name="filter_role" class="form-select border-start-0 ps-0">
                                <option value="">All Roles</option>
                                <option value="user" {{ request('filter_role') == 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ request('filter_role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="author" {{ request('filter_role') == 'author' ? 'selected' : '' }}>Author</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-5 d-flex gap-2">
                        <button class="btn btn-primary px-4 shadow-sm text-uppercase fw-bold" type="submit" style="width: auto;">
                            <i class="feather feather-filter me-1"></i> Filter
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-light border px-4 text-dark text-uppercase fw-bold" style="width: auto; background-color: #f8f9fa;">
                            <i class="feather feather-refresh-ccw me-1"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm overflow-hidden mt-3">
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0" style="border-color: #e9ecef;">
                    <thead style="background: #ffffff;">
                        <tr class="text-uppercase" style="font-size: 11px; color: #6c757d; letter-spacing: 0.5px;">
                            <th class="text-center" style="width: 50px; vertical-align: middle;">
                                <input type="checkbox" id="checkAll" class="form-check-input">
                            </th>
                            <th class="ps-3 py-3" style="width: 100px;">Sr. No.</th>
                            <th class="ps-3 py-3">Name</th>
                            <th class="ps-3 py-3">Email Address</th>
                            <th class="ps-3 py-3">Role</th>
                            <th class="text-center ps-3 py-3" style="width: 120px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $u)
                        <tr style="background: {{ $index % 2 == 0 ? '#f8f9fa' : '#ffffff' }}; border-bottom: 1px solid #eee;">
                            <td class="text-center">
                                <input type="checkbox" class="form-check-input user-checkbox" data-id="{{ $u->id }}">
                            </td>
                            <td class="ps-3 text-muted">{{ $index + 1 }}</td>
                            <td class="ps-3">
                                <a href="{{ route('users.edit', $u->id) }}" class="text-primary fw-bold text-decoration-none">
                                    {{ $u->name }} (EC00{{ $u->id }})
                                </a>
                            </td>
                            <td class="text-muted small">{{ $u->email }}</td>
                            <td>
                                <span class="text-dark small">{{ ucfirst($u->role) }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('users.edit', $u->id) }}" class="btn btn-sm border bg-white text-primary shadow-sm px-2 py-1" title="Edit">
                                        <i class="feather feather-edit-2" style="font-size: 14px;"></i>
                                    </a>
                                    <form action="{{ route('users.destroy', $u->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-sm border bg-white text-danger shadow-sm px-2 py-1 sa-delete" title="Delete">
                                            <i class="feather feather-trash-2" style="font-size: 14px;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<div class="offcanvas offcanvas-end" tabindex="-1" id="deleteOffcanvas" aria-labelledby="deleteOffcanvasLabel">
    <div class="offcanvas-header border-bottom bg-light">
        <h5 class="offcanvas-title text-danger fw-bold" id="deleteOffcanvasLabel">
            <i class="feather feather-alert-triangle me-2"></i> Confirm Deletion
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex flex-column justify-content-center">
        <div class="text-center mb-4">
            <div class="bg-light-danger rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                <i class="feather feather-trash-2 text-danger" style="font-size: 2.5rem;"></i>
            </div>
        </div>
        <h5 class="text-center text-dark mb-2" id="deleteOffcanvasMessage">Are you sure you want to delete this record?</h5>
        <p class="text-center text-muted small mb-4">This action cannot be undone and the data will be permanently removed from the system.</p>
        
        <div class="d-grid gap-3 mt-auto">
            <button type="button" class="btn btn-danger py-2 fw-bold" id="confirmDeleteBtn">Yes, Delete</button>
            <button type="button" class="btn btn-light py-2 fw-bold" data-bs-dismiss="offcanvas">Cancel</button>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // CSRF Setup for Bulk Delete
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Variables to store delete info temporarily
    let currentDeleteMode = '';
    let currentFormToSubmit = null;
    let currentIdsToDelete = [];

    // 1. Single Delete - Open Offcanvas
    $('.sa-delete').on('click', function(e) {
        e.preventDefault();
        currentFormToSubmit = $(this).closest('form');
        currentDeleteMode = 'single';
        
        $('#deleteOffcanvasMessage').text('Are you sure you want to delete this user record?');
        
        let offcanvas = new bootstrap.Offcanvas(document.getElementById('deleteOffcanvas'));
        offcanvas.show();
    });

    // 2. Checkbox Logic (No changes made here, exactly yours)
    $('#checkAll').on('change', function() {
        $('.user-checkbox').prop('checked', this.checked);
        toggleMultiBtn();
    });

    $('.user-checkbox').on('change', function() {
        let allChecked = $('.user-checkbox:checked').length === $('.user-checkbox').length;
        $('#checkAll').prop('checked', allChecked);
        toggleMultiBtn();
    });

    function toggleMultiBtn() {
        let count = $('.user-checkbox:checked').length;
        if (count > 0) {
            $('#btnDeleteSelected').removeClass('d-none');
        } else {
            $('#btnDeleteSelected').addClass('d-none');
        }
    }

    // 3. Bulk Delete - Open Offcanvas
    $('#btnDeleteSelected').on('click', function(e) {
        e.preventDefault();
        let ids = [];
        $('.user-checkbox:checked').each(function() {
            ids.push($(this).data('id')); 
        });

        if (ids.length > 0) {
            currentIdsToDelete = ids;
            currentDeleteMode = 'bulk';
            
            $('#deleteOffcanvasMessage').text('Are you sure you want to delete ' + ids.length + ' selected users?');
            
            let offcanvas = new bootstrap.Offcanvas(document.getElementById('deleteOffcanvas'));
            offcanvas.show();
        }
    });

    // 4. Offcanvas "Yes, Delete" Button Logic
    $('#confirmDeleteBtn').on('click', function() {
        if (currentDeleteMode === 'single' && currentFormToSubmit) {
            currentFormToSubmit.submit();
        } 
        else if (currentDeleteMode === 'bulk' && currentIdsToDelete.length > 0) {
            $.ajax({
                url: "{{ route('users.bulkDelete') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    ids: currentIdsToDelete
                },
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert("Error: Delete operation failed!");
                }
            });
        }
    });
});
</script>
</x-crm.layout.app>