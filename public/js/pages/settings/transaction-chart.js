
$(function() {
    var chartDashboar = null;
    var start = moment().subtract(7, 'days').format('DD/MM/YYYY');
    var today = moment().format('DD/MM/YYYY');
   
    var rangers = {
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'Last 60 Days': [moment().subtract(59, 'days'), moment()],
     };
     
    if (user.userLang == "fr") {
        rangers = {
        'Ces 7 derniers jours': [moment().subtract(6, 'days'), moment()],
        'Le mois dernier': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        '60 derniers jours': [moment().subtract(59, 'days'), moment()],
     };
    }

    $(function() {
        getDataChart(start ,today);
        $('input[name="datetimes"]').daterangepicker({
            startDate: start,
            endDate: today,
            maxDate : today,
            locale: {
                format: 'DD/MM/YYYY',
                "applyLabel": trans('Appliquer'),
                "cancelLabel": trans("Annuler"),
                "fromLabel": trans("Depuis") ,
                "toLabel": trans("à") ,
                "customRangeLabel":  trans("Personnaliser") ,
            },
            ranges:rangers ,
        }).on('apply.daterangepicker', (e, picker) => {
            var startDate = picker.startDate.format('YYYY-MM-DD');
            var endDate = picker.endDate.format('YYYY-MM-DD');
            getDataChart(startDate ,endDate);
          });
          $("#icon-calendar").on("click" , function(){
            $('input[name="datetimes"]').trigger('click')
          })
      });

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
                        display: false,
                        data: {
                            labels:result.chartData.labels ,
                            datasets:result.chartData.datasets 
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                title: {
                                    display: true,
                                    // text: 'Gaing'
                                },
                                legend: {
                                    display: false // Désactiver l'affichage de la légende
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