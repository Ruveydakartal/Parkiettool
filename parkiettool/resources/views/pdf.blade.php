<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order_{{$order->id}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .empty-row {
            height: 10px;
        }

        .no-orders {
            font-style: italic;
            color: #666;
        }

    </style>
</head>

<body>

    <h1>EIGENDOMSBEWIJS KWEEEKRING BVP SEIZOEN {{$order->updated_at->format('Y')}}</h1>
    <h3>De volgende ringen behoren toe aan:</h3>
    <div>
        <h2>Naam: {{Auth::user()->firstname}} {{Auth::user()->lastname}} </h2>
        <h2>Stamnummer: {{Auth::user()->stamnr}}</h2>
    </div>
    @vite ('resources/css/history.css')
    <table>
        <thead>
            <tr>
                <th>Stamnr</th>
                <th></th>
                <th>Soort</th>
                <th>Maat</th>
                <th>Code</th>
                <th>Aantal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->orderItems as $orderItem)
            <tr>
                <td>{{Auth::user()->stamnr}}</td>
                <td>BVP</td>
                <td>{{ $orderItem->ring->type->name }}</td>
                <td>{{ $orderItem->ring->size }}</td>
                <td>{{ $orderItem->ring->type->color  }}</td>
                <td>{{ $orderItem->amount }}</td>

            </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
