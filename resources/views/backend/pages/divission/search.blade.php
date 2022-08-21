<table class="table lms_table_active3 " id="data_table">
    <thead>
        <div id='success_msg' class="d-none alert text-white bg-success d-flex align-items-center justify-content-between"
            role="alert">
            <div class="alert-text" id="success_msg_text"></div>
            <button type="button" class="btn-close" aria-label="Close" id="alert_close"> </button>
        </div>
        <tr>
            <th scope="col">Sl No</th>
            <th scope="col">Name</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>

        </tr>
    </thead>

    <tbody id="table_body">
        @foreach ($tags as $Tag)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $Tag->name }}</td>
                <td>
                    @if ($Tag->status == 0)
                        <span class="badge badge-danger">Pending</span>
                    @else
                        <span class="badge badge-success">Active</span>
                    @endif
                </td>

                <td>
                    <div class="action_btns d-flex">


                        <a id="{{ $Tag->id }}" class="action_btn mr_10 status "> <i
                                class="{{ $Tag->status == 0 ? 'far fa-eye-slash' : 'fa fa-eye' }}"></i>
                        </a>

                        <a id="{{ $Tag->id }}" class="action_btn mr_10 edit " data-bs-toggle="modal"
                            data-bs-target="#edit_modal"> <i class="far fa-edit"></i> </a>


                        <a id="{{ $Tag->id }}" class="action_btn delete" data-bs-toggle="modal"
                            data-bs-target="#delete_modal">
                            <i class="fas fa-trash"></i> </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
