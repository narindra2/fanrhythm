
$(function() {
    var chartDashboar = null;
    var start = moment().subtract(7, 'days').format('DD/MM/YYYY');
    var end = moment().format('DD/MM/YYYY');
   
    $(function() {
        $('input[name="datetimes"]').daterangepicker({
            startDate: start,
            endDate: end,
            locale: {
                format: 'DD/MM/YYYY'
            },
            ranges: {
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
               'Last 60 Days': [moment().subtract(59, 'days'), moment()],
            }
        }).on('apply.daterangepicker', (e, picker) => {
            var startDate = picker.startDate.format('YYYY-MM-DD');
            var endDate = picker.endDate.format('YYYY-MM-DD');
            getDataChart(startDate ,endDate);
          });
      });
      getDataChart(start ,end);

      function getDataChart(startDate = '' ,endDate){
        $.ajax({
            type: 'POST',
            url: app.baseUrl + '/my/settings/dashboard/get-chart-data',
            data : {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'startDate' : startDate,
                'endDate' : endDate,
            },
            success: function (result) {
                // launchToast('success','Success ',result.message,'now');
                if (result.success) {
                    if (chartDashboar) {
                        chartDashboar.destroy();
                    }
                    const ctx = document.getElementById('myChart');
                    chartDashboar =  new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels:result.chartData.labels ,
                            datasets:result.chartData.datasets 
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Gaing'
                                }
                            },
                            scales: {
                                y: {
                                    min: 0,
                                    max: 50,
                                }
                            }
                        },
                    });
                    $('#table-info').html(result.table)
                }
            },
            error: function (result) {
               
            }
        });
      }
      
      
});