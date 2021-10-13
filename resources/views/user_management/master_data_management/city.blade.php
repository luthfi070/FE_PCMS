@extends('app')
@section('content')

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">City</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> City List</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>COUNTRY</th>
                                <th>CITY NAME</th>
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
                    <h5 class="modal-title">ADD CITY</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">COUNTRY</label>
                            <div class="col-sm-10">
                                <select class="js-example-basic-single" style="width:100%" id="FormCountryName" name="state">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">CITY NAME</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="FormCityName">
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
                    <h5 class="modal-title">EDIT CITY</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <input type="hidden" id="idCityEdit" class="form-control">
                            <label for="input-21" class="col-sm-2 col-form-label">COUNTRY</label>
                            <div class="col-sm-10">
                                <select class="js-example-basic-single" style="width:100%" id="FormEditCountryName">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">CITY NAME</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="FormEditCityName">
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
                url: '/getCity',
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
                    data: "CityName"
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
                url: '/getCityByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#FormEditCityName').val(datob[0].CityName);
                $('#idCityEdit').val(datob[0].id);
                var newOption = new Option(datob[0].CountryName, datob[0].CountryID, true, true);
                $('#FormEditCountryName').append(newOption).trigger('change');
                $('#formmodaledit').modal('show');
            });
        });

        $('#btn-submit-edit').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/updateCity',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $('#idCityEdit').val(),
                    idCountry: $('#FormEditCountryName').val(),
                    name: $('#FormEditCityName').val(),
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Update', $('#idCityEdit').val(), 'success');
                } else {
                    errorAlert('Update', $('#idCityEdit').val(), 'error');
                }
                $('#formmodaledit').modal('toggle');
            });

        });

        $('#btn-submit-add').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/addCity',
                data: {
                    _token: "{{ csrf_token() }}",
                    idCountry: $('#FormCountryName').val(),
                    name: $('#FormCityName').val(),
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Add', $('#FormCityName').val(), 'success');
                   $('#FormCountryName').val('');
                    $('#FormCityName').val('');
                } else {
                    errorAlert('Add', $('#FormCityName').val(), 'error');
                    $('#FormCountryName').val('');
                    $('#FormCityName').val('');
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
                            url: '/deleteCity',
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

        $('#FormEditCountryName').select2({
            dropdownParent: $('#formmodaledit'),
            ajax: {
                url: '/getCountry',
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
                                text: item.CountryName,
                                slug: item.CountryName,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('#FormCountryName').select2({
            dropdownParent: $('#formmodal'),
            ajax: {
                url: '/getCountry',
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
                                text: item.CountryName,
                                slug: item.CountryName,
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