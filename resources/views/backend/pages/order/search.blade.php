       <table class="table lms_table_active ">
           <thead>
               <tr>
                   <th scope="col">No</th>
                   <th scope="col">Order Id</th>
                   <th scope="col">Order Date</th>
                   <th scope="col">Payment Status</th>
                   <th scope="col">Order Status</th>
                   <th scope="col">Action</th>
               </tr>
           </thead>
           <tbody>
               @foreach ($orders as $order)
                   <tr>
                       <th scope="row"> <a href="#" class="question_content"> {{ $loop->index + 1 }} </a></th>
                       <td>#{{ $order->order_id }}</td>
                       <td>{{ $order->created_at->format('M d y') }}</td>
                       @if ($order->p_m_input == 2)
                           <td>{{ $order->order->status }}</td>
                       @else
                           <td>Cash On Delivery</td>
                       @endif
                       <td>Pending</td>
                       <td>
                           <div class="action_btns d-flex">
                               <a href="#" class="action_btn mr_10"> <i class="far fa-edit"></i> </a>
                               <a href="#" class="action_btn"> <i class="fas fa-trash"></i> </a>
                           </div>
                       </td>
                   </tr>
               @endforeach

           </tbody>
       </table>
