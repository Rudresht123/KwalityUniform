/**
 * ==========================================================
 * Quality Uniform ERP
 * ApexCharts Helper
 * ==========================================================
 */

const ChartHelper = (() => {

    const charts = {};

    const colors = {
        primary: "#6259CA",
        blue: "#2A78D6",
        green: "#1BAF7A",
        orange: "#FF9F43",
        red: "#EA5455",
        cyan: "#00CFE8",
        yellow: "#FFC107",
        gray: "#6C757D"
    };

    const defaults = {

        chart: {
            toolbar: {
                show: false
            },
            zoom: {
                enabled: false
            },
            animations: {
                enabled: true,
                easing: "easeinout",
                speed: 700
            }
        },

        dataLabels: {
            enabled: false
        },

        stroke: {
            width: 3,
            curve: "smooth"
        },

        grid: {
            borderColor: "#edf2f7",
            strokeDashArray: 4
        },

        legend: {
            position: "top",
            horizontalAlign: "left",
            fontSize: "13px"
        },

        tooltip: {
            shared: true,
            intersect: false
        },

        noData: {
            text: "No data available"
        }

    };


    /**
     * Helper for Series
     */
    function series(name, data, color = null) {

        return {
            name,
            data,
            color
        };

    }


    /**
     * Destroy Existing Chart
     */
    function destroy(id) {

        if (charts[id]) {

            charts[id].destroy();

            delete charts[id];

        }

    }


    /**
     * Create Chart
     */
 /**
 * Generic Chart Creator
 */
function create(type, config = {}) {

    if (!config.id) {
        console.error("Chart id is required.");
        return null;
    }

    const element = document.querySelector(`#${config.id}`);

    if (!element) {
        console.warn(`Chart '${config.id}' not found.`);
        return null;
    }

    destroy(config.id);

    const options = {

        chart: {
            type,
            height: config.height || 320,

            toolbar: {
                show: config.toolbar ?? true,

                tools: {
                    download: true,
                    selection: true,
                    zoom: true,
                    zoomin: true,
                    zoomout: true,
                    pan: true,
                    reset: true
                },

                export: {
                    csv: {
                        filename: config.filename || config.id
                    },
                    svg: {
                        filename: config.filename || config.id
                    },
                    png: {
                        filename: config.filename || config.id
                    }
                }
            },

            zoom: {
                enabled: config.zoom ?? false
            },

            animations: {
                enabled: true,
                easing: "easeinout",
                speed: 700
            },

            ...(config.chart || {})
        },

        theme: {
            mode: config.theme || "light"
        },

        series: config.series || [],

        labels: config.labels || [],

        colors: config.colors ||
            (config.series || []).map(s => s.color || colors.primary),

        xaxis: {
            categories: config.categories || [],
            ...(config.xaxis || {})
        },

        yaxis: config.yaxis || {},

        stroke: {
            width: 3,
            curve: "smooth",
            ...(config.stroke || {})
        },

        fill: {
            ...(config.fill || {})
        },

        markers: {
            ...(config.markers || {})
        },

        grid: {
            borderColor: "#edf2f7",
            strokeDashArray: 4,
            ...(config.grid || {})
        },

        legend: {
            position: "top",
            horizontalAlign: "left",
            fontSize: "13px",
            ...(config.legend || {})
        },

        tooltip: {
            shared: true,
            intersect: false,
            ...(config.tooltip || {})
        },

        plotOptions: {
            ...(config.plotOptions || {})
        },

        dataLabels: {
            enabled: false,
            ...(config.dataLabels || {})
        },

        responsive: config.responsive || [],

        annotations: config.annotations || {},

        states: config.states || {},

        noData: {
            text: "No data available"
        }

    };

    const chart = new ApexCharts(element, options);

    chart.render();

    charts[config.id] = chart;

    return chart;

}


    /**
     * Update Existing Chart
     */
    function update(id, options) {

        if (!charts[id]) {

            console.warn(`Chart '${id}' not found.`);

            return;

        }

        charts[id].updateOptions(options);

    }


    return {

        colors,

        series,

        create,

        update,

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

        charts

    };

})();