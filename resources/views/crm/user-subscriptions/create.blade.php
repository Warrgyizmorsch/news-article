<x-crm.layout.app>
    <main>
        <div>
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Create User Subscription</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user-subscriptions.index') }}">User Subscription
                                List</a></li>
                        <li class="breadcrumb-item">Create</li>
                    </ul>
                </div>

                <div class="page-header-right ms-auto d-flex" style="gap:10px;">
                    <a href="{{ route('user-subscriptions.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </main>

    <div class="crm-page-container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('user-subscriptions.store') }}" method="POST">
                    @csrf

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">User</label>
                        <div class="col-lg-9">
                            <select name="user_id" class="form-select" required>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Plan</label>
                        <div class="col-lg-9">
                            <select name="subscription_plan_id" id="subscription_plan_id" class="form-select" required>
                                <option value="">Select Plan</option>
                                @foreach($plans as $plan)
    <option value="{{ $plan->id }}"
        data-duration="{{ $plan->duration_days }}"
        {{ old('subscription_plan_id') == $plan->id ? 'selected' : '' }}>
        {{ $plan->name }} - ₹{{ number_format($plan->price, 2) }} / {{ $plan->duration_days }} days
    </option>
@endforeach
                            </select>
                            @error('subscription_plan_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Start Date</label>
                        <div class="col-lg-9">
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}" required>
                            @error('start_date')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">End Date</label>
                        <div class="col-lg-9">
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}" required>
                            @error('end_date')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Status</label>
                        <div class="col-lg-9">
                            <select name="status" class="form-select" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired
                                </option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                            </select>
                            @error('status')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Payment Status</label>
                        <div class="col-lg-9">
                            <input type="text" name="payment_status" class="form-control"
                                value="{{ old('payment_status') }}" placeholder="manual / paid / pending">
                            @error('payment_status')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <label class="col-lg-3 col-form-label fw-semibold">Payment Reference</label>
                        <div class="col-lg-9">
                            <input type="text" name="payment_reference" class="form-control"
                                value="{{ old('payment_reference') }}">
                            @error('payment_reference')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('user-subscriptions.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Subscription</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const planSelect = document.getElementById('subscription_plan_id');
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');

            function calculateEndDate() {
                const selectedOption = planSelect.options[planSelect.selectedIndex];
                const duration = parseInt(selectedOption.getAttribute('data-duration'));
                const startDateValue = startDateInput.value;

                if (!duration || !startDateValue) {
                    return;
                }

                const startDate = new Date(startDateValue);
                startDate.setDate(startDate.getDate() + duration);

                const year = startDate.getFullYear();
                const month = String(startDate.getMonth() + 1).padStart(2, '0');
                const day = String(startDate.getDate()).padStart(2, '0');

                endDateInput.value = `${year}-${month}-${day}`;
            }

            planSelect.addEventListener('change', calculateEndDate);
            startDateInput.addEventListener('change', calculateEndDate);
        });
    </script>
    
</x-crm.layout.app>