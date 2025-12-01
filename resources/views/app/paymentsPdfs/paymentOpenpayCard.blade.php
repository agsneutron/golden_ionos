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
            margin: 0cm 0cm;
        }

        #watermark {
            position: fixed;
            bottom:   0px;
            left:     0px;
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
            margin-top: 5px;
        }

        p {
            font-size: 10px;
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
    </style>
</head>
    <body>
    <div id="watermark">
        <img src="{{ base_path().'/public/graphics/pdf/back150.png' }}" height="100%" width="100%" />
    </div>
        <table style="width: 100%; font-size: 12px; margin-top: 2.5cm; padding-left: 1cm; padding-right: 1cm">
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
                <td colspan="6" align="center" style="border-bottom: 2px solid #EF9517">

                </td>
                <td colspan="6" align="center" style="border-bottom: 2px solid #EF9517">
                    <h3>Cargo a tarjeta bancaria</h3>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <h3 class="text-warning">
                        {{ $plan['Nomentdep']." - ".$plan['Nomcatdep']." - ".$plan['Dscdis'] }}
                    </h3>
                    <p><strong>Detalle del plan: </strong>{{ $plan['Dscpln'] }}</p>
                </td>
                <td colspan="6" align="center">
                    <p><strong>Fecha de registro: </strong><span>{{ $plan['Fecreg'] }}</span></p>
                    <p><strong>Fecha de inicio: </strong><span>{{ $plan['Fecinicent'] }}</span></p>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <h3 class="tittle"><strong>Beneficiario</strong></h3>
                    <h3>Elite Sports</h3>
                </td>
                <td colspan="6" class="text-white" style="background-color: #EF9517; padding: 15px">
                    <h3>Cargo realizado</h3>
                    <h1><strong>$ {{ $datosPago['amount'] }} MXN</strong></h1>
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <h3 class="tittle"><strong>Detalle de la compra</strong></h3>
                    <table style="width: 100%; font-size: 12px">
                        <tr class="odd">
                            <td>Descripción</td>
                            <td>Plan de entrenamiento</td>
                        </tr>
                        <tr class="even">
                            <td>Fecha de la compra</td>
                            <td>{{ $datosPago['buyDate'] }}</td>
                        </tr>
                        <tr class="even">
                            <td>Fecha de la confirmación de pago</td>
                            <td>{{ $datosPago['confirmed'] }}</td>
                        </tr>
                        <tr class="odd">
                            <td>Nombre</td>
                            <td>{{ $user['Name'] }}</td>
                        </tr>
                        <tr class="even">
                            <td>Correo</td>
                            <td>{{ $user['Email'] }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <h3 class="tittle"><strong>Tarjetas de credito</strong></h3>
                    <table style="background-color: #EBEBEB;">
                        <tr>
                            <td align="center">
                                <img src="{{ base_path().'/public/graphics/OpenPay/card/07.jpg' }}" width="100" height="50">
                            </td>
                            <td  align="center">
                                <img src="{{ base_path().'/public/graphics/OpenPay/card/08.jpg' }}" width="100" height="50">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <img src="{{ base_path().'/public/graphics/OpenPay/card/09.jpg' }}" width="100" height="50">
                            </td>
                            <td  align="center">
                                <img src="{{ base_path().'/public/graphics/OpenPay/card/10.jpg' }}" width="100" height="50">
                            </td>
                        </tr>
                    </table>
                </td>
                <td colspan="8">
                    <h3 class="tittle"><strong>Tarjetas de debito</strong></h3>
                    <table style="background-color: #F3F3F3">
                        <tr>
                            <td align="center">
                                <img src="{{ base_path().'/public/graphics/OpenPay/card/01_d.jpg' }}" width="100" height="50">
                            </td>
                            <td  align="center">
                                <img src="{{ base_path().'/public/graphics/OpenPay/card/02_d.jpg' }}" width="100" height="50">
                            </td>
                            <td  align="center">
                                <img src="{{ base_path().'/public/graphics/OpenPay/card/03_d.jpg' }}" width="100" height="50">
                            </td>
                            <td  align="center">
                                <img src="{{ base_path().'/public/graphics/OpenPay/card/12_d.jpg' }}" width="100" height="50">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <img src="{{ base_path().'/public/graphics/OpenPay/card/05_d.jpg' }}" width="100" height="50">
                            </td>
                            <td  align="center">
                                <img src="{{ base_path().'/public/graphics/OpenPay/card/06_d.jpg' }}" width="100" height="50">
                            </td>
                            <td  align="center">
                                <img src="{{ base_path().'/public/graphics/OpenPay/card/11_d.jpg' }}" width="100" height="50">
                            </td>
                            <td  align="center">
                                <img src="{{ base_path().'/public/graphics/OpenPay/card/04_d.jpg' }}" width="100" height="50">
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <img src="{{ base_path().'/public/graphics/OpenPay/store/powered_openpay.png' }}" alt="Powered by Openpay" width="150">
                </td>
            </tr>
        </table>
    </body>
</html>