$(document).ready(function() {
    $.ajax({
        url         : "/a/home/laporan-pendapatan",
        type        : "GET",
        dataType    : "JSON",
        success     : function(result) {
            // console.log(result);

            var databulan = [];
            var datatotal = [];
                       for(var i=0; i<result.length; i++) {
                           databulan[i] = result[i]['bulan'];
                           datatotal[i] = parseInt(result[i]['total']);
                       }
                       console.log(databulan);
                       console.log(datatotal);

                       if($('#grafik-pendapatan').length) {
                           var date = new Date();
                           Highcharts.chart('grafik-pendapatan', {
                               chart: {
                                   type: 'column'
                               },
                               title: {
                                   text: 'Grafik Pendapatan Perusahaan Tahun ' + date.getFullYear()
                               },
                               subtitle: {
                                   text: 'Faktur Penjualan'
                               },
                               xAxis: {
                                   categories: databulan,
                                   title: {
                                       text: 'Tanggal'
                                   },
                                   crosshair: true
                               },
                               yAxis: {
                                   min: 0,
                                   title: {
                                       text: 'Jumlah Pendapatan'
                                   }
                               },
                               plotOptions: {
                                   column: {
                                       pointPadding: 0.2,
                                       borderWidth: 0
                                   }
                               },
                               series:[ {
                                   name: 'Pendapatan',
                                   data: datatotal
                               }]
                           });
                       }
        }
    });
})
