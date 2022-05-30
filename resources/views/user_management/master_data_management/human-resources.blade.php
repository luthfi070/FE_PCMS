@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Human Resources</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Resources</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAME</th>
                                <th>ADDRESS</th>
                                <th>PHONE</th>
                                <th>EMAIL</th>
                                <th>MOBILE PHONE</th>
                                <th>COUNTRY</th>
                                <th>CITY</th>
                                <th>POSITION</th>
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
                    <h5 class="modal-title">ADD HUMAN RESOURCES</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAddPersonil">
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">BUSINESS NAME</label>
                            <div class="col-sm-10">
                            <select class="js-example-basic-single" style="width:100%" id="BusinessName" name="BusinessName">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">NAME</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="PersonilName" name="PersonilName" placeholder="Enter Resource Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">ADDRESS</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="PersonilAddress" name="PersonilAddress" placeholder="Enter Resource Address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">COUNTRY</label>
                            <div class="col-sm-10">
                            <select class="js-example-basic-single" style="width:100%" id="CountryName" name="CountryName">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">CITY</label>
                            <div class="col-sm-10">
                            <select class="js-example-basic-single" style="width:100%" id="CityName" name="CityName">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">POST ZIP</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="PostZip" name="PostZip" placeholder="Enter Your Post Zip">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">PHONE</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="PersonilPhone" name="PersonilPhone" placeholder="Enter Your Type Phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">MOBILE PHONE</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="PersonilHp" name="PersonilHp" placeholder="Enter Your Mobile Phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">EMAIL</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="PersonilEmail" name="PersonilEmail" placeholder="Enter Your Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">POSITION</label>
                            <div class="col-sm-10">
                            <select class="js-example-basic-single" style="width:100%" id="PositionName" name="PositionName">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">
                        <button class="btn btn-success px-5"  id="btn-submit-add"><i class="fa fa-save"></i> Save</button>
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
                    <h5 class="modal-title">EDIT HUMAN RESOURCES</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAddPersonilEdit">
                    <input type='hidden' id='idPersonil' name='idPersonil'>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">BUSINESS NAME</label>
                            <div class="col-sm-10">
                            <select class="js-example-basic-single" style="width:100%" id="BusinessNameEdit" name="BusinessNameEdit">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">NAME</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="PersonilNameEdit" name="PersonilNameEdit" placeholder="Enter Resource Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">ADDRESS</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="PersonilAddressEdit" name="PersonilAddressEdit" placeholder="Enter Resource Address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">COUNTRY</label>
                            <div class="col-sm-10">
                            <select class="js-example-basic-single" style="width:100%" id="CountryNameEdit" name="CountryNameEdit">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">CITY</label>
                            <div class="col-sm-10">
                            <select class="js-example-basic-single" style="width:100%" id="CityNameEdit" name="CityNameEdit">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">POST ZIP</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="PostZipEdit" name="PostZipEdit" placeholder="Enter Your Post Zip">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">PHONE</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="PersonilPhoneEdit" name="PersonilPhoneEdit" placeholder="Enter Your Type Phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">MOBILE PHONE</label>
                            <div class="col-sm-10">
                            <input type="number" class="form-control" id="PersonilHpEdit" name="PersonilHpEdit" placeholder="Enter Your Mobile Phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">EMAIL</label>
                            <div class="col-sm-10">
                            <input type="email" class="form-control" id="PersonilEmailEdit" name="PersonilEmailEdit" placeholder="Enter Your Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">POSITION</label>
                            <div class="col-sm-10">
                            <select class="js-example-basic-single" style="width:100%" id="PositionNameEdit" name="PositionNameEdit">
                                    <option></option>
                                </select>
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
                url: '/getHumanResources',
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
                    data: "PersonilName"
                },
                {
                    data: "Address"
                },
                {
                    data: "Phone"
                },
                {
                    data: "Email"
                },
                {
                    data: "Hp"
                },
                {
                    data: "CountryName"
                },
                {
                    data: "CityName"
                },
                {
                    data: "PositionName"
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

        $('#CountryName').select2({
            //dropdownParent: $('#formmodal'),
            ajax: {
                url: '/getCountry',
                data: "",
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

        $('#CountryName').on('change', function() {
            $('#CityName').select2({
                //dropdownParent: $('#formmodal'),
                ajax: {
                    type: 'POST',
                    url: '/getCityByCountryId',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('#CountryName').val()
                    },
                    processResults: function(data) {
                        datob = JSON.parse(data);
                        return {
                            results: $.map(datob, function(item) {
                                return {
                                    text: item.CityName,
                                    slug: item.CityName,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });


        $('#BusinessName').select2({
            //dropdownParent: $('#formmodal'),
            ajax: {
                url: '/getBusinessPartner',
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
                                text: item.BussinessName,
                                slug: item.BussinessName,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('#PositionName').select2({
            //dropdownParent: $('#formmodal'),
            ajax: {
                url: '/getPosition',
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
                                text: item.PositionName,
                                slug: item.PositionName,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('#example tbody').on('click', '.edit-btn', function() {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/getHumanResourcesByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                console.log(msg);
                datob = JSON.parse(msg);
                console.log(datob);
                $('#idPersonil').val(datob[0].id);
                $('#PersonilNameEdit').val(datob[0].PersonilName);
                $('#PersonilAddressEdit').val(datob[0].Address);

                var newOption1 = new Option(datob[0].CountryName, datob[0].CountryID, true, true);
                $('#CountryNameEdit').append(newOption1).trigger('change');

                var newOption2 = new Option(datob[0].CityName, datob[0].CityID, true, true);
                $('#CityNameEdit').append(newOption2).trigger('change');
                $('#PersonilPhoneEdit').val(datob[0].Phone);
                $('#PersonilHpEdit').val(datob[0].Hp);
                $('#PersonilEmailEdit').val(datob[0].Email);
                $('#PostZipEdit').val(datob[0].Postzip);

                var newOption3 = new Option(datob[0].BussinessName, datob[0].BussinessPartnerID, true, true);
                $('#BusinessNameEdit').append(newOption3).trigger('change');

                var newOption4 = new Option(datob[0].PositionName, datob[0].PositionID, true, true);
                $('#PositionNameEdit').append(newOption4).trigger('change');
                $('#formmodaledit').modal('show');
            });
        });

        $('#btn-submit-edit').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/updateHumanResources',
                data: $('#formAddPersonilEdit').serialize() + "&_token="+ '{{ csrf_token() }}'
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Update', $('#idPersonil').val(), 'success');
                } else {
                    errorAlert('Update', $('#idPersonil').val(), 'error');
                }
                $('#formmodaledit').modal('toggle');
            });

        });

        $('#btn-submit-add').click(function(e) {
            e.preventDefault;
            $('#btn-submit-add').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span> Loading...');
            $('#btn-submit-add').prop("disabled", true);
            $.ajax({
                type: "POST",
                url: '/addHumanResources',
                data: $('#formAddPersonil').serialize() + "&_token="+ '{{ csrf_token() }}'
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Add', $('#PersonilName').val(), 'success');
                    $('#formAddPersonil')[0].reset();
                } else {
                    errorAlert('Add', $('#PersonilName').val(), 'error');
                    $('#formAddPersonil')[0].reset();
                }
                $('#btn-submit-add').html('<i class="fa fa-save"></i> Save');
                $('#btn-submit-add').prop("disabled", false);
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
                            url: '/deleteHumanResources',
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

        $('#CountryNameEdit').select2({
        //dropdownParent: $('#formmodalEdit'),
        ajax: {
            url: '/getCountry',
            data: "",
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

    $('#CountryNameEdit').on('change', function() {
        $('#CityNameEdit').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                type: 'POST',
                url: '/getCityByCountryId',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $('#CountryNameEdit').val()
                },
                processResults: function(data) {
                    datob = JSON.parse(data);
                    return {
                        results: $.map(datob, function(item) {
                            return {
                                text: item.CityName,
                                slug: item.CityName,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
    });


    $('#BusinessNameEdit').select2({
        //dropdownParent: $('#formmodalEdit'),
        ajax: {
            url: '/getBusinessPartner',
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
                            text: item.BussinessName,
                            slug: item.BussinessName,
                            id: item.id
                        }
                    })
                };
            }
        }
    });

    $('#PositionNameEdit').select2({
            //dropdownParent: $('#formmodal'),
            ajax: {
                url: '/getPosition',
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
                                text: item.PositionName,
                                slug: item.PositionName,
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