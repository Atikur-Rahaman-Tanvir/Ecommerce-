  <div class="col-lg-12">
      <div class="white_card card_height_100 ">
          <div class="white_card_body">

              <div class=" mb-0 bg-danger p-2" style="width:260px;display:inline-block">
                  Total Payment Complete Order : {{ $orders->where('payment_status', 'Complete')->count() }}
              </div>

          </div>
      </div>
  </div>
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
                  <th scope="row"> <a href="#" class="question_content">
                          {{ $loop->index + 1 }} </a></th>
                  <td>#{{ $order->order_id }}</td>
                  <td>{{ $order->created_at->format('M d y') }}</td>
                  @if ($order->p_m_input == 2)
                      <td>{{ $order->payment_status }}</td>
                  @endif
                  <td>{{ $order->order_status }}</td>
                  <td>
                      <div class="action_btns d-flex">
                          <a href="{{ route('admin.order.details', $order->id) }}" class="action_btn mr_10"> <i
                                  class="far fa-eye"></i>
                          </a>

                          <a id="{{ $order->id }}" class="action_btn delete" data-bs-toggle="modal"
                              data-bs-target="#delete_modal">
                              <i class="fas fa-trash"></i> </a>
                      </div>
                  </td>
              </tr>
          @endforeach

      </tbody>
  </table>
