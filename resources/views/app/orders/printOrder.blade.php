<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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
            margin: 0cm 0cm;
            /*size: 17cm 21.6cm landscape;*/
        }

        #watermark {
            position: fixed;
            bottom:   -2.5cm;
            left:    -2.5cm;
            /** The width and height may change
                according to the dimensions of your letterhead
            **/
            /*
            width:    21.8cm;
            height:   28cm;
            */

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
            font-size: 16px;
        }
        h2 {
            font-size: 14px;
        }
        h3 {
            font-size: 12px;
        }
        h4 {
            font-size: 10px;
        }
        h5 {
            font-size: 8px;
        }
        h6 {
            font-size: 6px;
        }
        h3,
        h4,
        h5 {
            font-weight: 200;
        }

        h1, h2, h3, h4, h5, h6 {
            margin-top: 2px;
            margin-bottom: 2px;
        }

        p {
            font-size: 7px;
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

        img { display: block }

        img {
        -webkit-filter: grayscale(1);
        filter: grayscale(1);
        }

    </style>
</head>
<body>
    <?php 
    $kilogramos = 0;
    $piezas = 0;    
    ?>
    <table style="width: 712px; padding:0px" >
        <tr style="padding:0px; margin: 0px">
            <td style="padding:0px; margin: 0px">
                <table style="font-size: 9px; margin-left:2px; margin-right:4px; width: 348px;">
                    <tr>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="7" align="right">
    
                        </td>
                        <td colspan="5" align="center">
                            <img src="{{ base_path().'/public/graphics/logo_md.jpg' }}" id="logo" alt="logo" style="width: 2cm" />
                            <p>RIV-BA Integradora de Servicios SA de CV</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <p><strong>R.F.C:</strong> RIS131217LY&</p>
                        </td>
                        <td colspan="4">
                            <p><strong>CURP:</strong></p>
                        </td>
                        <td colspan="4">
                            <p><strong>SIEM:</strong>ABC6461F</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <p><strong>Dir: </strong>{{ $order['BranchAddress'] }}</p>
                        </td>
                        <td colspan="6">
                            <p><strong>Tel: </strong>{{ $order['BranchPhone'] }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <p><strong>Reg. CANALAVA: </strong>90-84</p>
                        </td>
                        <td colspan="6">
                            <p>MORAL</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12" align="center">
                            <p><strong>Nuestra especialidad...¡SERVIRLE!</strong></p>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="12" style="border-bottom: 1px solid #000000">
                            @if($order['IdBranchOffice'] == 3)
                            <p><strong>Horario de atención: </strong>Lun a Vie de 8:00 a 20:00, Sab de 9:00 a 15:00, Dom de 10:00 a 14:00</p>
                            @else
                            <p><strong>Horario de atención: </strong>Lun a Vie de 9:00 a 19:00, Sab de 9:00 a 15:00</p>
                            @endif
                        </td>
                    </tr>
                    <tr >
                        <td colspan="6" style="border-bottom: 1px solid #000000" align="center">
                            <!-- <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($order['Id'], 'C39') }}" style="height: 30px; width: 160px" alt="barcode"/> -->
                            {!! DNS1D::getBarcodeHTML($order['Id'], 'C39', 1.5, 30) !!}
                        </td>
                        <td colspan="3" style="border-bottom: 1px solid #000000">
                            <p><strong>Nota de venta no.</strong></p>
                        </td>
                        <td colspan="3" style="border-bottom: 1px solid #000000">
                            <h2>{{ $order['BranchSeries']." ".$order['Folio'] }}</h2>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="6" style="border-bottom: 1px solid #000000">
                            <p>{{ strtoupper($order['ClientName']) }}</p>
                        </td>
                        <td colspan="6" style="border-bottom: 1px solid #000000">
                            <p><strong>{{ $order['ClientPhone'] }}</strong></p>
                            <p><strong>{{ $order['ClientAddress'] }}</strong></p>
                            @if($order['ClientSuburb'] != "")
                                <p><strong>Fraccionamiento: {{ $order['ClientSuburb'] }}</strong></p>
                            @endif
                        </td>
                    </tr>
                    <tr >
                        <td colspan="12" style="border-bottom: 1px solid #000000">
                            <p><strong>Recepción: </strong> {{ $order['ReceptionDate']." ".$order['ReceptionTime'] }}</p>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="1" style="border-bottom: 2px solid #000000">
                            <p><strong>Cant</strong></p>
                        </td>
                        <td colspan="3" style="border-bottom: 2px solid #000000">
                            <p><strong>Descripción</strong></p>
                        </td>
                        <td colspan="1" style="border-bottom: 2px solid #000000">
                            <p><strong>Color</strong></p>
                        </td>
                        <td colspan="2" style="border-bottom: 2px solid #000000">
                            <p><strong>Defecto</strong></p>
                        </td>
                        <td colspan="1" style="border-bottom: 2px solid #000000">
                            <p><strong>Estamp.</strong></p>
                        </td>
                        <td colspan="2" style="border-bottom: 2px solid #000000">
                            <p><strong>Proceso</strong></p>
                        </td>
                        <td colspan="1" style="border-bottom: 2px solid #000000">
                            <p><strong>P.U.</strong></p>
                        </td>
                        <td colspan="1" style="border-bottom: 2px solid #000000">
                            <p><strong>Importe</strong></p>
                        </td>
                    </tr>
                    @foreach($details as $detail)
                    <?php
                        if($detail['IdService']== 1 || $detail['IdService']==5 || $detail['IdService']==628){
                            $kilogramos += $detail['Quantity'];
                        }elseif ($detail['IdService']== 10) {
                            $kilogramos += 3;
                        }elseif (in_array($detail['IdService'] , $docenas, true)){
                            $piezas += 12;
                        }elseif(in_array($detail['IdService'] , $mediasDocenas, true)){
                            $piezas += 6;
                        }else{
                            $piezas +=  $detail['Quantity'];
                        }
                    ?>
                        <tr >
                            <td colspan="1" >
                                <p>{{ $detail['Quantity'] }}</p>
                            </td>
                            <td colspan="3" >
                                <p>{{ $detail['DescriptionService'] }}</p>
                            </td>
                            <td colspan="1" >
                                <p>{{ $detail['DescriptionColor'] }}</p>
                            </td>
                            <td colspan="2" >
                                <p>{{ $detail['DescriptionDefect'] }}</p>
                            </td>
                            <td colspan="1" >
                                <p>{{ $detail['DescriptionPrint'] }}</p>
                            </td>
                            <td colspan="2" >
                                <p>{{ $detail['DescriptionCategory'] }}</p>
                            </td>
                            <td colspan="1" >
                                <p>{{ number_format($detail['Total']/$detail['Quantity'],2,'.', ',') }}</p>
                            </td>
                            <td colspan="1" >
                                <p>{{ $detail['Total'] }}</p>
                            </td>
                        </tr>
                    @endforeach
                    <tr >
                        <td colspan="12" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000">
                            <p><strong>Observaciones: </strong>
                                @foreach($details as $detail)
                                    {{ $detail['Observations']." | " }}
                                @endforeach
                            </p>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="3" style="border-bottom: 1px solid #000000">
                            <p><strong>Kilos: </strong>{{ $kilogramos }}</p>
                        </td>
                        <td colspan="3" style="border-bottom: 1px solid #000000">
                            <p><strong>Piezas: </strong>{{ $piezas }}</p>
                        </td>
                        <td colspan="6" style="border-bottom: 1px solid #000000"></td>
                    </tr>
                    <tr >
                        <td colspan="6" style="border-bottom: 1px solid #000000">
                            <p><strong>Entrega: </strong> {{ $calendar['Name']." ".$order['DeliveryTime'] }}</p>
                        </td>
                        <td colspan="6" style="border-bottom: 1px solid #000000">
                            @if(!is_null($order['HomeDelivery']))
                                <p><strong>Entrega a domicilio: </strong> {{ $calendar2['Name'] }}</p>
                            @endif
                        </td>
                    </tr>
                    <tr >
                        <td colspan="6" >
                            <p><strong>Atendido por: </strong>{{ $order['NameEmployee'] }}</p>
                        </td>
                        <td colspan="3" style="border-left: 1px solid #000000">
                            <p><strong>Subtotal: </strong></p><br>
                            <p><strong>Descuento: </strong></p><br>
                            <p><strong>Total: </strong></p>
                        </td>
                        <td colspan="3" align="right" >
                            <p>{{ $order['Subtotal'] }}</p><br>
                            <p>{{ $order['Discount'] }}</p><br>
                            <p>{{ $order['Total'] }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" >
                            <p><strong>A cuenta: </strong>${{ $order['AmountPaid'] }}</p>
                        </td>
                        <td colspan="3" >
                            <p><strong>Resta: </strong>${{ $order['Total']-$order['AmountPaid'] }}</p>
                        </td>
                    </tr>
                    @if( ($order['Total']-$order['AmountPaid']) == 0 )
                    <tr>
                        <td colspan="6" align="center">
                            <p>PAGADO</p>
                        </td>
                        <td colspan="6" align="center">                        
                        </td>
                    </tr>
                    @endif
                    <tr >
                        <td colspan="12" align="center">
                            <p style="font-size: 6px;">
                                NO NOS HACEMOS RESPONSABLES POR OBJETOS O VALORES OLVIDADOS EN LA PRENDA<br>
                                LAS CONDICIONES A LAS QUE SE SUJETAN LAS PARTES SE ENCUENTRAN AL REVERSO<br>
                            </p>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="12" align="center">
                            <p>
                                <br>
                                <br>
                                FIRMA O RUBRICA DE AUTORIZACIÓN
                            </p>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="6">
                            <p><strong>CLIENTE</strong></p>
                        </td>
                        <td colspan="6" align="right">
                            <p><strong>{{ $textFooter }}</strong></p>
                        </td>
                    </tr>
                </table>
            </td>
            <td style="padding:0px; margin: 0px">
                <table style="font-size: 9px; margin-left:4px; margin-right:4px; width: 348px;">
                    <tr>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                        <td style="width: 29px">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="7" align="right">
    
                        </td>
                        <td colspan="5" align="center">
                            <img src="{{ base_path().'/public/graphics/logo_md.jpg' }}" id="logo" alt="logo" style="width: 2cm" />>
                            <p>RIV-BA Integradora de Servicios SA de CV</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <p><strong>R.F.C:</strong> RIS131217LY&</p>
                        </td>
                        <td colspan="4">
                            <p><strong>CURP:</strong></p>
                        </td>
                        <td colspan="4">
                            <p><strong>SIEM:</strong>ABC6461F</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <p><strong>Dir: </strong>{{ $order['BranchAddress'] }}</p>
                        </td>
                        <td colspan="6">
                            <p><strong>Tel: </strong>{{ $order['BranchPhone'] }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <p><strong>Reg. CANALAVA: </strong>90-84</p>
                        </td>
                        <td colspan="6">
                            <p>MORAL</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="12" align="center">
                            <p><strong>Nuestra especialidad...¡SERVIRLE!</strong></p>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="12" style="border-bottom: 1px solid #000000">
                            @if($order['IdBranchOffice'] == 3)
                            <p><strong>Horario de atención: </strong>Lun a Vie de 8:00 a 20:00, Sab de 9:00 a 15:00, Dom de 10:00 a 14:00</p>
                            @else
                            <p><strong>Horario de atención: </strong>Lun a Vie de 9:00 a 19:00, Sab de 9:00 a 15:00</p>
                            @endif
                        </td>
                    </tr>
                    <tr >
                        <td colspan="6" style="border-bottom: 1px solid #000000" align="center">
                            <!-- <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($order['Id'], "C39") }}" style="height: 30px; width: 160px" alt="barcode"/> -->
                            {!! DNS1D::getBarcodeHTML($order['Id'], 'C39', 1.5, 30) !!}
                        </td>
                        <td colspan="3" style="border-bottom: 1px solid #000000">
                            <p><strong>Nota de venta no.</strong></p>
                        </td>
                        <td colspan="3" style="border-bottom: 1px solid #000000">
                            <h2>{{ $order['BranchSeries']." ".$order['Folio'] }}</h2>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="6" style="border-bottom: 1px solid #000000">
                            <p>{{ strtoupper($order['ClientName']) }}</p>
                        </td>
                        <td colspan="6" style="border-bottom: 1px solid #000000">
                            <p><strong>{{ $order['ClientPhone'] }}</strong></p>
                            <p><strong>{{ $order['ClientAddress'] }}</strong></p>
                            @if($order['ClientSuburb'] != "")
                                <p><strong>Fraccionamiento: {{ $order['ClientSuburb'] }}</strong></p>
                            @endif
                        </td>
                    </tr>
                    <tr >
                        <td colspan="12" style="border-bottom: 1px solid #000000">
                            <p><strong>Recepción: </strong> {{ $order['ReceptionDate']." ".$order['ReceptionTime'] }}</p>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="1" style="border-bottom: 2px solid #000000">
                            <p><strong>Cant</strong></p>
                        </td>
                        <td colspan="3" style="border-bottom: 2px solid #000000">
                            <p><strong>Descripción</strong></p>
                        </td>
                        <td colspan="1" style="border-bottom: 2px solid #000000">
                            <p><strong>Color</strong></p>
                        </td>
                        <td colspan="2" style="border-bottom: 2px solid #000000">
                            <p><strong>Defecto</strong></p>
                        </td>
                        <td colspan="1" style="border-bottom: 2px solid #000000">
                            <p><strong>Estamp.</strong></p>
                        </td>
                        <td colspan="2" style="border-bottom: 2px solid #000000">
                            <p><strong>Proceso</strong></p>
                        </td>
                        <td colspan="1" style="border-bottom: 2px solid #000000">
                            <p><strong>P.U.</strong></p>
                        </td>
                        <td colspan="1" style="border-bottom: 2px solid #000000">
                            <p><strong>Importe</strong></p>
                        </td>
                    </tr>
                    <?php
                        $kilogramos = 0;
                        $piezas = 0;
                    ?>
                    @foreach($details as $detail)
                    <?php
                        if($detail['IdService']== 1 || $detail['IdService']==5 || $detail['IdService']==628){
                            $kilogramos += $detail['Quantity'];
                        }elseif ($detail['IdService']== 10) {
                            $kilogramos += 3;
                        }elseif (in_array($detail['IdService'] , $docenas, true)){
                            $piezas += 12;
                        }elseif(in_array($detail['IdService'] , $mediasDocenas, true)){
                            $piezas += 6;
                        }else{
                            $piezas +=  $detail['Quantity'];
                        }
                    ?>
                        <tr >
                            <td colspan="1" >
                                <p>{{ $detail['Quantity'] }}</p>
                            </td>
                            <td colspan="3" >
                                <p>{{ $detail['DescriptionService'] }}</p>
                            </td>
                            <td colspan="1" >
                                <p>{{ $detail['DescriptionColor'] }}</p>
                            </td>
                            <td colspan="2" >
                                <p>{{ $detail['DescriptionDefect'] }}</p>
                            </td>
                            <td colspan="1" >
                                <p>{{ $detail['DescriptionPrint'] }}</p>
                            </td>
                            <td colspan="2" >
                                <p>{{ $detail['DescriptionCategory'] }}</p>
                            </td>
                            <td colspan="1" >
                                <p>{{ number_format($detail['Total']/$detail['Quantity'],2,'.', ',') }}</p>
                            </td>
                            <td colspan="1" >
                                <p>{{ $detail['Total'] }}</p>
                            </td>
                        </tr>
                    @endforeach
                    <tr >
                        <td colspan="12" style="border-bottom: 1px solid #000000; border-top: 1px solid #000000">
                            <p><strong>Observaciones: </strong>
                                @foreach($details as $detail)
                                    {{ $detail['Observations']." | " }}
                                @endforeach
                            </p>
                        </td>
                    </tr>
                    <tr >
                        <td colspan="3" style="border-bottom: 1px solid #000000">
                        <p><strong>Kilos: </strong>{{ $kilogramos }}</p>
                        </td>
                        <td colspan="3" style="border-bottom: 1px solid #000000">
                            <p><strong>Piezas: </strong>{{ $piezas }}</p>
                        </td>
                        <td colspan="6" style="border-bottom: 1px solid #000000"></td>
                    </tr>
                    <tr >
                        <td colspan="6" style="border-bottom: 1px solid #000000">
                            <p><strong>Entrega: </strong> {{ $calendar['Name']." ".$order['DeliveryTime'] }}</p>
                        </td>
                        <td colspan="6" style="border-bottom: 1px solid #000000">
                            @if(!is_null($order['HomeDelivery']))
                                <p><strong>Entrega a domicilio: </strong> {{ $calendar2['Name'] }}</p>
                            @endif
                        </td>
                    </tr>
                    <tr >
                        <td colspan="6" >
                            <p><strong>Atendido por: </strong>{{ $order['NameEmployee'] }}</p>
                        </td>
                        <td colspan="3" style="border-left: 1px solid #000000">
                            <p><strong>Subtotal: </strong></p><br>
                            <p><strong>Descuento: </strong></p><br>
                            <p><strong>Total: </strong></p>
                        </td>
                        <td colspan="3" align="right" >
                            <p>{{ $order['Subtotal'] }}</p><br>
                            <p>{{ $order['Discount'] }}</p><br>
                            <p>{{ $order['Total'] }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" >
                            <p><strong>A cuenta: </strong>${{ $order['AmountPaid'] }}</p>
                        </td>
                        <td colspan="3" >
                            <p><strong>Resta: </strong>${{ $order['Total']-$order['AmountPaid'] }}</p>
                        </td>
                    </tr>
                    @if( ($order['Total']-$order['AmountPaid']) == 0 )
                    <tr>
                        <td colspan="6" align="center">
                            <p>PAGADO</p>
                        </td>
                    </tr>
                    @endif
                    <tr >
                        <td colspan="12" align="center">
                            <p style="font-size: 6px;">
                                NO NOS HACEMOS RESPONSABLES POR OBJETOS O VALORES OLVIDADOS EN LA PRENDA<br>
                                LAS CONDICIONES A LAS QUE SE SUJETAN LAS PARTES SE ENCUENTRAN AL REVERSO<br>
                            </p>
                        </td>
                    </tr>
                    <tr >
                            <td colspan="12" align="center">
                                <p>
                                    <br>
                                    <br>
                                    FIRMA O RUBRICA DE AUTORIZACIÓN
                                </p>
                            </td>
                        </tr>
                    <tr >
                        <td colspan="6">
                            <p><strong>SUCURSAL</strong></p>
                        </td>
                        <td colspan="6" align="right">
                            <p><strong>{{ $textFooter }}</strong></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
