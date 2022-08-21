
                                        <div class="white_box_tittle list_header">
                                            {{-- <h4 class="bg-danger p-2" style="width: 130px"> {{ $this_year }}</h4> --}}
                                            <div class="box_right d-flex lms_block">
                                            </div>
                                        </div>
                                       <table class="table text-center">
                                            <thead class="">
                                                <tr>
                                                    <th scope="col">ORDER DATE</th>
                                                    <th scope="col">ONLINE ORDER</th>
                                                    <th scope="col">ONLINE ORDER SEll</th>
                                                    <th scope="col">COD ORDER</th>
                                                    <th scope="col">COD ORDER SELL</th>
                                                    <th scope="col">TOTAL ORDER</th>
                                                    <th scope="col">SUB TOTAL</th>
                                                    <th scope="col">TOTAL SHIPPING</th>
                                                    <th scope="col">GRAND TOTAL</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($monthly_order as $order)
                                                    <tr>
                                                        <td>{{ $order->month}}</td>
                                                        <td>{{ $order->online_payment }}</td>
                                                        <td>${{ $order->online_total }}</td>
                                                        <td>{{ $order->cod_payment }}</td>
                                                        <td>${{ $order->cod_total }}</td>
                                                        <td>{{ $order->order_total}}</td>
                                                        <td>${{ $order->cart_total }}</td>
                                                        <td>${{ $order->shipping_total }}</td>
                                                        <td>${{ $order->grand_total }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                                  <tfoot class="">
                                                <tr>
                                                    <td >Total</td>
                                                    <td scope="col">{{$total->online_payment}}</td>
                                                    <td scope="col">${{$total->online_total}}</td>
                                                    <td scope="col">{{$total->cod_payment}}</td>
                                                    <td scope="col">${{$total->cod_total}}</td>
                                                    <td scope="col">{{$total->order_total}}</td>
                                                    <td scope="col">${{$total->cart_total}}</td>
                                                    <td scope="col">${{$total->shipping_total}}</td>
                                                    <td scope="col">${{$total->grand_total}}</td>

                                                </tr>
                                            </tfoot>
                                        </table>
