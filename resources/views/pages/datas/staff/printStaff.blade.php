<!doctype html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        title {
            display: none;
        }
        body {
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h1 {
            margin-bottom: 5px;
        }

        h4 {
            margin-top: 0;
            font-weight: normal;
        }

        table {
            width: 100%;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
        }

        #filter-section {
            margin: 30px 0;
            text-align: start;
        }
    </style>
</head>
<body onload="window.print()">

<h1>{{ $config['institution_name'] }}</h1>
<h4>{{ $config['institution_address'] }}</h4>
<hr>

<h2>{{ $title }}</h2>


<table>
    <thead>
    <tr>
        <th>{{ __('model.staff.nip') }}</th>
        <th>{{ __('model.staff.nama') }}</th>
        <th>{{ __('model.staff.tanggal_lahir') }}</th>
        <th>{{ __('model.staff.gender') }}</th>
        <th>{{ __('model.staff.posisi') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $staff)
        <tr>
            <td>{{ $staff->nip }}</td>
            <td>{{ $staff->nama }}</td>
            <td>{{ $staff->tanggal_lahir }}</td>
            <td>{{ $staff->gender }}</td>
            <td>{{ $staff->posisi }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
