<html>

<head>
    <title>Invoice</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!--link rel="stylesheet" href="css/bootstrap.min.css"-->

    <script src="https://kit.fontawesome.com/e32992f439.js" crossorigin="anonymous"></script>
</head>

<body>
<h2 class="text-center">Pataal</h2>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Customer name</th>
                    <td field-key='customer'>{{ $data[0]->customer->first_name ?? '' }}</td>
                </tr>
                <tr>
                    <th>Room number</th>
                    <td field-key='room'>{{ $data[0]->room->room_number ?? '' }}</td>
                </tr>
                <tr>
                    <th>Time from</th>
                    <td field-key='time_from'>{{ $data[0]->time_from }}</td>
                </tr>
                <tr>
                    <th>Time to</th>
                    <td field-key='time_to'>{{ $data[0]->time_to }}</td>
                </tr>
                <tr>
                    <th>Additional information</th>
                    <td field-key='additional_information'>{!! $data[0]->additional_information !!}</td>
                </tr>
                <tr>
                    <th>Booking Status</th>
                    <td field-key='additional_information'>{!! $data[0]->status !!}</td>
                </tr>
            </table>
        </div>
    </div>

    <p>Billing Details</p>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Room Booking - From {{$data[0]->time_from}} to {{ $data[0]->time_to }}</td>
            <td>{{ $data[0]->amount }} rs.</td>
            <td>1</td>
            <td>{{ $data[0]->amount }} rs.</td>
        </tr>
        @foreach($data[1] as $item)
            <tr>
                <th scope="row">{{$data[2]++}}</th>
                <td>{{$item->name}}</td>
                <td>{{$item->amount}} rs.</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->total_amount}} rs.</td>

            </tr>
        @endforeach
        <tr>
            <th></th>
            <td class="mt-3"></td>
            <td></td>
            <td>Subtotal</td>
            <td>{{$data[0]->amount + $data[0]->items_total ?? 0}} rs.</td>
        </tr>
        <tr>
            <th></th>
            <td class="mt-3"></td>
            <td></td>
            <td>Discount</td>
            <td>{{$data[0]->discount ?? 0}} rs.</td>
        </tr>
        <tr>
            <th></th>
            <td class="mt-3"></td>
            <td></td>
            <td><b>Total</b></td>
            <td><b>{{$data[0]->total_amount}} rs.</b></td>
        </tr>
        </tbody>
    </table>
</div>
</body>

<script src="js/app.js"></script>


</html>
