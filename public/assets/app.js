$(document).ready(function() {
    $.ajax({
        url         : "/a/home/laporan-pendapatan",
        type        : "GET",
        dataType    : "JSON",
        success     : function(result) {
            // console.log(result);

            var data = [];
                       for(var i=0; i<result.length; i++) {
                           data[i] = parseInt(result[i]['total']);
                       }
                       console.log(data);

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
                                   text: 'VIOLET'
                               },
                               xAxis: {
                                   categories: [
                                       'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Des'
                                   ],
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
                                   data: data
                               }]
                           });
                       }
        }
    });
})