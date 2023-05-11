<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Docker Container Status</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <h1>Monitoreo y cambio estados container docker</h1>
        </div>
        <div class="body-table">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Nombre</th>
                        <th colspan="2">Network</th>
                        <th colspan="2">Running</th>
                        <th colspan="2">Status</th>
                        <th colspan="2">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">prueba</td>
                        <td colspan="2">prueba</td>
                        <td colspan="2">prueba</td>
                        <td colspan="2">prueba</td>
                        <td colspan="2">orubea</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <span>Footer lucas 2023</span>
        </div>
    </body>
</html>
