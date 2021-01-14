<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="{{ public_path('css/bootstrap4/bootstrap.min.css') }}" rel="stylesheet"> -->

    <title>Document</title>
    <Style>
        body {
            font-family: sans-serif;
        }

        .container {
            margin: 1em 2em;
        }

        .topHeader {
            border: 4px solid #11193c;
        }

        .topHeader2 {
            border: none;
            width: 30%;
            height: 48px;
            border-bottom: 8px solid #fff;
            /* border-color:#eb2d7c; */
            box-shadow: 0 16px 20px -20px #eb2d7c;
            margin: -3.5em auto 10px;
            border-radius: 10% / 50%;
        }

        .page-break {
            page-break-after: always;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        img {
            width: 240px;
            height: 80px;
        }

        #cssTable td {
            height: 80px;
            width: 260px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            vertical-align: middle;
            border: none;
            padding: 3%;
        }

        #footerTable1 td {
            width: 260px;
            font-size: 18px;
            font-weight: bold;
            text-align: left;
            border: none;
            padding-top: 2%;
        }

        #footerTable2 td {
            width: 260px;
            font-size: 18px;
            font-weight: bold;
            text-align: left;
            border: none;
            padding-top: 6%;
        }

        #footerTable3 td {
            width: 260px;
            font-size: 18px;
            font-weight: bold;
            text-align: left;
            border: none;
            padding-top: 1%;
        }

        #main td {
            height: 30px;
            font-size: 18px;
            text-align: left;
            vertical-align: middle;
            padding: 4px;
        }

        #main {
            border-spacing: 0 1em;
            border-collapse: separate;
        }

        .pinkLine {
            border-top: 3px solid #fc2861;
            margin: 0em;
        }

        .blueLine {
            border-top: 3px solid #11193c;
            margin: 0.12em;

        }

        .div1,
        .div2,
        .div3 {
            width: 98%;
            padding: 12px;
            border: 2px solid #0b1128;
            /* box-shadow:inset 2px -2px 1px #fc2861; */
            -webkit-box-shadow: inset 2px 0px 2px #fc2861, inset -2px 0px 2px #fc2861;
            -moz-box-shadow: inset 2px 0px 2px #fc2861, inset -2px 0px 2px#fc2861;
            box-shadow: inset 2px 0px 2px #fc2861, inset -2px 0px 2px #fc2861;
            border-radius: 10px;
        }

        h3 {
            margin: 2em auto auto;
        }

        .htwoPos {
            display: table;
            background-color: #cd246c;
            padding: 8px;
            font-size: 20px;
            width: 100%;
        }
        #clearanceDivTb{
            margin:auto 7em;
        }
        #clearanceTb1 td {
            width: 80%;
            font-size: 18px;
            font-weight: bold;
            border: none;
        }

        #clearanceTb2 td {
            width: 80%;
            font-size: 18px;
            font-weight: bold;
            border: none;
            padding-top: 5%;
        }

        #clearanceTb3 td {
            width: 80%;
            font-size: 18px;
            font-weight: bold;
            border: none;
        }

        .footerLine {
            border: 0;
            height: 1px;
            background: #333;
            background-image: -webkit-linear-gradient(left, #ccc, #333, #ccc);
            background-image: -moz-linear-gradient(left, #ccc, #333, #ccc);
            background-image: -ms-linear-gradient(left, #ccc, #333, #ccc);
            background-image: -o-linear-gradient(left, #ccc, #333, #ccc);
        }

        .footerText {
            margin: 0em 3em;
            font-size: 10px;
        }

        .textP {
            font-size: 16px;
        }

        #h3TitlePage2 {
            margin: 1em auto 1em;
            text-align: center;
            font-size: 19px;
        }

        .Behalf1st,
        .behalf2nd {
            font-size: 17px;
        }

        li {
            margin-bottom: 1rem;
            line-height: 1;
        }

        li::first-line {
            line-height: 2;
        }

        #signatureP2 {
            margin: 1em 2em;
            border-spacing: 1em 1em;
            border-collapse: separate;
            font-size: 15px;
            /* border:1px solid black; */
        }

    </Style>
</head>

<body>
    @include('pdf.header')

    @yield('content')

    @include('pdf.footer')
    <div class="page-break"></div>

    @include('pdf.header')
    @yield('contentPage2')
    @include('pdf.footer')

</body>

</html>
