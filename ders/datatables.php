<?php
session_start();
require __DIR__ . '/baglan.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ana sayfa</title>
    <link data-n-head="ssr" rel="icon" type="image/png" size="32" data-hid="favicon-32" href="./icons8-monkey-32.png">
    
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.1/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/datatables.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css"
    />

    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"
    ></script>
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"
    ></script>
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"
    ></script>
    <script
      type="text/javascript"
      src="https://cdn.datatables.net/v/bs5/jq-3.6.0/jszip-2.5.0/dt-1.13.1/af-2.5.1/b-2.3.3/b-colvis-2.3.3/b-html5-2.3.3/b-print-2.3.3/cr-1.6.1/datatables.min.js"
    ></script>
   



    <style>
        body {
            margin-left: 30px;
            margin-right: 30px;
        }
    </style>
</head>

<body>
<div class="container ">
        <header class="d-flex justify-content-center py-3">
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="#" class="m-1 nav-link active" aria-current="page">Ana Sayfa</a></li>
                <li class="nav-item"><a href="#" class="m-1 nav-link" aria-current="page">Giris</a></li>
                <li class="nav-item"><a href="/GIRISCIKIS/deneme.php" class="m-1 nav-link link-hover">veri ekle</a></li>
            </ul>
        </header>
    </div>


    <div class="d-flex">
    <table class="mb-2"  cellspacing="5" cellpadding="5">
        <tbody>
            <tr>
                <td>Minimum date:</td>
                <td><input class="form-control form-control-sm" type="text" id="min" name="min"></td>
            </tr>
            <tr>
                <td>Maximum date:</td>
                <td><input class="form-control form-control-sm" type="text" id="max" name="max"></td>
            </tr>
        </tbody>
    </table>
    </div>
    <div class="margin-3">
    <table id="example" class="display nowrap">
        <thead>
            <tr>
                <th>ad soyad</th>
                <th>firma</th>
                <th>cihaz</th>
                <th>tarih</th>
                <th>saat</th>
                <th>giris cıkış</th>
            </tr>
        </thead>

    </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        var minDate, maxDate;

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date(data[3]);

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );

        $(document).ready(function() {
            // Create date inputs
            minDate = new DateTime($('#min'), {
                format: 'YYYY-MM-DD'
            });
            maxDate = new DateTime($('#max'), {
                format: 'YYYY-MM-DD'
            });



            var table = $('#example').DataTable(
                {
                

                "language": {

                    "sDecimal": ",",
                    "sEmptyTable": "Tabloda herhangi bir veri mevcut değil",
                    "sInfo": "_TOTAL_ kayıttan _START_ - _END_ arasındaki kayıtlar gösteriliyor",
                    "sInfoEmpty": "Kayıt yok",
                    "sInfoFiltered": "(_MAX_ kayıt içerisinden bulunan)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "Sayfada _MENU_ kayıt göster",
                    "sLoadingRecords": "Yükleniyor...",
                    "sProcessing": "",
                    "sSearch": "Ara:",
                    "sZeroRecords": "Eşleşen kayıt bulunamadı",
                    "oPaginate": {
                        "sFirst": "İlk",
                        "sLast": "Son",
                        "sNext": "Sonraki",
                        "sPrevious": "Önceki"
                    },
                    "oAria": {
                        "sSortAscending": ": artan sütun sıralamasını aktifleştir",
                        "sSortDescending": ": azalan sütun soralamasını aktifleştir"

                    }
                },
                processing: true,
                severSide: true,
                ajax: {
                    url: 'api.php',
                    type: 'POST'
                },
                columns: [{
                        data: 'ad_Soyad'
                    },
                    {
                        data: 'firma'
                    },
                    {
                        data: 'firma_g_c'
                    },
                    {
                        data: 'tarih'
                    },
                    {
                        data: 'saat'
                    },
                    {
                        data: 'giris_cikis'
                    },
                ]


            }
            );

 
            // Refilter the table
            $("#min, #max").on("change", function() {
                table.draw();
                
            });
        });
       
    </script>
 
</body>

</html>