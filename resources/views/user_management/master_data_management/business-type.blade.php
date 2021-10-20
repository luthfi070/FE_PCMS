@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Business Type</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Type of Business</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TYPE</th>
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
                    <h5 class="modal-title">ADD TYPE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">TYPE</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="formTypeAdd" placeholder="Enter Your Type">
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">
                        <button class="btn btn-success px-5" id="btn-submit-add"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodaledit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">EDIT TYPE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editType">
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">TYPE</label>
                            <div class="col-sm-10">
                                <input type="hidden" id="idTypeEdit" class="form-control">
                                <input type="text" id="formTypeEdit" class="form-control" placeholder="Enter Your Type">
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">
                        <button class="btn btn-success px-5" id="btn-submit-edit"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!-- End Row-->
@endsection
@section('script')
<script>
    $(document).ready(function() {
        //Default data table
        $('#default-datatable').DataTable();


        var table = $('#example').DataTable({
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
                url: '/getType',
                method: "GET",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                }
            },
            columns: [{
                    data: "no"
                },
                {
                    data: "BussinessTypeName"
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

    $('#example tbody').on('click', '.edit-btn', function() {
        var id = $(this).data("id");
        console.log(id);
        $.ajax({
            type: "POST",
            url: '/getTypeByid',
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            }
        }).done(function(msg) {
            datob = JSON.parse(msg);
            $('#formTypeEdit').val(datob[0].BussinessTypeName);
            $('#idTypeEdit').val(datob[0].id);
            $('#formmodaledit').modal('show');
        });
    });

    $('#btn-submit-edit').click(function(e) {
        e.preventDefault;
        $.ajax({
            type: "POST",
            url: '/updateType',
            data: {
                _token: "{{ csrf_token() }}",
                id: $('#idTypeEdit').val(),
                type: $('#formTypeEdit').val(),
            }
        }).done(function(msg) {
            datob = JSON.parse(msg);
            $('#example').DataTable().ajax.reload();
            if (datob != 'error') {
                successAlert('Update', $('#idTypeEdit').val(), 'success');
            } else {
                errorAlert('Update', $('#idTypeEdit').val(), 'error');
            }
            $('#formmodaledit').modal('toggle');
        });

    });

    $('#btn-submit-add').click(function(e) {
        e.preventDefault;
        $.ajax({
            type: "POST",
            url: '/addType',
            data: {
                _token: "{{ csrf_token() }}",
                type: $('#formTypeAdd').val(),
            }
        }).done(function(msg) {
            datob = JSON.parse(msg);
            $('#example').DataTable().ajax.reload();
            if (datob != 'error') {
                successAlert('Add', $('#formTypeAdd').val(), 'success');
                $('#formTypeAdd').val('');
            } else {
                errorAlert('Add', $('#formTypeAdd').val(), 'error');
                $('#formTypeAdd').val('');
            }
            $('#formmodal').modal('toggle');
        });

    });

    $('#example tbody').on('click', '.confirm-btn-alert', function() {
        idData = $(this).attr('data-ids');
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "POST",
                        url: '/deleteType',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: idData
                        }
                    }).done(function(msg) {
                        datob = JSON.parse(msg);
                        $('#example').DataTable().ajax.reload();
                        if (datob != 'error') {
                            swal("Your Data has been deleted!", {
                                icon: "success",
                            });
                        } else {
                            swal("Your Data has Failed to delete!", {
                                icon: "error",
                            });
                        }
                    });

                } else {
                    swal("Your Data is safe!");
                }
            });

    });
</script>
@endsection