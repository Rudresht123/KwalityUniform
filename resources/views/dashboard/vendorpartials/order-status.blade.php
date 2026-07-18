<div class="g-main-grid">
    <div class="panel">
        <div class="panel-header">
            <h3 class="panel-title"><i class="ti ti-pie-chart" style="color:var(--violet)"></i> Order Status
                Distribution</h3>
        </div>
        <div style="height:380px;">

            <div id="orderStatusChart" class="data-content" style="height:380px;"></div>
        </div>
    </div>
    <div class="panel">
        <div class="panel-header">
            <h3 class="panel-title"><i class="ti ti-building-warehouse" style="color:var(--amber)"></i>
                Inventory Health</h3>
        </div>
        <div >
            <div class="">
                <div id="inventoryHealthChart" class="data-content"></div>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', () => {
        loadOrderStatusTrend();
        renderInventoryHealth();
    });


    /**
     * Fetch Order Trend
     */
    async function loadOrderStatusTrend() {

        const url = `{{ route('ajax.vendor.order-status-ditribution') }}`;

        const response = await fetch(url);

        const data = await response.json();

        renderOrderStatusChart(data);
    }

     async function renderInventoryHealth() {

        const url = `{{ route('ajax.vendor.invntory-health') }}`;

        const response = await fetch(url);

        const data = await response.json();

        renderInventoryHealthChart(data);
    }




    /**
     * Render Order Trend Chart
     */
   function renderOrderStatusChart(data) {

    ChartHelper.bar({

        id: 'orderStatusChart',

        height: 380,

        categories: data.labels,

        series: [{
            name: 'Orders',
            data: data.data
        }],

        colors: [
            '#F59E0B', // Pending
            '#3B82F6', // Confirmed
            '#8B5CF6', // Processing
            '#06B6D4', // Packed
            '#0EA5E9', // Shipped
            '#10B981', // Delivered
            '#EF4444', // Cancelled
            '#F97316', // Returned
            '#6B7280'  // Refunded
        ],

        plotOptions: {
            bar: {
                distributed: true,
                borderRadius: 6,
                columnWidth: '45%'
            }
        },

        dataLabels: {
            enabled: true
        },

        xaxis: {
            title: {
                text: 'Order Status'
            },
            labels: {
                rotate: -20
            }
        },

        yaxis: {
            title: {
                text: 'Total Orders'
            },
            min: 0
        },

        legend: {
            show: false
        },

        tooltip: {
            y: {
                formatter(value) {
                    return `${value} Orders`;
                }
            }
        }

    });

}

function renderInventoryHealthChart(data) {

    ChartHelper.bar({

        id: 'inventoryHealthChart',

        height: 365,

        categories: data.labels,

        series: [
            {
                name: 'Variants',
                data: data.data
            }
        ],

        colors: [
            '#10B981', // In Stock
            '#F59E0B', // Low Stock
            '#EF4444', // Out of Stock
            '#6B7280'  // Inactive
        ],

        plotOptions: {
            bar: {
                horizontal: true,
                distributed: true,
                borderRadius: 6,
                barHeight: '55%'
            }
        },
        dataLabels: {
            enabled: true
        },

        legend: {
            show: false
        },

        grid: {
            borderColor: '#e5e7eb',
            strokeDashArray: 4
        },

        xaxis: {
            title: {
                text: 'Inventory Status'
            },
            labels: {
                rotate: 0
            }
        },

        yaxis: {
            title: {
                text: 'Variants'
            },
            min: 0,
            forceNiceScale: true
        },

        tooltip: {
            y: {
                formatter(value) {
                    return `${value} Variants`;
                }
            }
        }

    });

}
</script>
