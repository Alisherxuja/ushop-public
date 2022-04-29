<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <body onload="Paycom.Button('#form-payme', '#button-container')">
            <form id="form-payme" method="POST" action="https://checkout.paycom.uz/">
                <input type="hidden" name="merchant" value="587f72c72cac0d162c722ae2">
                <input type="hidden" name="account[order_id]" value="197">
                <input type="hidden" name="amount" value="500">
                <input type="hidden" name="lang" value="uz">
                <input type="hidden" name="button" data-type="svg" value="colored">
                <div id="button-container"></div>
            </form>
            <!-- ... -->
            <script src="https://cdn.paycom.uz/integration/js/checkout.min.js"></script>
            </body>
        </div>
    </body>
</html>
