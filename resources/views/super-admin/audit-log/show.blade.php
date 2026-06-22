@extends('layouts.common')

@section('content')
<style>
    /* Premium Audit Detail Styling */
    .audit-page-wrapper {
        max-width: 900px;
        margin: 0 auto;
        padding-top: 1rem;
    }

    .audit-summary-card {
        border: none;
        border-radius: 16px;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .audit-summary-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 150px;
        height: 150px;
        background: rgba(107, 98, 221, 0.03);
        border-radius: 0 0 0 100%;
    }

    .action-indicator {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1.5rem;
    }

    /* Change List Styling */
    .change-item {
        background: #fff;
        border: 1px solid #edf2f7;
        border-radius: 12px;
        margin-bottom: 1rem;
        transition: all 0.2s ease;
    }

    .change-item:hover {
        border-color: #6B62DD;
        box-shadow: 0 4px 12px rgba(107, 98, 221, 0.08);
    }

    .change-field-header {
        padding: 12px 20px;
        background: #fcfdfe;
        border-bottom: 1px solid #edf2f7;
        font-weight: 800;
        color: #475569;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 12px 12px 0 0;
    }

    .change-comparison {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        gap: 15px;
    }

    .comparison-box {
        flex: 1;
        padding: 12px 15px;
        border-radius: 8px;
        font-size: 0.9rem;
        min-height: 45px;
        display: flex;
        align-items: center;
    }

    .box-old {
        background: #fff5f5;
        color: #e53e3e;
        border: 1px dashed #feb2b2;
    }

    .box-new {
        background: #f0fff4;
        color: #2f855a;
        font-weight: 700;
        border: 1px solid #c6f6d5;
    }

    .comparison-arrow {
        color: #cbd5e0;
        font-size: 1.2rem;
    }

    .meta-info-pill {
        background: #fff;
        border: 1px solid #e2e8f0;
        padding: 6px 16px;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
</style>

@php
    function resolveValue($key, $value) {
        if (is_null($value) || $value === '-') return '<span class="opacity-50"><i>Not set</i></span>';
        
        if ($key === 'is_active') {
            return $value == '1' 
                ? '<span class="badge bg-success">Active</span>' 
                : '<span class="badge bg-danger">Inactive</span>';
        }

        if (in_array($key, ['created_by', 'updated_by', 'user_id'])) {
            $user = \App\Models\User::find($value);
            return $user ? $user->name : "ID: $value";
        }

        if ($key === 'school_id') {
            $school = \App\Models\SuperAdmin\School::where('school_id', $value)->first();
            return $school ? $school->school_name : "ID: $value";
        }

        if ($key === 'category_id') {
            $category = \App\Models\SuperAdmin\Category::where('category_id', $value)->first();
            return $category ? $category->category_name : "ID: $value";
        }

        if ($key === 'parent_id') {
            $parent = \App\Models\SuperAdmin\ParentCategory::where('parent_id', $value)->first();
            return $parent ? $parent->name : "ID: $value";
        }

        return e($value);
    }
@endphp

<div class="audit-page-wrapper">
    
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h3 class="fw-bold mb-0">Activity Insight</h3>
            <p class="text-muted small mb-0">Detailed timeline of system changes</p>
        </div>
        <a href="{{ route('audit.index') }}" class="btn btn-primary btn-sm rounded-pill px-4">
            <i class="ti ti-arrow-left me-1"></i> Back to Logs
        </a>
    </div>

    <!-- Main Summary Card -->
    <div class="card audit-summary-card">
        <div class="card-body p-5">
            <div class="row align-items-center">
                <div class="col-md-7">
                    @php
                        $color = match($activity->description) {
                            'created' => 'success',
                            'updated' => 'primary',
                            'deleted' => 'danger',
                            default => 'secondary'
                        };
                        $icon = match($activity->description) {
                            'created' => 'ti-circle-plus',
                            'updated' => 'ti-edit',
                            'deleted' => 'ti-trash',
                            default => 'ti-info-circle'
                        };
                    @endphp

                    <div class="action-indicator bg-{{ $color }}-transparent text-{{ $color }}">
                        <i class="ti {{ $icon }}"></i>
                    </div>

                    <h2 class="fw-bold text-dark mb-2">
                        {{ class_basename($activity->subject_type) }} {{ ucfirst($activity->description) }}
                    </h2>
                    <p class="text-muted mb-4 fs-15">
                        This record was modified by <strong class="text-dark">{{ $activity->causer->name ?? 'System' }}</strong> on {{ $activity->created_at->format('l, d F Y') }} at {{ $activity->created_at->format('h:i A') }}.
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <div class="meta-info-pill">
                            <i class="ti ti-id-badge"></i> ID: {{ substr($activity->subject_id, 0, 8) }}
                        </div>
                        <div class="meta-info-pill">
                            <i class="ti ti-world"></i> {{ $activity->getProperty('ip') ?? 'Local' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-5 d-none d-md-block text-end">
                    <img src="{{ asset('assets/media-79.svg') }}" style="width: 180px; opacity: 0.8;" alt="audit">
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Changes List -->
    <div class="mb-4">
        <h5 class="fw-bold mb-3 d-flex align-items-center">
            <span class="bg-primary-transparent p-2 rounded-circle me-2" style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                <i class="ti ti-list-details text-primary fs-12"></i>
            </span>
            Modified Data Fields
        </h5>

        @php
            $changes = $activity->attribute_changes ?? $activity->properties;
            $changesArray = is_object($changes) ? $changes->toArray() : (is_array($changes) ? $changes : []);
            $oldValues = $changesArray['old'] ?? null;
            $newValues = $changesArray['attributes'] ?? null;
        @endphp

        @if($oldValues || $newValues)
            @php
                $allKeys = array_unique(array_merge(array_keys($oldValues ?? []), array_keys($newValues ?? [])));
                $ignored = ['password', 'id', 'ip', 'user_agent', 'updated_at', 'created_at', 'remember_token', 'created_by', 'updated_by'];
            @endphp

            @foreach($allKeys as $key)
                @if(in_array($key, $ignored)) @continue @endif
                
                <div class="change-item">
                    <div class="change-field-header">
                        {{ str_replace('_', ' ', ucfirst($key)) }}
                    </div>
                    <div class="change-comparison">
                        <div class="comparison-box box-old">
                            {!! resolveValue($key, $oldValues[$key] ?? '-') !!}
                        </div>
                        <div class="comparison-arrow">
                            <i class="ti ti-arrow-narrow-right"></i>
                        </div>
                        <div class="comparison-box box-new">
                            {!! resolveValue($key, $newValues[$key] ?? '-') !!}
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="card border-0 shadow-none bg-light p-5 text-center rounded-4">
                <i class="ti ti-checkbox text-muted fs-1 mb-2"></i>
                <p class="text-muted mb-0">No specific property changes were captured for this event.</p>
            </div>
        @endif
    </div>

</div>
@endsection
