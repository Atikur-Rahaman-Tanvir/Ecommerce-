<table class="table lms_table_active3 ">
    <thead>
        <div id='success_msg' class="d-none alert text-white bg-success d-flex align-items-center justify-content-between"
            role="alert">
            <div class="alert-text" id="success_msg_text"></div>
            <button type="button" class="btn-close" aria-label="Close" id="alert_close"> </button>
        </div>
        <tr>
            <th scope="col">Sl No</th>
            <th scope="col">Product Name</th>
            <th scope="col">Bye Price</th>
            <th scope="col">sell Price</th>
            <th scope="col">Remain Qty</th>
            <th scope="col">Sell Qty</th>
            <th scope="col">Product Report</th>

        </tr>
    </thead>

    <tbody id="table_body">
        @foreach ($products as $product)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->buy_price }}</td>
                <td>{{ $product->price }}</td>
                @if ($product->quentity <= 10)
                    <td class="badge bg-danger text-white">{{ $product->quentity }}</td>
                @else
                    <td>{{ $product->quentity }}</td>
                @endif
                <td>{{ $product->sell_quentity }}</td>
                <td>
                    <a href="{{ route('admin.product.report', $product->id) }}" class="action_btn mr_10 edit"> <i
                            class="far fa-edit"></i> </a>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
