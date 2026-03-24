<x-crm.layout.app>
    <main>
        <div>
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Create Subscription Plan</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Plan List</a></li>
                        <li class="breadcrumb-item">Create</li>
                    </ul>
                </div>

                <div class="page-header-right ms-auto d-flex" style="gap:10px;">
                    <a href="{{ route('plans.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </main>

    <div class="crm-page-container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('plans.store') }}" method="POST">
                    @csrf

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Name</label>
                        <div class="col-lg-9">
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Slug</label>
                        <div class="col-lg-9">
                            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}"
                                placeholder="Leave blank to auto-generate from name">
                            @error('slug')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Price</label>
                        <div class="col-lg-9">
                            <input type="number" step="0.01" name="price" class="form-control"
                                value="{{ old('price') }}" required>
                            @error('price')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Duration Days</label>
                        <div class="col-lg-9">
                            <input type="number" name="duration_days" class="form-control"
                                value="{{ old('duration_days') }}" required>
                            @error('duration_days')
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

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('plans.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-crm.layout.app>