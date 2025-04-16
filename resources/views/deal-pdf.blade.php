<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link rel="stylesheet" href="{{ secure_asset('/css/bootstrap.min.css') }}">
    <style>
        .logo {
            width: 200px;
            height: 200px;
        }
        .header {
            display: flex;
            justify-content: end;
            align-items: center;
            height: 200px;
        }
    </style>
</head>
<body>
<div class="container">
    <table style="width: 100%; border-collapse: collapse;">
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <img class="logo" src="{{ secure_asset('/img/pet-shop.jpg') }}" alt="Logo">
            </td>
            <td style="width: 50%; vertical-align: top; text-align: right;">
                <div
                    class="header"
                    style="display: flex;
                        justify-content: end;
                        align-items: center;
                        height: 200px;">
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="header__title">
                        <div class="header__address">
                            Sumy city, Ukraine
                        </div>
                        <div class="header__phone">
                            +380 50 123 45 67
                        </div>
                        <div class="header__contact">
                            V. Terkin
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <div class="row">
        <div class="col-12">
            <div class="main__txt">
                <h3>Deals</h3>
                <p>Information about the deals:</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Closing Date</th>
                    <th scope="col">Account Name</th>
                    <th scope="col">Stage</th>
                </tr>
                </thead>
                <tbody>
                @foreach (@$data as $index => $item)
                    @php
                        $deal = $item['deal'];
                    @endphp
                    <tr>
                        <td>{{ @$index + 1 }}</td>
                        <td>{{ @$deal['Deal_Name'] }}</td>
                        <td>{{ @$deal['Amount'] }}</td>
                        <td>{{ @$deal['Closing_Date'] }}</td>
                        <td>{{ @$deal['Account_Name']['name'] }}</td>
                        <td>{{ @$deal['Stage'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
