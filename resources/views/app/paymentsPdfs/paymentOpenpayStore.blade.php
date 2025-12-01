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
                    <div class="Logo_paynet">
                        <div>Servicio a pagar</div>
                        <img src="{{ base_path().'/public/graphics/OpenPay/store/paynet_logo.png' }}" alt="Logo Paynet">
                    </div>
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
                    <div align="center">
                        <h3>{{ $datosPago['dueDate'] }}</h3>
                        <img src="{{ $datosPago['barcode_url'] }}" alt="Logo Paynet" style="height: 60px">
                        <h3>{{ $datosPago['reference'] }}</h3>
                        <p>En caso de que el escáner no sea capaz de leer el código de barras, escribir la referencia tal como se muestra.</p>
                    </div>
                </td>
                <td colspan="6" class="text-white" style="background-color: #EF9517; padding: 15px">
                    <h3>Total a pagar</h3>
                    <h1><strong>$ {{ $datosPago['amount'] }} MXN</strong></h1>
                    <h3 align="right">+8 pesos por comisión</h3>
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
                <td colspan="6">
                    <h3 class="tittle"><strong>Como realizar el pago</strong></h3>
                    <p>1. Acude a cualquier tienda afiliada<br>
                        2. Entrega al cajero el código de barras y menciona que realizarás un pago de servicio Paynet<br>
                        3. Realizar el pago en efectivo por ${{ $datosPago['amount'] }} MXN (más $8 pesos por comisión)<br>
                        4. Conserva el ticket para cualquier aclaración<br>
                        Si tienes dudas comunícate a NOMBRE TIENDA al teléfono TELEFONO TIENDA o al correo CORREO SOPORTE TIENDA</p>
                </td>
                <td colspan="6">
                    <h3 class="tittle"><strong>Instrucciones para el cajero</strong></h3>
                    <p>1. Ingresar al menú de Pago de Servicios<br>
                        2. Seleccionar Paynet<br>
                        3. Escanear el código de barras o ingresar el núm. de referencia<br>
                        4. Ingresa la cantidad total a pagar<br>
                        5. Cobrar al cliente el monto total más la comisión de $8 pesos<br>
                        6. Confirmar la transacción y entregar el ticket al cliente<br>
                        Para cualquier duda sobre como cobrar, por favor llamar al teléfono +52 (55) 5351 7371 en un horario de 8am a 9pm de lunes a domingo</p>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border-top: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/store/01.png' }}" width="100" height="50">
                </td>
                <td colspan="2" style="border-top: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/store/02.png' }}" width="100" height="50">
                </td>
                <td colspan="2" style="border-top: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/store/03.png' }}" width="100" height="50">
                </td>
                <td colspan="2" style="border-top: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/store/04.png' }}" width="100" height="50">
                </td>
                <td colspan="4" rowspan="2" align="center" style="border-top: 1px solid #575757; border-bottom: 1px solid #575757">
                    ¿Quieres pagar en otras tiendas? visítanos en: www.openpay.mx/tiendas
                </td>
            </tr>
            <tr>
                <td colspan="2" style="border-bottom: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/store/05.png' }}" width="100" height="50">
                </td>
                <td colspan="2" style="border-bottom: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/store/06.png' }}" width="100" height="50">
                </td>
                <td colspan="2" style="border-bottom: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/store/07.png' }}" width="100" height="50">
                </td>
                <td colspan="2" style="border-bottom: 1px solid #575757" align="center">
                    <img src="{{ base_path().'/public/graphics/OpenPay/store/08.png' }}" width="100" height="50">
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