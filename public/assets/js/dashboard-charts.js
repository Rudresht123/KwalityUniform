/**
 * Reusable Dashboard Chart Initializer
 *
 * This function handles the creation of ApexCharts with consistent styling.
 *
 * @param {string} selector - CSS selector for the chart container
 * @param {string} type - 'pie', 'donut', or 'bar'
 * @param {Array} series - Data values
 * @param {Array} labels - Data labels
 * @param {Object} options - Optional overrides
 */
function initDashboardChart(selector, type, series, labels, options = {}) {
    const container = document.querySelector(selector);
    if (!container) return;

    // Default configuration based on chart type
    let defaultOptions = {
        series: series,
        chart: {
            height: options.height || 300,
            type: type,
            fontFamily: 'inherit',
            toolbar: { show: false }
        },
        labels: labels,
        colors: options.colors || ['#6259ca', '#28a745', '#ffc107', '#dc3545', '#17a2b8'],
        legend: {
            position: 'bottom',
            fontSize: '13px',
            markers: { radius: 12 }
        },
        dataLabels: {
            enabled: type === 'pie',
            formatter: function (val) {
                return Math.round(val) + "%"
            }
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        responsive: [{
            breakpoint: 480,
            options: {
                chart: { width: 200 },
                legend: { position: 'bottom' }
            }
        }]
    };

    // Specific overrides for 'bar' charts
    if (type === 'bar') {
        defaultOptions.plotOptions = {
            bar: {
                distributed: true,
                borderRadius: 4,
                columnWidth: '45%',
            }
        };
        defaultOptions.dataLabels.enabled = false;
        defaultOptions.xaxis = {
            categories: labels,
            axisBorder: { show: false },
            axisTicks: { show: false }
        };
        defaultOptions.yaxis = {
            labels: {
                formatter: function (val) {
                    return Math.floor(val);
                }
            }
        };
        defaultOptions.legend.show = false;
    }

    // Specific overrides for 'donut'
    if (type === 'donut') {
        defaultOptions.plotOptions = {
            pie: {
                donut: {
                    size: '70%',
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total',
                            formatter: function (w) {
                                return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                            }
                        }
                    }
                }
            }
        };
    }

    // Specific overrides for 'area'
    if (type === 'area') {
        defaultOptions.stroke = {
            curve: 'smooth',
            width: [3, 3],
            dashArray: [0, 8] // Make the second line dashed like in the image
        };
        defaultOptions.fill = {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.4,
                opacityTo: 0.1,
                stops: [0, 90, 100]
            }
        };
        defaultOptions.markers = {
            size: 4,
            hover: { size: 6 }
        };
        defaultOptions.dataLabels.enabled = false;
        defaultOptions.xaxis = {
            categories: labels,
            axisBorder: { show: false },
            axisTicks: { show: false },
            tooltip: { enabled: false }
        };
        defaultOptions.grid = {
            borderColor: '#f2f2f2',
            strokeDashArray: 5, // Dotted grid lines
            xaxis: {
                lines: { show: true }
            },
            yaxis: {
                lines: { show: true }
            }
        };
        defaultOptions.legend = {
            show: true,
            position: 'top',
            horizontalAlign: 'center',
            fontSize: '13px',
            markers: { radius: 12, width: 10, height: 10 }
        };
    }

    // Merge with user-provided options
    const finalOptions = { ...defaultOptions, ...options };

    const chart = new ApexCharts(container, finalOptions);
    chart.render();
    return chart;
}
