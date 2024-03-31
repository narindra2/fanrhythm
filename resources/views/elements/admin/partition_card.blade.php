<div>
    <form name="{{ $name }}" action="{{ route($route) }}" method="get">
        <div class="afrifan_chart_title">
            <div>
                Comptes vérifiés
            </div>
            <div>
            </div>
        </div>
        <input type="hidden" name="api_token" value="">
        <input type="hidden" name="function" value="{{ $form['function'] }}">
        <div class="afrifan_circle_chart">
            <div style="height: 256px; width: 256px;margin: auto;" data-card-chart>
                <canvas id="{{ $name }}"></canvas>
            </div>
        </div>
        <div data-card-legend class="afrifan_chart_info">
            <div data-legend-placeholder>
                <div>
                    <span class="chart-legend mr-2 rounded d-inline-block"></span>
                    <span data-legend-name></span>
                </div>
                <div>
                    <span class="text-muted" data-legend-value></span>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    "use strict";
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.querySelector('#{{ $name }}').getContext('2d');
        const {{ $name }} = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [],
                datasets: [{
                    data: [],
                    borderWidth: 0
                }]
            },
            options: {
                legend: false,
                cutoutPercentage: 85,
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0
                    },
                    margin: {
                        top: 0,
                        right: 0,
                        bottom: 0,
                        left: 0
                    }
                },
                tooltips: {
                    callbacks: {
                        title: function(tooltipItem, data) {
                            return data.labels[tooltipItem[0].index];
                        },
                        label: function(tooltipItem, data) {
                            let values = data.datasets[0].data;
                            let value = parseFloat(data.datasets[0].data[tooltipItem.index]);
                            let total = 0;  // Variable to hold your total
                            for(let i = 0, len = values.length; i < len; i++) {
                                total += parseFloat(values[i]);
                            }
                            return data.datasets[0].data[tooltipItem.index] + ' (' + Number.parseFloat(Math.abs(((value/total) * 100)).toFixed(2)).toString() + '%)';
                        }
                    }
                }
            }
        });
        getCardPartition(document.querySelector('form[name="{{ $name }}"]'), {{ $name }}, '{{ __('thousands_separator') }}', '{{ $chart['color'] }}');
    });
</script>
