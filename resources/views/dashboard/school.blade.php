@php
    $breadcrumb = 'School Dashboard';
    $title = 'School Management Overview';
@endphp

<style>
    /* Matching Vendor Dashboard Aesthetics */
    .g-root {
        color: var(--text-primary, #1e293b);
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    }
    .section-label {
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: #6c757d;
        margin: 1.5rem 0 .75rem;
    }
    .kpi-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 10px;
        margin-bottom: 1.5rem;
    }
    .kpi-card {
        background: #fff;
        border: 1px solid #edf2f9;
        border-radius: 12px;
        padding: 14px 16px;
        transition: border-color .2s, transform .2s;
    }
    .kpi-card:hover {
        border-color: #6259ca;
        transform: translateY(-2px);
    }
    .kpi-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    .kpi-label {
        font-size: 11px;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .3px;
    }
    .kpi-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }
    .kpi-value {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1;
    }
    .kpi-sub {
        font-size: 11px;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 3px;
    }
    .icon-blue { background: rgba(42, 120, 214, .1); color: #2a78d6; }
    .icon-teal { background: rgba(27, 175, 122, .1); color: #1baf7a; }
    .icon-violet { background: rgba(74, 58, 167, .1); color: #4a3aa7; }
    .panel {
        background: #fff;
        border: 1px solid #edf2f9;
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 12px;
    }
    .panel-title {
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 14px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f1f5f9;
    }
    .charts-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    @media (max-width: 992px) {
        .charts-2col { grid-template-columns: 1fr; }
    }
    .act-row {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .act-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .act-body { flex-grow: 1; }
    .act-name { font-size: 13px; font-weight: 600; color: #1e293b; }
    .act-meta { font-size: 11px; color: #6c757d; }
</style>

<div class="g-root">
    @if(!$school)
        <div class="alert alert-warning border-0 shadow-sm">
            <div class="d-flex align-items-center">
                <i class="ti ti-alert-triangle fs-2 me-3"></i>
                <div>
                    <h6 class="fw-bold mb-1">School Not Found</h6>
                    <p class="mb-0 small">Your account is not currently linked to a registered school. Please contact the administrator.</p>
                </div>
            </div>
        </div>
    @else
        {{-- WELCOME BANNER --}}
        <div class="card custom-card shadow-sm border-0 bg-primary text-white mb-4 overflow-hidden"
            style="background: linear-gradient(135deg, #2a78d6 0%, #4a3aa7 100%) !important;">
            <div class="card-body p-4 position-relative">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="fw-bold mb-1">Welcome, {{ $school->school_name }}!</h3>
                        <p class="mb-0 text-white-50">Manage your school's uniform catalogue and classes with real-time insights.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <span class="badge bg-white text-primary rounded-pill px-4 py-2 fs-14 fw-bold shadow-sm">
                            <i class="ti ti-calendar-event me-1"></i> {{ now()->format('l, d M Y') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- KPI TILES --}}
        <div class="section-label">School Metrics</div>
        <div class="kpi-row">
            <div class="kpi-card">
                <div class="kpi-top">
                    <span class="kpi-label">Total Classes</span>
                    <span class="kpi-icon icon-violet"><i class="ti ti-book"></i></span>
                </div>
                <div class="kpi-value">{{ $kpis['total_classes'] ?? 0 }}</div>
                <div class="kpi-sub text-mute">Total defined classes</div>
            </div>

            <div class="kpi-card">
                <div class="kpi-top">
                    <span class="kpi-label">Active Classes</span>
                    <span class="kpi-icon icon-teal"><i class="ti ti-circle-check"></i></span>
                </div>
                <div class="kpi-value">{{ $kpis['active_classes'] ?? 0 }}</div>
                <div class="kpi-sub text-ok">Currently operational</div>
            </div>
        </div>

        {{-- GROWTH & TRENDS --}}
        <div class="section-label">Insights & Trends</div>
        <div class="panel mb-4">
            <div class="panel-title">
                <i class="ti ti-chart-line" style="color:#6259ca"></i>
                Class Setup Trend
            </div>
            <div id="classTrendChart"></div>
        </div>

        <div class="charts-2col">
            <div class="panel">
                <div class="panel-title">
                    <i class="ti ti-bell" style="color:#f59e0b"></i>
                    Notifications
                </div>
                <div class="notification-list" style="max-height:400px;overflow:scroll;">
                    @forelse($notifications ?? [] as $note)
                        <div class="act-row">
                            <div class="act-avatar" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                                <i class="ti ti-bell"></i>
                            </div>
                            <div class="act-body">
                                <div class="act-name">{{ $note['description'] }}</div>
                                <div class="act-meta">{{ \Carbon\Carbon::parse($note['created_at'])->diffForHumans() }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-3 text-muted small">No notifications at this time.</div>
                    @endforelse
                </div>
            </div>

            <div class="panel">
                <div class="panel-title">
                    <i class="ti ti-activity" style="color:#1baf7a"></i>
                    Recent Activity
                </div>
                <div class="activity-list" style="max-height:400px;overflow:scroll;">
                    @foreach($recentActivity ?? [] as $act)
                        <div class="act-row">
                            <div class="act-avatar" style="background:{{ $act['bg'] ?? '#eee' }};color:{{ $act['color'] ?? '#333' }}">
                                <i class="ti {{ $act['icon'] ?? 'ti-info' }}"></i>
                            </div>
                            <div class="act-body">
                                <div class="act-name">{{ $act['name'] ?? 'No details' }}</div>
                                <div class="act-meta">{{ $act['meta'] ?? 'System' }} &middot; {{ $act['time'] ?? 'N/A' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- RECENT CLASSES --}}
        <div class="section-label">Your Recent Classes</div>
        <div class="panel">
            <div class="panel-title d-flex justify-content-between align-items-center">
                <span><i class="ti ti-list-details me-2 text-primary"></i>Class List</span>
                <a href="{{ route('school-standard.edit', $school->school_id) }}" class="btn btn-sm btn-light text-primary fw-bold py-0 px-2" style="font-size: 11px;">Manage All</a>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 border-0 small text-uppercase fw-bold text-muted">Class Name</th>
                            <th class="border-0 small text-uppercase fw-bold text-muted">Status</th>
                            <th class="border-0 small text-uppercase fw-bold text-muted">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentClasses ?? [] as $rClass)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-semibold text-dark">{{ $rClass->class_name }}</div>
                                </td>
                                <td>
                                    <x-status-badge :value="$rClass->is_active" :active="true" :inactive="false" />
                                </td>
                                <td>
                                    <div class="small text-muted">{{ $rClass->created_at->format('M d, Y') }}</div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4 text-muted small italic">No classes defined yet.</td>
                                </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new ApexCharts(document.querySelector('#classTrendChart'), {
            chart: { type: 'line', height: 300, toolbar: { show: false }, zoom: { enabled: false } },
            series: [{
                name: 'Classes Added',
                data: [1, 3, 2, 5, 4, 6, 8, 5, 7, 9, 4, 6] // Placeholder data
            }],
            xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'] },
            colors: ['#6259ca'],
            stroke: { curve: 'smooth', width: 3 },
            markers: { size: 4 },
            dataLabels: { enabled: false },
            tooltip: { theme: 'light' }
        }).render();
    });
</script>
@endpush
