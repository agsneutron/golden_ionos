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
        <img src="{{ base_path().'/public/graphics/pdf/membrete150.png' }}" height="100%" width="100%" />
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
                    <h3>Transferencia interbancaria (SPEI)</h3>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <h2 class="text-warning">
                        Orden {{ $order['Serie']."-".$order['Folio'] }}
                    </h2>
                </td>
                <td colspan="6" align="center">
                    <p><strong>Recepción: </strong><br><span>{{ $order['ReceptionDate']."  ".$order['ReceptionTime'] }}</span></p>
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <h3 class="tittle"><strong>Fecha límite de pago</strong></h3>
                    <h3>{{ $datosPago['dueDate'] }}</h3>
                    <h3 class="tittle"><strong>Beneficiario</strong></h3>
                    <h3>Golden - Tintorería y Lavandería</h3>
                </td>
                <td colspan="6" class="text-white" style="background-color: #EF9517; padding: 15px">
                    <h3>Total a pagar</h3>
                    <h1><strong>$ {{ $datosPago['amount'] }} MXN</strong></h1>
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <h3 class="tittle"><strong>Detalle de la compra</strong></h3>
                    <table style="width: 100%; font-size: 12px">
                        <tr class="odd">
                            <td>Descripción</td>
                            <td>Orden {{ $order['Serie']."-".$order['Folio'] }}</td>
                        </tr>
                        <tr class="even">
                            <td>Fecha</td>
                            <td>{{ $datosPago['buyDate'] }}</td>
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
                <td colspan="12">
                    <h3 class="tittle"><strong>Pasos para realizar el pago</strong></h3>
                    <table>
                        <tr>
                            <td style="background-color: #EBEBEB; padding: 10px; width: 50%">
                                <h4><strong>Desde BBVA Bancomer</strong></h4>
                                <p>1. Dentro del menú de "pagar seleccione la opción "De servicios"
                                    e ingrese el siguiente "Número de convenio CIE"
                                </p>
                                <p><strong>Número de convenio CIE: </strong>{{ $datosPago['agreement'] }}</p>
                                <p>2. Ingrese los datos de registro para concluir con la operación</p>
                                <table>
                                    <tr>
                                        <td><strong>Referencia:</strong></td>
                                        <td style="padding-left: 10px">{{ $datosPago['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Importe:</strong></td>
                                        <td style="padding-left: 10px">$ {{ $datosPago['amount'] }} MXN</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Concepto:</strong></td>
                                        <td style="padding-left: 10px">
                                            Orden {{ $order['Serie']."-".$order['Folio'] }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="background-color: #F3F3F3;padding: 10px; width: 50%">
                                <h4><strong>Desde cualquier otro banco</strong></h4>
                                <p>1. Ingresar a la sección de transferencias y pagos o pagos a otros bancos
                                    y proporciona los datos de la transferencia:
                                </p>
                                <table>
                                    <tr>
                                        <td><strong>Beneficiario:</strong></td>
                                        <td style="padding-left: 10px">Golden - Tintorería y Lavandería</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Banco destino:</strong></td>
                                        <td style="padding-left: 10px">BBVA Bancomer</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Clabe:</strong></td>
                                        <td style="padding-left: 10px">{{ $datosPago['clabe'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Concepto de pago:</strong></td>
                                        <td style="padding-left: 10px">{{ $datosPago['name'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Referencia:</strong></td>
                                        <td style="padding-left: 10px">{{ $datosPago['agreement'] }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Importe:</strong></td>
                                        <td style="padding-left: 10px">$ {{ $datosPago['amount'] }} MXN</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border-top: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/spei/banamex.jpg' }}" width="100" height="50">
                </td>
                <td colspan="2" style="border-top: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/spei/banorte.jpg' }}" width="100" height="50">
                </td>
                <td colspan="2" style="border-top: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/spei/bancomer.jpg' }}" width="100" height="50">
                </td>
                <td colspan="2" style="border-top: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/spei/santander.jpg' }}" width="100" height="50">
                </td>
                <td colspan="4" rowspan="2" align="center" style="border-top: 1px solid #575757; border-bottom: 1px solid #575757">
                    ¿Quieres pagar en otros bancos? visítanos en: www.openpay.mx/bancos.html
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border-bottom: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/spei/hsbc.jpg' }}" width="100" height="50">
                </td>
                <td colspan="2" style="border-bottom: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/spei/inbursa.jpg' }}" width="100" height="50">
                </td>
                <td colspan="2" style="border-bottom: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/spei/ixe.jpg' }}" width="100" height="50">
                </td>
                <td colspan="2" style="border-bottom: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/spei/scotiabank.jpg' }}" width="100" height="50">
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