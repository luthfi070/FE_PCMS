@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Position</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Position</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>POSITION NAME</th>
                                <th>CATEGORY NAME</th>
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
                    <h5 class="modal-title">ADD POSITION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">CATEGORY</label>
                            <div class="col-sm-10">
                                <select class="js-example-basic-single" style="width:100%" id="CategoryName" name="state">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">POSITION</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="positionName" placeholder="Enter Your Position">
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">
                        <button class="btn btn-success px-5" id="btn-submit-add"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodaledit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">EDIT POSITION</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                    <input type="hidden" id="idPositionEdit" class="form-control">
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">CATEGORY</label>
                            <div class="col-sm-10">
                                <select class="js-example-basic-single" style="width:100%" id="CategoryNameEdit" name="state">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">POSITION</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="positionNameEdit" placeholder="Enter Your Position">
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">
                        <button class="btn btn-success px-5" id="btn-submit-edit"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>
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
                url: '/getPosition',
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
                    data: "PositionName"
                }, {
                    data: "CategoryName"
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

        $('#example tbody').on('click', '.edit-btn', function() {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/getPositionByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#positionNameEdit').val(datob[0].PositionName);
                var newOption = new Option(datob[0].CategoryName, datob[0].id, true, true);
                $('#CategoryNameEdit').append(newOption).trigger('change');
                $('#idPositionEdit').val(datob[0].id);
                $('#formmodaledit').modal('show');
            });
        });

        $('#btn-submit-edit').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/updatePosition',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $('#idPositionEdit').val(),
                    PositionCatID: $('#CategoryNameEdit').val(),
                    name: $('#positionNameEdit').val(),
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Update', $('#idPositionEdit').val(), 'success');
                } else {
                    errorAlert('Update', $('#idPositionEdit').val(), 'error');
                }
                $('#formmodaledit').modal('toggle');
            });

        });

        $('#btn-submit-add').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/addPosition',
                data: {
                    _token: "{{ csrf_token() }}",
                    PositionCatID: $('#CategoryName').val(),
                    name: $('#positionName').val(),
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Add', $('#positionName').val(), 'success');
                } else {
                    errorAlert('Add', $('#positionName').val(), 'error');
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
                            url: '/deletePosition',
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

        $('#CategoryName').select2({
            dropdownParent: $('#formmodal'),
            ajax: {
                url: '/getPositionCategory',
                data: function(params) {
                    var queryParameters = {
                        term: params.term
                    }
                    return queryParameters;
                },
                processResults: function(data) {
                    datob = JSON.parse(data);
                    return {
                        results: $.map(datob, function(item) {
                            return {
                                text: item.CategoryName,
                                slug: item.CategoryName,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('#CategoryNameEdit').select2({
            dropdownParent: $('#formmodalEdit'),
            ajax: {
                url: '/getPositionCategory',
                data: function(params) {
                    var queryParameters = {
                        term: params.term
                    }
                    return queryParameters;
                },
                processResults: function(data) {
                    datob = JSON.parse(data);
                    return {
                        results: $.map(datob, function(item) {
                            return {
                                text: item.CategoryName,
                                slug: item.CategoryName,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

    });
</script>
@endsection