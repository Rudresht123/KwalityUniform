{{-- greeting sections --}}

<div class="g-root">
    @php
        $greeting = greetings();

    @endphp

  {{-- Kpi Section --}}
  @include("dashboard.superadminpartials.kpi")
    {{-- ══════════════════════════════
         MAIN GRID: charts (left) + at-a-glance sidebar (right)
    ══════════════════════════════ --}}
      @include("dashboard.superadminpartials.revenutrends")
      @include("dashboard.superadminpartials.order-trends")
      @include("dashboard.superadminpartials.registration")
      @include("dashboard.superadminpartials.product-trends")
      @include("dashboard.superadminpartials.latest-orders")
      @include("dashboard.superadminpartials.recent")
      @include("dashboard.superadminpartials.alerts")
   
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            /* ────────────────────────────────────
                  1. REGISTRATION TREND — area line
               ──────────────────────────────────── */

            

            ChartHelper.line({
                id: "revenueTrend",
                categories: @json($revenue_trend['labels'] ?? []),
                series: [
                    ChartHelper.series("Revenue", @json($revenue_trend['values'] ?? []), ChartHelper.colors
                        .green)
                ]
            });

            ChartHelper.line({
                id: "orderTrend",
                categories: @json($order_trend['labels'] ?? []),
                series: [
                    ChartHelper.series("Orders", @json($order_trend['values'] ?? []), ChartHelper.colors.blue)
                ]
            });

            ChartHelper.line({
                id: "productUploadChart",
                categories: @json($productUploadTrend['labels'] ?? []),
                series: [
                    ChartHelper.series("Products", @json($productUploadTrend['counts'] ?? []), ChartHelper.colors
                        .blue)
                ]
            });

            /* ────────────────────────────────────
               2. PRODUCT STATUS — doughnut
            ──────────────────────────────────── */
            ChartHelper.donut({

                id: "donutChart",

                height: 300,

                labels: [
                    "Approved",
                    "Pending",
                    "Rejected"
                ],

                series: [
                    {{ $kpis['approved_products'] }},
                    {{ $kpis['pending_products'] }},
                    {{ $kpis['rejected_products'] }}
                ],

                colors: [
                    "#158f63",
                    "#dc8a00",
                    "#d64545"
                ],

                plotOptions: {
                    pie: {
                        donut: {
                            size: "72%",
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: "Products",
                                    formatter: function(w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    }
                                }
                            }
                        }
                    }
                },

                stroke: {
                    width: 3,
                    colors: ["#fff"]
                },

                legend: {
                    show: false
                },

                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Products";
                        }
                    }
                }

            });

            /* ────────────────────────────────────
               3. TOP VENDORS — horizontal bar
            ──────────────────────────────────── */
            ChartHelper.bar({

                id: "vendorBar",

                height: 220,

                categories: @json($topVendors->pluck('business_name')),

                series: [
                    ChartHelper.series(
                        "Products",
                        @json($topVendors->pluck('products_count')),
                        ChartHelper.colors.blue
                    )
                ],

                colors: [
                    "rgba(67,56,202,.85)"
                ],

                chart: {
                    stacked: false
                },

                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 8,
                        borderRadiusApplication: "end",
                        barHeight: "55%",
                        distributed: false
                    }
                },

                grid: {
                    borderColor: "#edeef7",
                    strokeDashArray: 3
                },

                legend: {
                    show: false
                },

                dataLabels: {
                    enabled: true,
                    offsetX: 15,
                    style: {
                        fontSize: "11px",
                        fontWeight: 600
                    }
                },

                stroke: {
                    width: 0
                },

               xaxis:{
    labels:{
        rotate:-45,
        trim:true,
        maxHeight:120
    }
},

                yaxis: {
                    labels: {
                        style: {
                            fontSize: "12px",
                            colors: "#1a1a2e",
                            fontWeight: 500
                        }
                    }
                },

                tooltip: {
                    y: {
                        formatter: function(value) {
                            return value + " Products";
                        }
                    }
                }

            });

            /* ────────────────────────────────────
               4. MONTHLY SCHOOL REGISTRATIONS — column bar
            ──────────────────────────────────── */
            ChartHelper.bar({

                id: "schoolBar",

                height: 300,

                categories: @json($trends['school_labels'] ?? array_slice($trends['labels'], -6)),

                series: [
                    ChartHelper.series(
                        "Schools",
                        @json($trends['school_monthly'] ?? array_slice($trends['schools'], -6)),
                        ChartHelper.colors.blue
                    )
                ],

                colors: [
                    "#4338CA"
                ],

                chart: {
                    stacked: false
                },

                plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 8,
                        borderRadiusApplication: "end",
                        columnWidth: "45%",
                        distributed: false
                    }
                },

                grid: {
                    borderColor: "#edeef7",
                    strokeDashArray: 3
                },

                stroke: {
                    width: 0
                },

                dataLabels: {
                    enabled: true,
                    offsetY: -20,
                    style: {
                        fontSize: "11px",
                        fontWeight: 600
                    }
                },

                legend: {
                    show: false
                },

                xaxis: {
                    labels: {
                        style: {
                            fontSize: "11px",
                            colors: "#6b6b85"
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },

                yaxis: {
                    labels: {
                        style: {
                            fontSize: "11px",
                            colors: "#6b6b85"
                        }
                    }
                },

                tooltip: {
                    y: {
                        formatter: function(value) {
                            return value + " Schools";
                        }
                    }
                }

            });

            /* ────────────────────────────────────
               5. PRODUCT DISTRIBUTION — Parent Category & Category
            ──────────────────────────────────── */
            ChartHelper.bar({
                id: "parentCategoryChart",
                height: 300,
                categories: @json(array_column($parentCategoryCounts ?? [], 'name')),
                series: [
                    ChartHelper.series(
                        "Products",
                        @json(array_column($parentCategoryCounts ?? [], 'product_count')),
                        ChartHelper.colors.blue
                    )
                ],
                colors: ["#4338CA"],
                chart: {
                    stacked: false
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 6
                    }
                },
                grid: {
                    borderColor: "#edeef7",
                    strokeDashArray: 3
                },
                legend: {
                    show: false
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Products";
                        }
                    }
                }
            });

            ChartHelper.bar({
                id: "categoryChart",
                height: 300,
                categories: @json(array_column($categoryCounts ?? [], 'category_name')),
                series: [
                    ChartHelper.series(
                        "Products",
                        @json(array_column($categoryCounts ?? [], 'product_count')),
                        ChartHelper.colors.green
                    )
                ],
                colors: ["#158f63"],
                chart: {
                    stacked: false
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 6,
                        columnWidth: "50%"
                    }
                },
                grid: {
                    borderColor: "#edeef7",
                    strokeDashArray: 3
                },
                legend: {
                    show: false
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Products";
                        }
                    }
                }
            });

            /* ────────────────────────────────────
               6. SCHOOLS BY BOARD — stacked horizontal bar
            ──────────────────────────────────── */
            // Removed due to removal of school board concept
        });
    </script>
@endpush
