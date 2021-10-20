@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Country</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Country List</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>COUNTRY NAME</th>
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
                    <h5 class="modal-title">ADD COUNTRY</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">COUNTRY NAME</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="FormCountryName">
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
                    <h5 class="modal-title">EDIT COUNTRY</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">COUNTRY NAME</label>
                            <div class="col-sm-10">
                            <input type="hidden" id="idCountryEdit" class="form-control">
                                <input type="text" class="form-control" id="FormEditCountryName">
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
                url: '/getCountry',
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
                    data: "CountryName"
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
            url: '/getCountryByid',
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            }
        }).done(function(msg) {
            datob = JSON.parse(msg);
            $('#FormEditCountryName').val(datob[0].CountryName);
            $('#idCountryEdit').val(datob[0].id);
            $('#formmodaledit').modal('show');
        });
    });

    $('#btn-submit-edit').click(function(e) {
        e.preventDefault;
        $.ajax({
            type: "POST",
            url: '/updateCountry',
            data: {
                _token: "{{ csrf_token() }}",
                id: $('#idCountryEdit').val(),
                name: $('#FormEditCountryName').val(),
            }
        }).done(function(msg) {
            datob = JSON.parse(msg);
            $('#example').DataTable().ajax.reload();
            if (datob != 'error') {
                successAlert('Update', $('#idCountryEdit').val(), 'success');
            } else {
                errorAlert('Update', $('#idCountryEdit').val(), 'error');
            }
            $('#formmodaledit').modal('toggle');
        });

    });

    $('#btn-submit-add').click(function(e) {
        e.preventDefault;
        $.ajax({
            type: "POST",
            url: '/addCountry',
            data: {
                _token: "{{ csrf_token() }}",
                name: $('#FormCountryName').val(),
            }
        }).done(function(msg) {
            datob = JSON.parse(msg);
            $('#example').DataTable().ajax.reload();
            if (datob != 'error') {
                successAlert('Add', $('#FormCountryName').val(), 'success');
                $('#FormCountryName').val('');
            } else {
                errorAlert('Add', $('#FormCountryName').val(), 'error');
                $('#FormCountryName').val('');
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
                        url: '/deleteCountry',
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