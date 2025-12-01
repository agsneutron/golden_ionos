<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        /*@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700");
        @import url("https://fonts.googleapis.com/css?family=Roboto:400,300,500,700");
        */
        @charset "UTF-8";
        /* CSS Document */


        .page-break {
            page-break-after: always;
        }

        @page {
            margin: 0cm 1cm;
        }

        #watermark {
            position: fixed;
            bottom:   -2.5cm;
            left:    -2.5cm;
            /** The width and height may change
                according to the dimensions of your letterhead
            **/
            width:    21.8cm;
            height:   28cm;

            /** Your watermark should be behind every content**/
            z-index:  -1000;


        }

        body {
            margin:0;
            margin-top: 0px;
            font-family:Helvetica, Arial, sans-serf;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 100;
        }
        h1 {
            font-size: 34px;
        }
        h2 {
            font-size: 26px;
        }
        h3 {
            font-size: 18px;
        }
        h4 {
            font-size: 16px;
        }
        h5 {
            font-size: 12px;
        }
        h6 {
            font-size: 10px;
        }
        h3,
        h4,
        h5 {
            font-weight: 400;
        }

        h1, h2, h3, h4, h5, h6 {
            margin-top: 2px;
            margin-bottom: 2px;
        }

        p {
            font-size: 8px;
            margin: 0;
        }

        /* COLORS */
        .text-navy {
            color: #1ab394;
        }
        .text-primary {
            color: inherit;
        }
        .text-success {
            color: #1c84c6;
        }
        .text-info {
            color: #23c6c8;
        }
        .text-warning {
            color: #EF9517;
        }
        .text-orange {
            color: #E68400;
        }
        .text-danger {
            color: #ed5565;
        }
        .text-muted {
            color: #888888;
        }
        .text-white {
            color: #ffffff;
        }

        .Logo_paynet {
            margin-top:3px;
        }
        .Logo_paynet div {
            font-size:20px;
            font-weight:lighter;
            display:block;
            margin:10px 12px 0 0;
        }
        .Logo_paynet img {
            width:130px;
        }

        .tittle{
            border-left: 35px solid #EF9517; padding-left: 15px;
        }

        .odd{
            background-color: #F3F3F3;
        }
        .even{
            background-color: #EBEBEB;
        }

        .row {
            width: 100%;
        }

        .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
            /*position: absolute;*/
            /*min-height: 1px;*/
            padding-right: 2px;
            padding-left: 2px;
            float: left;
        }
        .col-xs-12 {
            width: 100%;
        }
        .col-xs-11 {
            width: 91.66666667%;
        }
        .col-xs-10 {
            width: 83.33333333%;
        }
        .col-xs-9 {
            width: 75%;
        }
        .col-xs-8 {
            width: 66.66666667%;
        }
        .col-xs-7 {
            width: 58.33333333%;
        }
        .col-xs-6 {
            width: 50%;
        }
        .col-xs-5 {
            width: 41.66666667%;
        }
        .col-xs-4 {
            width: 33.33333333%;
        }
        .col-xs-3 {
            width: 25%;
        }
        .col-xs-2 {
            width: 16.66666667%;
        }
        .col-xs-1 {
            width: 8.33333333%;
        }

        .col-xs-offset-12 {
            margin-left: 100%;
        }
        .col-xs-offset-11 {
            margin-left: 91.66666667%;
        }
        .col-xs-offset-10 {
            margin-left: 83.33333333%;
        }
        .col-xs-offset-9 {
            margin-left: 75%;
        }
        .col-xs-offset-8 {
            margin-left: 66.66666667%;
        }
        .col-xs-offset-7 {
            margin-left: 58.33333333%;
        }
        .col-xs-offset-6 {
            margin-left: 50%;
        }
        .col-xs-offset-5 {
            margin-left: 41.66666667%;
        }
        .col-xs-offset-4 {
            margin-left: 33.33333333%;
        }
        .col-xs-offset-3 {
            margin-left: 25%;
        }
        .col-xs-offset-2 {
            margin-left: 16.66666667%;
        }
        .col-xs-offset-1 {
            margin-left: 8.33333333%;
        }
        .col-xs-offset-0 {
            margin-left: 0;
        }

    </style>
</head>
<body>
    <div class="row">
        <div class="col-xs-12">
            <table style="width: 100%; font-size: 12px">
                <tr>
                    <td style="width: 8.33333333%">&nbsp;</td>
                    <td style="width: 8.33333333%">&nbsp;</td>
                    <td style="width: 8.33333333%">&nbsp;</td>
                    <td style="width: 8.33333333%">&nbsp;</td>
                    <td style="width: 8.33333333%">&nbsp;</td>
                    <td style="width: 8.33333333%">&nbsp;</td>
                    <td style="width: 8.33333333%">&nbsp;</td>
                    <td style="width: 8.33333333%">&nbsp;</td>
                    <td style="width: 8.33333333%">&nbsp;</td>
                    <td style="width: 8.33333333%">&nbsp;</td>
                    <td style="width: 8.33333333%">&nbsp;</td>
                    <td style="width: 8.33333333%">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="7" align="center">
                        <h1>Corte de caja</h1>
                        <h4>{{ $branch == 0 ? 'GENERAL' : 'Sucursal: '.$branchOffice['Name'] }}</h4>
                        <h3>{{ $day }}</h3>
                    </td>
                    <td colspan="5" align="center">
                        <img src="{{ base_path().'/public/graphics/logo_md.png' }}" style="width: 4cm" />
                        <h5>RIV-BA Integradora de Servicios SA de CV</h5>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3>Efectivo</h3>
                    </td>
                    <td colspan="3" align="right">
                        <h3 class="text-info">$ {{ $totals['TotalCash'] }}</h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom: 2px solid #127CC0">
                        <h3>Tarjeta</h3>
                    </td>
                    <td colspan="3" align="right" style="border-bottom: 2px solid #127CC0">
                        <h3 class="text-info">$ {{ number_format($totals['TotalCard'],2,'.', ',') }}</h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3>Total ingresos</h3>
                    </td>
                    <td colspan="3" align="right">
                        <h3 class="text-info">$ {{ number_format($totals['TotalIncome'],2,'.', ',') }}</h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom: 2px solid #127CC0">
                        <h3>Egresos</h3>
                    </td>
                    <td colspan="3" align="right" style="border-bottom: 2px solid #127CC0">
                        <h3 class="text-danger">$ {{ number_format($totals['TotalExpense'],2,'.', ',') }}</h3>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h2>Total</h2>
                    </td>
                    <td colspan="3" align="right">
                        <h2 class="text-success">$ {{ number_format($totals['Total'],2,'.', ',') }}</h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="12" align="center" style="border-top: 2px solid #ccc">
                        <h3 class="text-success">EFECTIVO</h3>
                    </td>
                </tr>
                <tr>
                    <th style="border-bottom: 2px solid #ccc" >#</th>
                    <th style="border-bottom: 2px solid #ccc" colspan="2"><h4><strong>Fecha</strong></h4></th>
                    <th style="border-bottom: 2px solid #ccc" colspan="3"><h4><strong>Detalle</strong></h4></th>
                    <th style="border-bottom: 2px solid #ccc" colspan="3"><h4><strong>Usuario</strong></h4></th>
                    <th style="border-bottom: 2px solid #ccc" colspan="3"><h4><strong>Monto</strong></h4></th>
                </tr>
                <?php $n = 1; ?>
                @foreach($cashPayments as $payment)
                    <tr>
                        <td>{{ $n }}</td>
                        <td colspan="2">{{ $payment['CreatedAt'] }}</td>
                        <td colspan="3">Nota {{ $payment['SeriesBranch']."-".$payment['FolioOrder'] }}</td>
                        <td colspan="3">{{ $payment['NameUser'] }}</td>
                        <td colspan="3" align="right">{{ $payment['AmountPaid'] }}</td>
                        <?php $n++; ?>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="12" align="center" style="border-top: 2px solid #ccc">
                        <h3 class="text-success">TARJETA</h3>
                    </td>
                </tr>
                <tr>
                    <th style="border-bottom: 2px solid #ccc" ><h4><strong>#</strong></h4></th>
                    <th style="border-bottom: 2px solid #ccc" colspan="2"><h4><strong>Fecha</strong></h4></th>
                    <th style="border-bottom: 2px solid #ccc" colspan="3"><h4><strong>Detalle</strong></h4></th>
                    <th style="border-bottom: 2px solid #ccc" colspan="3"><h4><strong>Usuario</strong></h4></th>
                    <th style="border-bottom: 2px solid #ccc" colspan="3"><h4><strong>Monto</strong></h4></th>
                </tr>
                <?php $n = 1; ?>
                @foreach($cashPayments as $payment)
                    <tr>
                        <td>{{ $n }}</td>
                        <td colspan="2">{{ $payment['CreatedAt'] }}</td>
                        <td colspan="3">Nota {{ $payment['SeriesBranch']."-".$payment['FolioOrder'] }}</td>
                        <td colspan="3">{{ $payment['NameUser'] }}</td>
                        <td colspan="3" align="right">{{ $payment['AmountPaid'] }}</td>
                        <?php $n++; ?>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="12" align="center" style="border-top: 2px solid #ccc">
                        <h3 class="text-danger">GASTOS</h3>
                    </td>
                </tr>
                <tr>
                    <th style="border-bottom: 2px solid #ccc" ><h4><strong>#</strong></h4></th>
                    <th style="border-bottom: 2px solid #ccc" colspan="1"><h4><strong>Sucursal</strong></h4></th>
                    <th style="border-bottom: 2px solid #ccc" colspan="2"><h4><strong>Concepto</strong></h4></th>
                    <th style="border-bottom: 2px solid #ccc" colspan="2"><h4><strong>Usuario</strong></h4></th>
                    <th style="border-bottom: 2px solid #ccc" colspan="2"><h4><strong>Fecha</strong></h4></th>
                    <th style="border-bottom: 2px solid #ccc" colspan="2"><h4><strong>Monto</strong></h4></th>
                    <th style="border-bottom: 2px solid #ccc" colspan="2"><h4><strong>Descripción</strong></h4></th>
                </tr>
                <?php $n = 1; ?>
                @foreach($expenses as $expense)
                    <tr>
                        <td>{{ $n }}</td>
                        <td colspan="1">{{ $expense['NameBranch'] }}</td>
                        <td colspan="2">{{ $expense['DescriptionConcept'] }}</td>
                        <td colspan="2">{{ $expense['NameUser'] }}</td>
                        <td colspan="2">{{ $expense['DateExpense'] }}</td>
                        <td colspan="2" align="right">{{ number_format($expense['Amount'],2,'.',',')  }}</td>
                        <td colspan="2">{{ $expense['Description'] }}</td>
                        <?php $n++; ?>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

</body>
</html>
