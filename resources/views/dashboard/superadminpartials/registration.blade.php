<div class="section-label">User Registration Trends</div>

<div class="row">

    <!-- Registration Trend -->
    <div class="col-lg-8 panel">

        <div class="panel-header">
            <h3 class="panel-title">
                <i class="ti ti-chart-line" style="color:var(--primary)"></i>
                Schools, Vendors &amp; Web Users
            </h3>

            <span class="badge bg-light text-dark">
                {{ now()->subYear()->format('M Y') }} – {{ now()->format('M Y') }}
            </span>
        </div>

        <div class="panel-body">
            <div id="registrationTrend" class="apex-chart"></div>
        </div>

    </div>


    <!-- Summary -->

    <div class="col-lg-4 ">
        <div class="panel">
            <div class="panel-header">
                <h3 class="panel-title">
                    <i class="ti ti-chart-infographic" style="color:var(--green)"></i>
                    Registration Summary
                </h3>
            </div>
            <div class="panel-body">

                <div class="text-center mb-4">
                    <h2 class="fw-bold mb-1">
                        {{ array_sum($trends['schools']) + array_sum($trends['vendors']) + array_sum($trends['webusers']) }}
                    </h2>

                    <small class="text-muted">Total Registrations</small>
                </div>

                <div class="row g-3">

                    <div class="col-12">
                        <div class="mini-stat success">
                            <div>
                                <small>Schools</small>
                                <h5>{{ array_sum($trends['schools']) }}</h5>
                            </div>

                            <i class="ti ti-school"></i>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mini-stat primary">
                            <div>
                                <small>Vendors</small>
                                <h5>{{ array_sum($trends['vendors']) }}</h5>
                            </div>

                            <i class="ti ti-building-store"></i>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mini-stat warning">
                            <div>
                                <small>Web Users</small>
                                <h5>{{ array_sum($trends['webusers']) }}</h5>
                            </div>

                            <i class="ti ti-users"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', () => {

        ChartHelper.line({
            id: "registrationTrend",

            height: 350,

            categories: @json($trends['labels']),

            series: [
                ChartHelper.series("Schools", @json($trends['schools']), ChartHelper.colors
                .blue),
                ChartHelper.series("Vendors", @json($trends['vendors']), ChartHelper.colors
                    .green),
                ChartHelper.series("Web Users", @json($trends['webusers']), ChartHelper.colors
                    .primary)
            ],

            stroke: {
                width: 3
            },

            markers: {
                size: 4
            }
        });

    });
</script>
