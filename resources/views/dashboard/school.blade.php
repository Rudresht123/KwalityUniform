@php
    $greeting = greetings();
@endphp

<div class="g-root" data-loading="true">

    <div class="dashboard-greeting">
        <div class="greeting-content">
            <h1>
                {{ $greeting['icon'] }}
                {{ $greeting['title'] }}, {{ $stats['school']->school_name ?? '' }}
            </h1>

            <p>{{ $greeting['message'] }}</p>
        </div>

        <div class="greeting-date">
            <div>{{ now()->format('l') }}</div>
            <span>{{ now()->format('d M Y • h:i A') }}</span>
        </div>
    </div>

    @if (!isset($stats['school']))
        <div class="alert alert-warning">
            School data not found.
        </div>
    @else
        {{-- KPI --}}
        @include('dashboard.schoolpartials.kpi')

        {{-- Charts --}}
        <div class="section-label">
            Business Performance
        </div>
        @include('dashboard.schoolpartials.trend')


        <div class="section-label">
            Recent Orders
        </div>

        @include('dashboard.schoolpartials.recent_orders')
    @endif

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {

        if (typeof ChartHelper === "undefined") {
            console.error("ChartHelper not loaded.");
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Registration Trend
        |--------------------------------------------------------------------------
        */

        const registrationLabels = @json(array_keys($stats['registration_trend'] ?? []));
        const registrationData = @json(array_values($stats['registration_trend'] ?? []));

        if (document.getElementById("reg-trend-chart")) {

            ChartHelper.bar({

                id: "reg-trend-chart",

                height: 340,

                categories: registrationLabels,

                series: registrationData.some(v => Number(v) > 0) ? [
                    ChartHelper.series(
                        "Registrations",
                        registrationData,
                        ChartHelper.colors.blue
                    )
                ] : [],

                noData: {
                    text: "No registration data available"
                },

                plotOptions: {
                    bar: {
                        columnWidth: "42%",
                        borderRadius: 8
                    }
                }

            });

        }

        /*
        |--------------------------------------------------------------------------
        | Completion Trend
        |--------------------------------------------------------------------------
        */
        const completionTrend = @json($stats['completion_trend']);

        const completionLabels = completionTrend.labels;
        const completionData = completionTrend.data;

        console.log(completionLabels);
        console.log(completionData);

        if (document.getElementById("completion-trend-chart")) {

            ChartHelper.line({
                id: "completion-trend-chart",

                height: 340,

                categories: completionLabels,

                series: completionData.some(v => Number(v) > 0) ?
                    [
                        ChartHelper.series(
                            "Completed Orders",
                            completionData,
                            ChartHelper.colors.emerald
                        )
                    ] :
                    [],

                noData: {
                    text: "No completed orders available"
                },

                stroke: {
                    width: 4,
                    curve: "smooth"
                },

                markers: {
                    size: 5
                }
            });

        }



    });
</script>
