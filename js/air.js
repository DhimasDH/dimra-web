$(document).ready(function(){
    // jika js gajalan silakan hapus cache browser
    uri=window.location.href;
    e=uri.split("=");
    // console.log("URI : "+uri+" e[1]:"+e[1]+" e[2]:"+e[2]);
    // console.log("level : ", lvl);
    // console.log("user : ", user);

    if(e[1]=="user" || e[1]=="user_edit&user") {
        // pemyembunyian
        $("#summary").hide();
        $("#chart, #user_add, #tarif_list, #tarif_add, #meter_list, #meter_add, #pribadi_list, #pembayaran_warga, #tagihan, #bayar, #pilih_waktu").hide();
        if(e[1]=="user") {
            $("#summary").hide();
            $("#chart, #user_add").hide();
        } else {
            $("#summary").hide();
            $("#chart, #user_list").hide();
            $("#user_add").show();

            // reset tombol edit
            $("#user_form button").val('user_edit');

            // disable primary key
            $("#user_form input[name='username']").attr("disabled",true);

            // tambah elemen input header
            $("#user_form").append("<input type=hidden name=username value="+e[2]+">")

        }
        // tambah user
        $(".datatable-dropdown").append("<button type=button class='btn btn-outline-dark float-start me-2'><i class='fa-solid fa-user-plus'></i> User</button>")
        // membuat tombol diklik
        $(".datatable-dropdown button").click(function(){
        $("#user_add").show();
        $("#user_list").hide();
        $("#user_form textarea").val('');
        $("#user_form input").val('');
        $("#user_form input[name='username']").attr("disabled",false);
        $("#user_form select[name='tipe']").val('');
        $("#user_form select[name='status']").val('');
        $("#user_form select[name='level']").val('');
        })
        if ($("#alert-user").hasClass("alert-danger")) {
            $("#user_add").show();
            $("#user_list").hide();
        } else if ($("#alert-user").hasClass("alert-success")) {
            $("#user_add").hide();
            $("#user_list").show();
        }
        // buat konfirmasi hapus data
        $("button[data-bs-toggle='modal']").click(function(){
            // console.log("keluae");
            user=$(this).attr('data-user');
            $("#myModal .modal-body").text("Yakin Hapus Data "+user);
            $(".modal-footer form").append("<input type=hidden name=user value="+user+">");
        })
        
    }   
    else if(e[1]=="tarif" || e[1]=="tarif_edit&kd_tarif") {
        // pemyembunyian
        $("#summary").hide();
        $("#chart, #user_add, #user_list, #meter_list, #meter_add, #pribadi_list, #pembayaran_warga, #tagihan, #bayar, #pilih_waktu").hide();
        if(e[1]=="tarif") {
            $("#summary").hide();
            $("#chart, #tarif_add").hide();
            $("#tarif_list").show();
        } else {
            $("#summary").hide();
            $("#chart, #tarif_list").hide();
            $("#tarif_add").show();

            // reset tombol edit
            $("#tarif_form button").val('tarif_edit');

            // disable primary key
            $("#tarif_form input[name='kd_tarif']").attr("disabled",true);

            // tambah elemen input header
            $("#tarif_form").append("<input type=hidden name=kd_tarif value="+e[2]+">")

        }
        const datatablesSimple = document.getElementById('tarif_table');
        if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
        }
        // tambah user
        $(".datatable-dropdown").append("<button type=button class='btn btn-outline-dark float-start me-2'><i class='fa-solid fa-money-bill'></i> Tarif</button>")
        // membuat tombol diklik
        $(".datatable-dropdown button").click(function(){
        $("#tarif_add").show();
        $("#tarif_list").hide();
        $("#tarif_form button").val('tarif_add');
        $("#tarif_form input[name='kd_tarif']").attr("disabled",false);
        $("#tarif_form select[name='tipe']").val('');
        $("#tarif_form select[name='status']").val('');
        $("#tarif_form input").val('');
        })
        if ($("#alert-tarif").hasClass("alert-danger")) {
            $("#tarif_add").show();
            $("#tarif_list").hide();
        } else if ($("#alert-tarif").hasClass("alert-success")) {
            $("#tarif_add").hide();
            $("#tarif_list").show();
        }
        // buat konfirmasi hapus data
        $("button[data-bs-toggle='modal']").click(function(){
        // // console.log("keluae");
            kd_tarif=$(this).attr('data-kd_tarif');
            $("#myModal .modal-body").text("Yakin Hapus Data Kode Tarif "+kd_tarif);
            $(".modal-footer form").append("<input type=hidden name=kd_tarif value="+kd_tarif+">");
            $(".modal-footer button").val("tarif_hapus");
        })
        
        
    } 
    else if(e[1]=="catat_meter" || e[1]=="meter_edit&no") {
        // pemyembunyian
        $("#summary").hide();
        $("#chart, #user_add, #user_list, #tarif_add, #tarif_list, #pribadi_list, #pembayaran_warga, #tagihan, #bayar, #pilih_waktu").hide();
        if(e[1]=="catat_meter") {
             $("#meter_add").hide();
             $("#meter_list").show();
        } else {
            
             $("#summary, #chart, #meter_list").hide();
             $("#meter_add").show();

             // reset tombol edit
             $("#meter_form button").val('meter_edit');

             // disable
              $("#meter_form input[name='no']").attr("disabled",true);
              $("#meter_form select[name='username']").attr("disabled",true);

             // tambah elemen input header
              $("#meter_form").append("<input type=hidden name=no value="+e[2]+">")

         }
        const datatablesSimple = document.getElementById('meter_table');
        if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
        } if (lvl == "bendahara") {
            
        } else {
            // tambah user
            $(".datatable-dropdown").append("<button type=button class='btn btn-outline-dark float-start me-2'><i class='fa-solid fa-upload'></i> Meter</button>")
        }
        
        // membuat tombol diklik
        $(".datatable-dropdown button").click(function(){
        $("#meter_add").show();
        $("#meter_list").hide();
        $("#meter_form button").val('meter_add');
        $("#meter_form select[name='username']").attr("disabled",false);
        $("#meter_form input").val('');
        $("#meter_form select").val('');
        
        }) 
        if ($("#alert-meter").hasClass("alert-danger")) {
            $("#meter_add").show();
            $("#meter_list").hide();
        } else if ($("#alert-meter").hasClass("alert-success")) {
            $("#meter_add").hide();
            $("#meter_list").show();
        }
        // buat konfirmasi hapus data
        $("button[data-bs-toggle='modal']").click(function(){
        //  console.log("keluae");
            no=$(this).attr('data-no');
            $("#myModal .modal-body").text("Yakin Hapus Data Meter "+no);
            $(".modal-footer form").append("<input type=hidden name=no value="+no+">");
            $(".modal-footer button").val("meter_hapus");
        })
        
        
    }
    else if(e[1]=="pemakaian_pribadi" || e[1]=="bayar&no") {
        // pemyembunyian
        $("#summary").hide();
        $("#chart, #user_add, #user_list, #tarif_add, #tarif_list, #meter_list, #meter_add, #pembayaran_warga, #tagihan, #bayar, #pilih_waktu").hide();
        if(e[1]=="pemakaian_pribadi") {
             $("#bayar").hide();
             $("#pribadi_list").show();
        } else {
             $("#pribadi_list").hide();
             $("#bayar").show();

             // tambah elemen input header
              $("#bayar_form").append("<input type=hidden name=no_bayar value="+e[2]+">")

         }
        if ($("#alert-bayar").hasClass("alert-danger")) {
            $("#bayar").show();
            $("#pribadi_list").hide();
        } else if ($("#alert-bayar").hasClass("alert-success")) {
            $("#bayar").hide();
            $("#pribadi_list").show();
        }
        
        const datatablesSimple = document.getElementById('pribadi_table');
        if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
        }
    }
    else {
        //diklik dahsboard
        $("#summary").show();
        $("#chart").show();
        $("#pilih_waktu select[name='pilih_waktu']").on("change",function(){
            bln=$(this).val();
            // console.log("milih "+bln);

            $.ajax({
                type: "post",
                url: "../assets/ajax.php",
                data: {p:"summary",t:bln,u:user,l:lvl},
                dataType: "json"
            })
            .done(function(d){
                if (lvl == "petugas" || lvl == "admin") {
                    blm_dicatat=d[0].jml_pelanggan-d[2].jml_air;
                    $("#summary .bg-primary h1").text(d[0].jml_pelanggan);
                    $("#summary .bg-warning h1").text(Number(d[1].pmk_air).toLocaleString('id-ID'));
                    $("#summary .bg-success h1").text(d[2].jml_air);
                    $("#summary .bg-danger h1").text(blm_dicatat);
                    //chartpie
                    data=d.filter((num,index)=>index > 2 && index < 5);
                    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#292b2c';

                    // Pie Chart Example
                    var ctx = document.getElementById("myPieChart");
                    var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ["Kos ", "RT "],
                        datasets: [{
                        data: data,
                        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
                        }],
                    },
                    });
                    
                    if (lvl == "petugas") {
                        //chartbar
                        // bar1
                        sumbux=d.filter((num,index)=>index > 4 && index % 4 == 1);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 4 == 2);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Bar Chart Example
                        var ctx = document.getElementById("myBarChart1");
                        var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Sudah tercatat ",
                            backgroundColor: "rgba(2,117,216,1)",
                            borderColor: "rgba(2,117,216,1)",
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'month'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 6
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 5,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                display: true
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                        // bar2
                        sumbux=d.filter((num,index)=>index > 4 && index % 4 == 1);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 4 == 3);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Bar Chart Example
                        var ctx = document.getElementById("myBarChart2");
                        var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Belum tercatat ",
                            backgroundColor: "rgba(2,117,216,1)",
                            borderColor: "rgba(2,117,216,1)",
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'month'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 6
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 5,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                display: true
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                        //chartline
                        sumbux=d.filter((num,index)=>index > 4 && index % 4 == 1);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 4 == 0);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Area Chart Example
                        var ctx = document.getElementById("myAreaChart");
                        var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Pemakaian (m3) ",
                            lineTension: 0.3,
                            backgroundColor: "rgba(2,117,216,0.2)",
                            borderColor: "rgba(2,117,216,1)",
                            pointRadius: 5,
                            pointBackgroundColor: "rgba(2,117,216,1)",
                            pointBorderColor: "rgba(255,255,255,0.8)",
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(2,117,216,1)",
                            pointHitRadius: 50,
                            pointBorderWidth: 2,
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'date'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 150,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                    }
                    else {
                        //chartbar
                        // bar1
                        sumbux=d.filter((num,index)=>index > 4 && index % 8 == 5);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 8 == 6);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Bar Chart Example
                        var ctx = document.getElementById("myBarChart1");
                        var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Sudah tercatat ",
                            backgroundColor: "rgba(2,117,216,1)",
                            borderColor: "rgba(2,117,216,1)",
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'month'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 6
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 5,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                display: true
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                        // bar2
                        sumbux=d.filter((num,index)=>index > 4 && index % 8 == 5);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 8 == 7);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Bar Chart Example
                        var ctx = document.getElementById("myBarChart2");
                        var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Belum tercatat ",
                            backgroundColor: "rgba(2,117,216,1)",
                            borderColor: "rgba(2,117,216,1)",
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'month'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 6
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 5,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                display: true
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                        // bar3
                        sumbux=d.filter((num,index)=>index > 4 && index % 8 == 5);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 8 == 0);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Bar Chart Example
                        var ctx = document.getElementById("myBarChartc");
                        var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Sudah lunas ",
                            backgroundColor: "rgba(2,117,216,1)",
                            borderColor: "rgba(2,117,216,1)",
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'month'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 6
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 5,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                display: true
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                        // bar4
                        sumbux=d.filter((num,index)=>index > 4 && index % 8 == 5);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 8 == 1);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Bar Chart Example
                        var ctx = document.getElementById("myBarChartd");
                        var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Belum lunas ",
                            backgroundColor: "rgba(2,117,216,1)",
                            borderColor: "rgba(2,117,216,1)",
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'month'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 6
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 5,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                display: true
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                        //chartline
                        //line1
                        sumbux=d.filter((num,index)=>index > 4 && index % 8 == 5);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 8 == 2);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Area Chart Example
                        var ctx = document.getElementById("myAreaChart");
                        var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Pemakaian (m3) ",
                            lineTension: 0.3,
                            backgroundColor: "rgba(2,117,216,0.2)",
                            borderColor: "rgba(2,117,216,1)",
                            pointRadius: 5,
                            pointBackgroundColor: "rgba(2,117,216,1)",
                            pointBorderColor: "rgba(255,255,255,0.8)",
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(2,117,216,1)",
                            pointHitRadius: 50,
                            pointBorderWidth: 2,
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'date'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 150,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                        //line 2
                        sumbux=d.filter((num,index)=>index > 4 && index % 8 == 5);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 8 == 3);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Area Chart Example
                        var ctx = document.getElementById("myAreaChartb");
                        var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Tagihan (Rp) ",
                            lineTension: 0.3,
                            backgroundColor: "rgba(2,117,216,0.2)",
                            borderColor: "rgba(2,117,216,1)",
                            pointRadius: 5,
                            pointBackgroundColor: "rgba(2,117,216,1)",
                            pointBorderColor: "rgba(255,255,255,0.8)",
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(2,117,216,1)",
                            pointHitRadius: 50,
                            pointBorderWidth: 2,
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'date'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 1500000,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                        //line 3
                        sumbux=d.filter((num,index)=>index > 4 && index % 8 == 5);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 8 == 4);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Area Chart Example
                        var ctx = document.getElementById("myAreaChart3");
                        var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Pemasukan (Rp) ",
                            lineTension: 0.3,
                            backgroundColor: "rgba(2,117,216,0.2)",
                            borderColor: "rgba(2,117,216,1)",
                            pointRadius: 5,
                            pointBackgroundColor: "rgba(2,117,216,1)",
                            pointBorderColor: "rgba(255,255,255,0.8)",
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(2,117,216,1)",
                            pointHitRadius: 50,
                            pointBorderWidth: 2,
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'date'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 1750000,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                    }
                } 
                else if (lvl == "bendahara") {
                    blm_lunas=d[0].jml_pelangganb-d[2].jml_lunas;
                    $("#summary .bg-primary h1").text(d[0].jml_pelangganb);
                    $("#summary .bg-warning h1").text(Number(d[1].jml_uang).toLocaleString('id-ID'));
                    $("#summary .bg-success h1").text(d[2].jml_lunas);
                    $("#summary .bg-danger h1").text(blm_lunas);

                    //chartpie
                    data=d.filter((num,index)=>index > 2 && index < 5);
                    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#292b2c';

                    // Pie Chart Example
                    var ctx = document.getElementById("myPieChart");
                    var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ["Kos ", "RT "],
                        datasets: [{
                        data: data,
                        backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
                        }],
                    },
                    });
                    
                        //chartbar
                        // bar1
                        sumbux=d.filter((num,index)=>index > 4 && index % 8 == 5);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 8 == 6);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Bar Chart Example
                        var ctx = document.getElementById("myBarChart1");
                        var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Sudah tercatat ",
                            backgroundColor: "rgba(2,117,216,1)",
                            borderColor: "rgba(2,117,216,1)",
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'month'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 6
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 5,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                display: true
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                        // bar2
                        sumbux=d.filter((num,index)=>index > 4 && index % 8 == 5);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 8 == 7);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Bar Chart Example
                        var ctx = document.getElementById("myBarChart2");
                        var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Belum tercatat ",
                            backgroundColor: "rgba(2,117,216,1)",
                            borderColor: "rgba(2,117,216,1)",
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'month'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 6
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 5,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                display: true
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                        // bar3
                        sumbux=d.filter((num,index)=>index > 4 && index % 8 == 5);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 8 == 0);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Bar Chart Example
                        var ctx = document.getElementById("myBarChartc");
                        var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Sudah lunas ",
                            backgroundColor: "rgba(2,117,216,1)",
                            borderColor: "rgba(2,117,216,1)",
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'month'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 6
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 5,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                display: true
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                        // bar4
                        sumbux=d.filter((num,index)=>index > 4 && index % 8 == 5);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 8 == 1);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Bar Chart Example
                        var ctx = document.getElementById("myBarChartd");
                        var myLineChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Belum lunas ",
                            backgroundColor: "rgba(2,117,216,1)",
                            borderColor: "rgba(2,117,216,1)",
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'month'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 6
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 5,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                display: true
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                        //chartline
                        //line1
                        sumbux=d.filter((num,index)=>index > 4 && index % 8 == 5);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 8 == 2);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Area Chart Example
                        var ctx = document.getElementById("myAreaChart");
                        var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Pemakaian (m3) ",
                            lineTension: 0.3,
                            backgroundColor: "rgba(2,117,216,0.2)",
                            borderColor: "rgba(2,117,216,1)",
                            pointRadius: 5,
                            pointBackgroundColor: "rgba(2,117,216,1)",
                            pointBorderColor: "rgba(255,255,255,0.8)",
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(2,117,216,1)",
                            pointHitRadius: 50,
                            pointBorderWidth: 2,
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'date'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 150,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                        //line 2
                        sumbux=d.filter((num,index)=>index > 4 && index % 8 == 5);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 8 == 3);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Area Chart Example
                        var ctx = document.getElementById("myAreaChartb");
                        var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Tagihan (Rp) ",
                            lineTension: 0.3,
                            backgroundColor: "rgba(2,117,216,0.2)",
                            borderColor: "rgba(2,117,216,1)",
                            pointRadius: 5,
                            pointBackgroundColor: "rgba(2,117,216,1)",
                            pointBorderColor: "rgba(255,255,255,0.8)",
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(2,117,216,1)",
                            pointHitRadius: 50,
                            pointBorderWidth: 2,
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'date'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 1500000,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                        //line 3
                        sumbux=d.filter((num,index)=>index > 4 && index % 8 == 5);
                        sumbuy=d.filter((num,index)=>index > 4 && index % 8 == 4);
                        // console.log("respon: "+respon);
                        // Set new default font family and font color to mimic Bootstrap's default styling
                        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                        Chart.defaults.global.defaultFontColor = '#292b2c';

                        // Area Chart Example
                        var ctx = document.getElementById("myAreaChart3");
                        var myLineChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: sumbux,
                            datasets: [{
                            label: "Pemasukan (Rp) ",
                            lineTension: 0.3,
                            backgroundColor: "rgba(2,117,216,0.2)",
                            borderColor: "rgba(2,117,216,1)",
                            pointRadius: 5,
                            pointBackgroundColor: "rgba(2,117,216,1)",
                            pointBorderColor: "rgba(255,255,255,0.8)",
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(2,117,216,1)",
                            pointHitRadius: 50,
                            pointBorderWidth: 2,
                            data: sumbuy,
                            }],
                        },
                        options: {
                            scales: {
                            xAxes: [{
                                time: {
                                unit: 'date'
                                },
                                gridLines: {
                                display: false
                                },
                                ticks: {
                                maxTicksLimit: 7
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                min: 0,
                                max: 1750000,
                                maxTicksLimit: 5
                                },
                                gridLines: {
                                color: "rgba(0, 0, 0, .125)",
                                }
                            }],
                            },
                            legend: {
                            display: false
                            }
                        }
                        });
                }
                else {
                    //summary
                    $("#summary .bg-primary h2").text(d[3].tgl);
                    $("#summary .bg-primary #wkt").text(d[4].wkt);
                    $("#summary .bg-primary #tes").text("Waktu Pencatatan");
                    $("#summary .bg-warning h2").text(Number(d[0].air_warga).toLocaleString('id-ID'));
                    $("#summary .bg-success h2").text(Number(d[1].byr_warga).toLocaleString('id-ID'));
                    $("#summary .bg-danger h2").text(d[2].stts_warga);

                    //chartbar
                    sumbux=d.filter((num,index)=>index > 5 && index % 3 == 0);
                    sumbuy=d.filter((num,index)=>index > 5 && index % 3 == 1);
                    // console.log("respon: "+d);
                    // Set new default font family and font color to mimic Bootstrap's default styling
                    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#292b2c';

                    // Bar Chart Example
                    var ctx = document.getElementById("myBarChart");
                    var myLineChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: sumbux,
                        datasets: [{
                        label: "Pemakaian (m3) ",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: sumbuy,
                        }],
                    },
                    options: {
                        scales: {
                        xAxes: [{
                            time: {
                            unit: 'month'
                            },
                            gridLines: {
                            display: false
                            },
                            ticks: {
                            maxTicksLimit: 6
                            }
                        }],
                        yAxes: [{
                            ticks: {
                            min: 0,
                            max: 50,
                            maxTicksLimit: 5
                            },
                            gridLines: {
                            display: true
                            }
                        }],
                        },
                        legend: {
                        display: false
                        }
                    }
                    });

                    //chartline
                    sumbux=d.filter((num,index)=>index > 5 && index % 3 == 0);
                    sumbuy=d.filter((num,index)=>index > 5 && index % 3 == 2);
                    // console.log("respon: "+respon);
                    // Set new default font family and font color to mimic Bootstrap's default styling
                    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#292b2c';

                    // Area Chart Example
                    var ctx = document.getElementById("myAreaChart");
                    var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: sumbux,
                        datasets: [{
                        label: "Tagihan (Rp) ",
                        lineTension: 0.3,
                        backgroundColor: "rgba(2,117,216,0.2)",
                        borderColor: "rgba(2,117,216,1)",
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(2,117,216,1)",
                        pointBorderColor: "rgba(255,255,255,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(2,117,216,1)",
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        data: sumbuy,
                        }],
                    },
                    options: {
                        scales: {
                        xAxes: [{
                            time: {
                            unit: 'date'
                            },
                            gridLines: {
                            display: false
                            },
                            ticks: {
                            maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                            min: 0,
                            max: 500000,
                            maxTicksLimit: 5
                            },
                            gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                            }
                        }],
                        },
                        legend: {
                        display: false
                        }
                    }
                    });
                }
            })
            .fail(function(){
                console.log("rusakk");
            })
        })
        if (lvl == "warga") {
            // bulan0 = bulans.toString().padStart(2, '0');
            tahunbulan = `${tahuns}-${String(bulans).padStart(2, '0')}`
            // console.log("milih ", tahunbulan);
            $.ajax({
                type: "post",
                url: "../assets/ajax.php",
                data: {p:"summary",t:tahunbulan,u:user,l:lvl},
                dataType: "json"
            })
            .done(function(d){
                    $("#summary .bg-primary h2").text(d[5].tgl_lengkap);
                    $("#summary .bg-primary #tes").text("Pencatatan Terakhir: "+d[4].wkt);
                    $("#summary .bg-warning h2").text(Number(d[0].air_warga).toLocaleString('id-ID'));
                    $("#summary .bg-success h2").text(Number(d[1].byr_warga).toLocaleString('id-ID'));
                    $("#summary .bg-danger h2").text(d[2].stts_warga);

                    //chartbar
                    sumbux=d.filter((num,index)=>index > 5 && index % 3 == 0);
                    sumbuy=d.filter((num,index)=>index > 5 && index % 3 == 1);
                    // console.log("respon: "+d);
                    // Set new default font family and font color to mimic Bootstrap's default styling
                    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#292b2c';

                    // Bar Chart Example
                    var ctx = document.getElementById("myBarChart");
                    var myLineChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: sumbux,
                        datasets: [{
                        label: "Pemakaian (m3) ",
                        backgroundColor: "rgba(2,117,216,1)",
                        borderColor: "rgba(2,117,216,1)",
                        data: sumbuy,
                        }],
                    },
                    options: {
                        scales: {
                        xAxes: [{
                            time: {
                            unit: 'month'
                            },
                            gridLines: {
                            display: false
                            },
                            ticks: {
                            maxTicksLimit: 6
                            }
                        }],
                        yAxes: [{
                            ticks: {
                            min: 0,
                            max: 50,
                            maxTicksLimit: 5
                            },
                            gridLines: {
                            display: true
                            }
                        }],
                        },
                        legend: {
                        display: false
                        }
                    }
                    });

                    //chartline
                    sumbux=d.filter((num,index)=>index > 5 && index % 3 == 0);
                    sumbuy=d.filter((num,index)=>index > 5 && index % 3 == 2);
                    // console.log("respon: "+respon);
                    // Set new default font family and font color to mimic Bootstrap's default styling
                    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                    Chart.defaults.global.defaultFontColor = '#292b2c';

                    // Area Chart Example
                    var ctx = document.getElementById("myAreaChart");
                    var myLineChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: sumbux,
                        datasets: [{
                        label: "Tagihan (Rp) ",
                        lineTension: 0.3,
                        backgroundColor: "rgba(2,117,216,0.2)",
                        borderColor: "rgba(2,117,216,1)",
                        pointRadius: 5,
                        pointBackgroundColor: "rgba(2,117,216,1)",
                        pointBorderColor: "rgba(255,255,255,0.8)",
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "rgba(2,117,216,1)",
                        pointHitRadius: 50,
                        pointBorderWidth: 2,
                        data: sumbuy,
                        }],
                    },
                    options: {
                        scales: {
                        xAxes: [{
                            time: {
                            unit: 'date'
                            },
                            gridLines: {
                            display: false
                            },
                            ticks: {
                            maxTicksLimit: 7
                            }
                        }],
                        yAxes: [{
                            ticks: {
                            min: 0,
                            max: 500000,
                            maxTicksLimit: 5
                            },
                            gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                            }
                        }],
                        },
                        legend: {
                        display: false
                        }
                    }
                    });
            })
            .fail(function(){
                console.log("rusakk");
            })
        }
        else {
            $("#pilih_waktu select[name='pilih_waktu']").trigger("change");
        }
        
        $('#user_add, #user_list, #tarif_list, #tarif_add, #meter_add, #meter_list, #tagihan, #bayar, #pembayaran_warga, #pribadi_list').hide();
    } 

})