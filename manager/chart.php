<script>
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php
            $sampai = date("Y-m-d"); // tanggal mulai
            $dari = date("Y-m-d", strtotime($_GET['pilih'] ?? '-7 day', strtotime($sampai))); // tanggal akhir
            
            while (strtotime($dari) <= strtotime($sampai)) {
                echo "'" . $dari . "',";
                $dari = date("Y-m-d", strtotime("+1 day", strtotime($dari))); //looping tambah 1 date
            } ?>],
            datasets: [{
                label: '# of Votes',
                data: [<?php
                $trsP = new lsp();
                $whereparam = "tanggal_beli";
                $sampai = date("Y-m-d"); // tanggal mulai
                $dari = date("Y-m-d", strtotime($_GET['pilih'] ?? '-7 day', strtotime($sampai))); // tanggal akhir
                
                while (strtotime($dari) <= strtotime($sampai)) {
                    $grandM = $trsP->selectSumWhereBetween("detailtransaksi", "sub_total", "$whereparam", $dari, $dari);

                    echo $grandM['sum'] . ",";
                    $dari = date("Y-m-d", strtotime("+1 day", strtotime($dari))); //looping tambah 1 date
                } ?>],
                backgroundColor: [<?php
                $trsP = new lsp();
                $whereparam = "tanggal_beli";
                $sampai = date("Y-m-d"); // tanggal mulai
                $dari = date("Y-m-d", strtotime($_GET['pilih'] ?? '-7 day', strtotime($sampai))); // tanggal akhir
                
                while (strtotime($dari) <= strtotime($sampai)) {
                    $grandM = $trsP->selectSumWhereBetween("detailtransaksi", "sub_total", "$whereparam", $dari, $dari);

                    echo "'rgba(" . rand(0, 255) . "," . rand(0, 255) . "," . rand(0, 255) . ")',";
                    $dari = date("Y-m-d", strtotime("+1 day", strtotime($dari))); //looping tambah 1 date
                } ?>
                ]
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem) {
                        return tooltipItem.yLabel;
                    }
                }
            }
        }
    });
</script>