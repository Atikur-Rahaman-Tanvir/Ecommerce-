


<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;

        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #fe877b;
            color: white;
        }
        #customers td {
            text-align: center;
        }
        .tfoot{
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: right;
            background-color: #fe877b;
            color: white;
        }
    </style>
</head>

<body>


    <h1>Thank Your For Order</h1>
    <p>Your order is successfully placed.</p>
    <p>Order Tracking id #{{$order_summery->order_id}}</p>


    <table id="customers">
    <tr>
      <th scope="col">NO</th>
      <th scope="col">Product Image</th>
      <th scope="col">Product Name</th>
      <th scope="col">Price</th>
      <th scope="col">Quentity</th>
      <th scope="col">Totla</th>
    </tr>

     @foreach ($placeOrder as $order_item)

    <tr>
      <th scope="row">{{$loop->index+1}}</th>
      <td><img width="50" src="{{asset('storage/product_image/'.$order_item->product->image)}}" alt=""></td>
      <td>{{$order_item->product->name}}</td>
      <td>{{$order_item->price}}</td>
      <td>{{$order_item->quentity}}</td>
      <td>{{$order_item->total}}</td>
    </tr>
    @endforeach
    <tr class="">
        <td colspan="5">Shipping Price</td>
        <td >{{$order_summery->sipping_price}}</td>
    </tr>
    <tr class="">
        <td colspan="5">Total</td>
        <td >{{$order_summery->order_total}}</td>
    </tr>


    </table>
</body>

</html>
