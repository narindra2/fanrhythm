<div>
    <form name="{{ $name }}" action="{{ route($route) }}" method="get">

    <div class="afrifan_chart_title">
        <div>
        Évolutions des inscriptions
        </div>
        <div>
        <input type="hidden" name="function" value="{{ $form['function'] }}">
                <input type="hidden" name="unit" value="{{ $form['unit'] }}">
                <select name="range" class="card-value">
                    @foreach($form['ranges'] as $range)
                    <option value="{{ $range }}" @if($form['range']==$range) selected @endif>
                    {{ $range }} mois </option>
                    @endforeach
                </select>


        </div>
    </div>
       
    <div class="afrifan_canvas">
        <div class="text-muted font-weight-medium">
                    <span class="d-none text-danger" data-card-status-error></span>
                    <span data-card-status-loading>{{ __('Loading...') }}</span>
                </div>

                <div  style="height: 336px" data-card-chart>
                    <canvas id="{{ $name }}"></canvas>
                </div>
    </div>

    </form>
</div>


<script>
    "use strict";
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.querySelector('#{{ $name }}').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, {{ $chart['size'] }});
        gradient.addColorStop(0, '#D8E8F5');
        gradient.addColorStop(1, '#D8E8F5');
        const {{ $name }} = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: '{{ $title }}',
                    backgroundColor : gradient,
                    borderColor: '#28A0F0',
                    data: []
                }]
            },
            options: {
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return parseFloat(tooltipItem.value).format(0, 3, '{{ __('thousands_separator') }}').toString();
                        }
                    }
                },
                scales: {
                    xAxes: [{
                        display: false
                    }],
                    yAxes: [{
                        display: false
                    }],
                },
                responsive: true,
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        right:10,
                        left:10,
                        top:5,
                        bottom:5,
                    }
                }
            }
        });
        getCardTrend(document.querySelector('form[name="{{ $name }}"]'), {{ $name }}, '{{ __('thousands_separator') }}', {{ $chart['total'] }});
        document.querySelector('form[name="{{ $name }}"] select[name="range"]').addEventListener('change' , function() {
            getCardTrend(document.querySelector('form[name="{{ $name }}"]'), {{ $name }}, '{{ __('thousands_separator') }}', {{ $chart['total'] }});
        });
    });
</script>
