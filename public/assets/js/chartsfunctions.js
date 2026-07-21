/**
 * ==========================================================
 * Quality Uniform ERP
 * ApexCharts Helper — clean, animated, premium defaults
 * ==========================================================
 *
 * Usage:
 *   ChartHelper.area({ id: 'revenueChart', series: [...], categories: [...] })
 *   ChartHelper.donut({ id: 'statusChart', series: [12,4,8], labels: [...] })
 *
 * Every chart type shares one visual language (colors, grid,
 * tooltip, legend, animation) so charts across the dashboard
 * never feel like they came from different libraries.
 */

const ChartHelper = (() => {
    const charts = {};

    /* ----------------------------------------------------------
       Palette — muted, professional. `primary` is the workhorse;
       the rest exist for multi-series charts, not decoration.
    ---------------------------------------------------------- */
    const colors = {
        primary: "#4338CA",
        indigo: "#3730A3",
        blue: "#1D4ED8",
        sky: "#0369A1",
        cyan: "#0E7490",
        emerald: "#047857",
        green: "#15803D",
        lime: "#4D7C0F",
        amber: "#B45309",
        orange: "#C2410C",
        rose: "#BE123C",
        red: "#B91C1C",
        pink: "#BE185D",
        violet: "#6D28D9",
        purple: "#5B21B6",
        gray: "#475569",
    };

    const palette = [
        colors.primary,
        colors.emerald,
        colors.amber,
        colors.sky,
        colors.rose,
        colors.violet,
        colors.gray,
    ];

    /* ----------------------------------------------------------
       Shared visual defaults, applied to every chart type.
       Deep-mergeable via `config.*` overrides in create().
    ---------------------------------------------------------- */
    function baseOptions(type, config) {
        return {
            chart: {
                type,
                height: config.height || 320,
                fontFamily: "Inter, sans-serif",
                background: "transparent",
                foreColor: "#6b7280",

                toolbar: {
                    show: config.toolbar ?? false,
                    tools: {
                        download: true,
                        selection: false,
                        zoom: false,
                        zoomin: false,
                        zoomout: false,
                        pan: false,
                        reset: false,
                    },
                    export: {
                        csv: { filename: config.filename || config.id },
                        svg: { filename: config.filename || config.id },
                        png: { filename: config.filename || config.id },
                    },
                },

                zoom: {
                    enabled: config.zoom ?? false,
                },

                animations: {
                    enabled: true,
                    easing: "easeout",
                    speed: 600,
                    animateGradually: {
                        enabled: true,
                        delay: 100,
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 300,
                    },
                },

                dropShadow: {
                    enabled: config.shadow ?? false,
                    top: 2,
                    left: 0,
                    blur: 3,
                    opacity: 0.15,
                },

                ...(config.chart || {}),
            },

            theme: {
                mode: config.theme || "light",
            },

            colors:
                config.colors ||
                (config.series || []).map((s, i) => s.color || palette[i % palette.length]),

            series: config.series || [],
            labels: config.labels || [],

            xaxis: {
                categories: config.categories || [],
                labels: {
                    style: { fontSize: "12px", colors: "#9ca3af" },
                },
                axisBorder: { show: false },
                axisTicks: { show: false },
                ...(config.xaxis || {}),
            },

            yaxis: {
                labels: {
                    style: { fontSize: "12px", colors: "#9ca3af" },
                },
                ...(config.yaxis || {}),
            },

            stroke: {
                width: 3,
                curve: "smooth",
                lineCap: "round",
                ...(config.stroke || {}),
            },

            fill: {
                type: config.fillType || "solid",
                opacity: config.fillOpacity ?? 0.9,
                gradient: {
                    shade: "light",
                    type: "vertical",
                    shadeIntensity: 0.2,
                    opacityFrom: 0.35,
                    opacityTo: 0.05,
                    stops: [0, 90, 100],
                },
                ...(config.fill || {}),
            },

            markers: {
                size: 0,
                strokeWidth: 3,
                strokeColors: "#fff",
                hover: { size: 6 },
                ...(config.markers || {}),
            },

            grid: {
                borderColor: "#EEF2F7",
                strokeDashArray: 4,
                padding: { left: 10, right: 10, top: 5, bottom: 0 },
                ...(config.grid || {}),
            },

            legend: {
                show: config.legend?.show ?? (config.series || []).length > 1,
                position: "top",
                horizontalAlign: "left",
                fontSize: "13px",
                fontWeight: 600,
                markers: { radius: 12 },
                itemMargin: { horizontal: 12 },
                ...(config.legend || {}),
            },

            tooltip: {
                theme: "light",
                shared: true,
                intersect: false,
                fillSeriesColor: false,
                marker: { show: true },
                style: { fontSize: "13px" },
                ...(config.tooltip || {}),
            },

            plotOptions: {
                bar: {
                    borderRadius: 8,
                    borderRadiusApplication: "end",
                    columnWidth: "45%",
                    distributed: false,
                },
                pie: {
                    donut: {
                        size: "72%",
                        labels: {
                            show: true,
                            total: { show: true, fontSize: "13px", color: "#9ca3af" },
                            value: { fontSize: "20px", fontWeight: 700, color: "#1c1e21" },
                        },
                    },
                },
                radialBar: {
                    hollow: { size: "62%" },
                    dataLabels: {
                        value: { fontSize: "20px", fontWeight: 700, color: "#1c1e21" },
                    },
                },
                ...(config.plotOptions || {}),
            },

            dataLabels: {
                enabled: false,
                ...(config.dataLabels || {}),
            },

            states: {
                hover: { filter: { type: "darken", value: 0.9 } },
                active: { filter: { type: "darken", value: 0.85 } },
                ...(config.states || {}),
            },

            responsive: config.responsive || [],
            annotations: config.annotations || {},

            noData: {
                text: "No data available",
                style: { color: "#9ca3af", fontSize: "13px" },
            },
        };
    }

    /**
     * Build a `{ name, data, color }` series entry.
     */
    function series(name, data, color = null) {
        return { name, data, color };
    }

    /**
     * Destroy an existing chart instance by id, if any.
     */
    function destroy(id) {
        if (charts[id]) {
            charts[id].destroy();
            delete charts[id];
        }
    }

    /**
     * Generic chart creator — every `type` helper below routes through this.
     */
    function create(type, config = {}) {
        if (!config.id) {
            console.error("ChartHelper: `id` is required.");
            return null;
        }

        const element = document.querySelector(`#${config.id}`);

        if (!element) {
            console.warn(`ChartHelper: element '#${config.id}' not found.`);
            return null;
        }

        destroy(config.id);

        const options = baseOptions(type, config);
        const chart = new ApexCharts(element, options);

        chart.render();
        charts[config.id] = chart;

        return chart;
    }

    /**
     * Patch an existing chart's options without a full re-render.
     */
    function update(id, options, redrawPaths = true, animate = true) {
        if (!charts[id]) {
            console.warn(`ChartHelper: chart '${id}' not found.`);
            return;
        }

        charts[id].updateOptions(options, redrawPaths, animate);
    }

    /**
     * Swap just the series data — cheapest way to animate value changes
     * (e.g. polling a KPI endpoint) without touching axes/labels.
     */
    function updateSeries(id, newSeries, animate = true) {
        if (!charts[id]) {
            console.warn(`ChartHelper: chart '${id}' not found.`);
            return;
        }

        charts[id].updateSeries(newSeries, animate);
    }

    return {
        colors,
        palette,

        series,
        create,
        update,
        updateSeries,
        destroy,

        line(config) {
            return create("line", config);
        },

        area(config) {
            return create("area", config);
        },

        bar(config) {
            return create("bar", config);
        },

        pie(config) {
            return create("pie", config);
        },

        donut(config) {
            return create("donut", config);
        },

        radialBar(config) {
            return create("radialBar", config);
        },

        radar(config) {
            return create("radar", config);
        },

        charts,
    };
})();