@extends('layouts.common')

@section('content')
<div class="container-fluid pb-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-1">Global System Settings</h4>
            <p class="text-muted fs-13">Configure system-wide behaviors and defaults.</p>
        </div>
    </div>

    <form action="{{ route('global-settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xl-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="card-title mb-0 fs-16 fw-bold text-gray-800">Configuration</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <!-- SKU Auto-increment -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold fs-13">Auto-increment SKU</label>
                                    <select name="settings[auto_increment_sku]" class="form-select form-select-sm">
                                        <option value="0" {{ \App\Models\GlobalSetting::get('auto_increment_sku', '0') == '0' ? 'selected' : '' }}>Disabled</option>
                                        <option value="1" {{ \App\Models\GlobalSetting::get('auto_increment_sku', '0') == '1' ? 'selected' : '' }}>Enabled</option>
                                    </select>
                                    <div class="form-text text-muted fs-12">Enable this to automatically generate SKUs for new product variants.</div>
                                </div>
                            </div>

                            <!-- SKU Prefix -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-semibold fs-13">SKU Prefix</label>
                                    <input type="text" name="settings[sku_prefix]" 
                                           value="{{ \App\Models\GlobalSetting::get('sku_prefix', 'PROD-') }}" 
                                           class="form-control form-control-sm">
                                    <div class="form-text text-muted fs-12">Prefix used for auto-generated SKUs (e.g., PROD-).</div>
                                </div>
                            </div>

                            <!-- Other Settings can be added here -->
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top py-3 text-end">
                        <button type="submit" class="btn btn-primary btn-sm fw-bold px-4">
                            <i class="ti ti-device-floppy me-1"></i> Save Settings
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
