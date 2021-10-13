@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Issue Management</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Issue</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ISSUE</th>
                                <th>ASSIGN TO</th>
                                <th>ISSUE</th>
                                <th>RAISED</th>
                                <th>DUE DATE</th>
                                <th>PRIORITY</th>
                                <th>STATUS</th>
                                <th>CLOSE DATE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">ADD ISSUE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frm">
                        {{ csrf_field() }}
                        <input type="hidden" name="inp[ProjectID]" value="{{Session::get('ProjectID')}}">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">RAISED DATE</label>
                            <div class="col-sm-10">
                                <input type="date" name="inp[raised_date]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">INITIATED BY</label>
                            <div class="col-sm-10">
                                <input type="text" name="inp[initiated_by]" class="form-control">
                                {{-- <select class="form-control">
                                    <option></option>
                                </select> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ASSIGN TO</label>
                            <div class="col-sm-10">
                                <input type="text" name="inp[assign_to]" class="form-control">
                                {{-- <select class="form-control">
                                    <option></option>
                                </select> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DESCRIPTION</label>
                            <div class="col-sm-10">
                                <textarea name="inp[description]" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">PRIORITY</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="inp[priority]">
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">STATUS</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="inp[status]">
                                    <option value="open">Open</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DUE DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="inp[due_date]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CLOSED DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="inp[closed_date]">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">RESOLUTION ACTION</label>
                            <div class="col-sm-10">
                                <textarea name="inp[resolution]" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group float-right">

                            <button type="submit" class="btn btn-success px-5"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodaledit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">EDIT ISSUE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmedit">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="edit[ProjectID]" value="{{Session::get('ProjectID')}}">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">RAISED DATE</label>
                            <div class="col-sm-10">
                                <input type="date" name="edit[raised_date]" id="raised_date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">INITIATED BY</label>
                            <div class="col-sm-10">
                                <input type="text" name="edit[initiated_by]" id="initiated_by" class="form-control">
                                {{-- <select class="form-control">
                                    <option></option>
                                </select> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ASSIGN TO</label>
                            <div class="col-sm-10">
                                <input type="text" name="edit[assign_to]" id="assign_to" class="form-control">
                                {{-- <select class="form-control">
                                    <option></option>
                                </select> --}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DESCRIPTION</label>
                            <div class="col-sm-10">
                                <textarea name="edit[description]" id="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">PRIORITY</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="edit[priority]" id="priority">
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">STATUS</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="edit[status]" id="status">
                                    <option value="open">Open</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DUE DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="edit[due_date]" id="due_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CLOSED DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="edit[closed_date]" id="closed_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">RESOLUTION ACTION</label>
                            <div class="col-sm-10">
                                <textarea name="edit[resolution]" id="resolution" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group float-right">

                            <button type="submit" class="btn btn-success px-5"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div><!-- End Row-->
@endsection
@section('script')
<script>
    $(document).ready(function() {
        table = $('#example').DataTable({
            lengthChange: false,
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            buttons: [{
                text: 'New',
                className: 'btn-primary',
                action: function(e, dt, button, config) {
                    $('#formmodal').modal('toggle');
                }
            }],
            ajax: {
                url: '{{url("getIssue")}}',
                method: "POST",
                type: 'json',
                data: {
                        _token: "{{ csrf_token() }}"
                }
            },

            columns: [{
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "description"
                },
                {
                    data: "assign_to"
                },
                {
                    data: "description"
                },
                {
                    data: "raised_date"
                },
                {
                    data: "due_date"
                },
                {
                    data: "priority"
                },
                {
                    data: "status"
                },
                {
                    data: "closed_date"
                },
                {
                    data: "action"
                }
            ],
            initComplete: function() {
                table.buttons().container()
                    .appendTo('#example_wrapper .col-md-6:eq(0)');
            }
        });


    });

    $("#frm").submit(function(event) {
        event.preventDefault();
        var formData = new FormData($('#frm')[0]);
        $.ajax({
            url: '{{ url("addIssue") }}',
            type: 'post',
            data: formData,
            contentType: false, //untuk upload image
            processData: false, //untuk upload image
            timeout: 300000, // sets timeout to 3 seconds
            dataType: 'json',
            success: function(e) {
                if (e.status == 'ok;') {
                    swal("Data Berhasil Diinput!", {
                        icon: "success",
                    });
                    $('#example').DataTable().ajax.reload();
                    $('#formmodal').modal('toggle');
                } else {
                    alert(e.text);
                }
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            errorAlertServer('Response Not Found, Please Check Your Data');
        });
    });

    $("#frmedit").submit(function(event) {
        event.preventDefault();
        var formData = new FormData($('#frmedit')[0]);
        $.ajax({
            url: '{{ url("updateIssue") }}',
            type: 'post',
            data: formData,
            contentType: false, //untuk upload image
            processData: false, //untuk upload image
            timeout: 300000, // sets timeout to 3 seconds
            dataType: 'json',
            success: function(e) {
                if (e.status == 'ok;') {
                    swal("Data Berhasil Diubah!", {
                        icon: "success",
                    });
                    $('#example').DataTable().ajax.reload();
                    $('#formmodaledit').modal('toggle');
                } else {
                    alert(e.text);
                }
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            errorAlertServer('Response Not Found, Please Check Your Data');
        });
    });

    function edit(id) {
        $.ajax({
            url: '{{ url("editIssue") }}',
            type: 'post',
            dataType: 'json',
            data: ({
                id: id
            }),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(e) {
                $('#id').val(id);
                $.each(e, function(key, value) {
                    $('#' + key).val(value);
                });
                $('#example').DataTable().ajax.reload();
                $('#formmodaledit').modal({
                    keyboard: false,
                    backdrop: 'static'
                });
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            errorAlertServer('Response Not Found, Please Check Your Data');
        });
    }

    function del(id) {
        swal({
            title: 'Apakah Anda Yakin?',
            // text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result) {
                $.ajax({
                    url: '{{ url("deleteIssue") }}',
                    type: 'post',
                    dataType: 'json',
                    data: ({
                        id: id
                    }),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(e) {
                        if (e.status == 'ok;') {
                            swal(
                                'Deleted!',
                                'Data Berhasil Dihapus.',
                                'success'
                            );
                            $('#example').DataTable().ajax.reload();
                        } else {
                            alert(e.text);
                        }
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    errorAlertServer('Response Not Found, Please Check Your Data');
                });
            }
        })
    }
</script>
@endsection