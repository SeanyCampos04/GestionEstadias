<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Oficio de Comisión</title>
    <style>
        @page {
            size: letter;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px; 
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            justify-content: space-between; 
            align-items: center;
            margin-bottom: 20px;
            padding: 0 20px; 
        }
        .header img {
            height: 100px;
            margin-top: -20px;
        }
        .header p{
            position: absolute;
            right: 0;
            top: 80px; /* Ajuste para que el texto se alinee debajo de la segunda imagen */
            font-size: 11px;
            text-align: right;
            color: #333;
        }
        .content {
            text-align: justify;
            font-size:13px;
            padding: 0 20px;
            margin-top: 50px;
        }
        table {
            width: 100%;
            font-size: 13px;
            margin-top: 20px;
        }
        td {
            padding: 5px;
        }
        p {
            font-size: 13px; 
        }
        .title {
            text-align: center;
            font-size: 14px;
            margin: 10px 0;
            font-weight: bold;
        }
        .attentive {
            font-size:14px;
            margin-top: 60px;
        }
        .attentive p {
            font-style: italic;
            margin-top: 0; 
            padding-top: 0; 
        }
        .attentive strong {
            margin-bottom: 0; 
        }
        .director {
            font-size:14px;
            margin-top: 60px; 
            padding-top: 60px; 
        }
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 13px;
            margin-top: 30px;
        }
        footer img {
            height: 75px;
            width: 80%;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="header w-full">
        <img src="{{ public_path('images/banner2.png') }}" alt="Logo 1" style="float: left;">
        <img src="{{ public_path('images/banner1.png') }}" alt="Logo 2" style="float: right;"><br>
        <p><strong>Instituto Tecnológico de Ciudad Valles</strong><br>Departamento de Sistemas y Computación</p>
    </div>
    <br><br><br><br>
    <div class="content py-9">
        <p class="title">COMISIÓN</p>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>FECHA:</strong></td>
                    <td>{{ $fecha }}</td>
                </tr>
                <tr>
                    <td><strong>SE CONFIERA COMISIÓN A:</strong></td>
                    <td>{{ $nombre }}</td>
                </tr>
                <tr>
                    <td><strong>LUGAR:</strong></td>
                    <td>{{ $lugar }}</td>
                </tr>
                <tr>
                    <td><strong>ASUNTO:</strong></td>
                    <td>{{ $asunto }}</td>
                </tr>
                <tr>
                    <td><strong>EL DÍA:</strong></td>
                    <td>{{ $dias }}</td>
                </tr>
                <tr>
                    <td><strong>VIÁTICOS PARA TRANSPORTE,<br> HOSPEDAJE Y ALIMENTACIÓN:</strong></td>
                    <td>{{ $viaticos }}</td>
                </tr>
            </tbody>
        </table>
        <div class="attentive mt-7 py-7">
            <strong>A T E N T A M E N T E</strong><br>
            <p>Excelencia en Educación Tecnológica</p>
        </div>

        <div class="director">
            <strong>MAP. HECTOR AGUILAR PONCE</strong><br>
            <strong>DIRECTOR</strong>
        </div>
    </div>
    <footer class="footer">
        <img src="{{ public_path('images/footer.png') }}" style="width:90%; height: 125px;" alt="">
    </footer>
</body>
</html>
