@extends('layouts.common')

@section('content')

{{-- ── Header ── --}}
<div class="card custom-card mb-4">
    <div class="card-body py-3">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <h5 class="mb-0 fw-bold d-flex align-items-center gap-2">
                <i class="ti ti-shield-check text-primary fs-4"></i>
                Edit role: <span class="text-primary">{{ ucfirst($role->name) }}</span>
            </h5>
            <a href="{{ route('role.index') }}" class="btn btn-light btn-sm border fw-semibold">
                <i class="ti ti-arrow-left me-1"></i> Back to list
            </a>
        </div>
    </div>
</div>

<form action="{{ route('role.update', $role->id) }}" method="POST" id="roleForm">
    @csrf
    @method('PUT')

    {{-- ── Validation errors ── --}}
    @if ($errors->any())
        <div class="alert alert-danger border-0 mb-4">
            <div class="d-flex align-items-center gap-2 mb-1">
                <i class="ti ti-alert-triangle fs-5"></i>
                <strong>Validation errors</strong>
            </div>
            <ul class="mb-0 small ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ── Role name + Grant all ── --}}
    <div class="card custom-card mb-4">
        <div class="card-body">
            <div class="row align-items-end g-3">
                <div class="col-12 col-md-7">
                    <label class="form-label fw-semibold small text-uppercase text-muted">
                        Role name <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           class="form-control form-control-lg @error('name') is-invalid @enderror"
                           value="{{ old('name', $role->name) }}"
                           placeholder="e.g. Sales Manager"
                           required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Update the unique identifier for this role.</div>
                </div>
                <div class="col-12 col-md-5 d-flex justify-content-md-end">
                    <div class="form-check form-switch d-flex align-items-center gap-2 border rounded-3 px-4 py-3 bg-light mb-0">
                        <input class="form-check-input mt-0 me-1"
                               type="checkbox"
                               id="selectAllGlobal"
                               style="width:2.2em; height:1.2em;">
                        <label class="form-check-label fw-semibold text-primary" for="selectAllGlobal">
                            Grant all permissions
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Permissions panel ── --}}
    <div class="card custom-card mb-4">
        <div class="row g-0">

            {{-- Sidebar --}}
            <div class="col-12 col-lg-3 border-end">
                <div class="p-3" >
                    <p class="text-uppercase fw-semibold text-muted mb-3" style="font-size:.68rem; letter-spacing:.07em;">
                        Module groups
                    </p>
                    <div class="cla"  style="max-height: 500px;overflow:scroll;">
                    <div class="nav flex-column flex-lg-column flex-row flex-wrap nav-pills gap-1"
                         id="v-pills-tab"
                         role="tablist"
                         aria-orientation="vertical">
                        @foreach($groupedPermissions as $group => $permissions)
                            <button class="nav-link text-start d-flex align-items-center justify-content-between gap-2 {{ $loop->first ? 'active' : '' }}"
                                    id="v-pills-{{ Str::slug($group) }}-tab"
                                    data-bs-toggle="pill"
                                    data-bs-target="#group_{{ Str::slug($group) }}"
                                    type="button"
                                    role="tab"
                                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                <span>{{ $group }}</span>
                                <span class="badge bg-light text-dark rounded-pill group-badge"
                                      data-group="{{ Str::slug($group) }}">
                                    {{ count($permissions) }}
                                </span>
                            </button>
                        @endforeach
                    </div>
                    </div>
                </div>
            </div>

            {{-- Permission panes --}}
            <div class="col-12 col-lg-9">
                <div class="tab-content p-4" id="v-pills-tabContent">

                    @php $rolePermissions = $role->permissions->pluck('name')->toArray(); @endphp

                    @foreach($groupedPermissions as $group => $permissions)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                             id="group_{{ Str::slug($group) }}"
                             role="tabpanel"
                             aria-labelledby="v-pills-{{ Str::slug($group) }}-tab">

                            {{-- Pane header --}}
                            <div class="d-flex align-items-start align-items-sm-center justify-content-between gap-3 mb-4 pb-3 border-bottom flex-wrap">
                                <div>
                                    <h5 class="fw-bold mb-1">{{ $group }} module</h5>
                                    <p class="text-muted small mb-0">Manage specific capabilities for this module.</p>
                                </div>
                                <div class="d-flex gap-2 flex-shrink-0">
                                    <button type="button"
                                            class="btn btn-outline-primary btn-sm select-group"
                                            data-group="{{ Str::slug($group) }}">
                                        Select all
                                    </button>
                                    <button type="button"
                                            class="btn btn-outline-secondary btn-sm clear-group"
                                            data-group="{{ Str::slug($group) }}">
                                        Deselect all
                                    </button>
                                </div>
                            </div>

                            {{-- Selected count --}}
                            <p class="small text-muted mb-3 selected-count" data-group="{{ Str::slug($group) }}">
                                <i class="ti ti-check me-1 text-primary"></i>
                                <span class="fw-semibold text-primary">
                                    {{ count(array_intersect(array_column(iterator_to_array($permissions), 'name'), old('permissions', $rolePermissions))) }}
                                </span>
                                of {{ count($permissions) }} selected
                            </p>

                            {{-- Permission list --}}
                            <div class="d-flex flex-column gap-2" style="max-height: 400px;overflow:scroll;">
                                @foreach($permissions as $permission)
                                    @php $checked = in_array($permission->name, old('permissions', $rolePermissions)); @endphp
                                    <label class="d-flex align-items-center justify-content-between p-3 border rounded-3 cursor-pointer permission-row {{ $checked ? 'border-primary bg-primary-subtle' : '' }}"
                                           for="perm_{{ $permission->id }}"
                                           style="cursor:pointer; transition:all .15s;">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="rounded-3 d-flex align-items-center justify-content-center flex-shrink-0 {{ $checked ? 'bg-primary text-white' : 'bg-primary-subtle text-primary' }}"
                                                 style="width:36px;height:36px;">
                                                <i class="ti-check" style="font-size:16px;"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold text-dark small">
                                                    {{ $permission->permission_name ?: Str::headline($permission->name) }}
                                                </div>
                                                <div class="text-muted" style="font-size:.75rem;">{{ $permission->name }}</div>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch mb-0 ms-3">
                                            <input class="form-check-input permission-checkbox"
                                                   type="checkbox"
                                                   name="permissions[]"
                                                   id="perm_{{ $permission->id }}"
                                                   value="{{ $permission->name }}"
                                                   data-group="{{ Str::slug($group) }}"
                                                   {{ $checked ? 'checked' : '' }}
                                                   style="width:2.2em; height:1.2em; cursor:pointer;">
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    {{-- ── Footer ── --}}
    <div class="card custom-card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <p class="text-muted small mb-0">
                    <i class="ti ti-info-circle me-1"></i>
                    Permissions update will affect all users assigned this role.
                </p>
                <div class="d-flex gap-2">
                    <a href="{{ route('role.index') }}" class="btn btn-light border px-4">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4 fw-semibold">
                        <i class="ti ti-device-floppy me-1"></i> Update role
                    </button>
                </div>
            </div>
        </div>
    </div>

</form>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    function getGroup(el) {
        return el.closest('[data-group]')?.dataset.group
            || el.dataset.group;
    }

    function updateRow(checkbox) {
        const label = checkbox.closest('label');
        const on = checkbox.checked;
        const icon = label.querySelector('.rounded-3');
        label.classList.toggle('border-primary', on);
        label.classList.toggle('bg-primary-subtle', on);
        if (icon) {
            icon.classList.toggle('bg-primary', on);
            icon.classList.toggle('text-white', on);
            icon.classList.toggle('bg-primary-subtle', !on);
            icon.classList.toggle('text-primary', !on);
        }
    }

    function updateGroupCount(group) {
        const boxes = document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`);
        const checked = [...boxes].filter(b => b.checked).length;
        const countEl = document.querySelector(`.selected-count[data-group="${group}"] .fw-semibold`);
        if (countEl) countEl.textContent = checked;

        const badge = document.querySelector(`.group-badge[data-group="${group}"]`);
        if (badge) badge.textContent = boxes.length;
    }

    function updateGrantAll() {
        const all = document.querySelectorAll('.permission-checkbox');
        const checked = [...all].filter(b => b.checked).length;
        document.getElementById('selectAllGlobal').checked = all.length === checked && all.length > 0;
    }

    document.querySelectorAll('.permission-checkbox').forEach(cb => {
        updateRow(cb);
        cb.addEventListener('change', function () {
            updateRow(this);
            updateGroupCount(this.dataset.group);
            updateGrantAll();
        });
    });

    document.querySelectorAll('.select-group').forEach(btn => {
        btn.addEventListener('click', function () {
            const group = this.dataset.group;
            document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`).forEach(cb => {
                cb.checked = true;
                updateRow(cb);
            });
            updateGroupCount(group);
            updateGrantAll();
        });
    });

    document.querySelectorAll('.clear-group').forEach(btn => {
        btn.addEventListener('click', function () {
            const group = this.dataset.group;
            document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`).forEach(cb => {
                cb.checked = false;
                updateRow(cb);
            });
            updateGroupCount(group);
            updateGrantAll();
        });
    });

    document.getElementById('selectAllGlobal').addEventListener('change', function () {
        const on = this.checked;
        document.querySelectorAll('.permission-checkbox').forEach(cb => {
            cb.checked = on;
            updateRow(cb);
        });
        document.querySelectorAll('[data-group]').forEach(el => {
            const g = el.dataset.group;
            if (g) updateGroupCount(g);
        });
    });

    const groups = [...new Set([...document.querySelectorAll('.permission-checkbox')].map(c => c.dataset.group))];
    groups.forEach(updateGroupCount);
    updateGrantAll();
});
</script>
@endpush