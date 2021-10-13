@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Business Partner</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Business Partner</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>BUSINESS</th>
                                <th>ADDRESS</th>
                                <th>PHONE</th>
                                <th>FAX</th>
                                <th>EMAIL</th>
                                <th>HOMEPAGE</th>
                                <th>MOBILE PHONE</th>
                                <th>COUNTRY</th>
                                <th>CITY</th>
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
                    <h5 class="modal-title">ADD BUSINESS PARTNER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAddPartner">
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">NAME OF BUSINESS PARTNER</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="businessName" name="businessName" placeholder="Enter Your Business Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">ADDRESS</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Address" name="Address" placeholder="Enter Your Address">
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
                            <label for="input-21" class="col-sm-2 col-form-label">PHONE</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="phoneNumber" placeholder="Enter Your Phone Number" name="phoneNumber">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">FAX</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="faxNumber" placeholder="Enter Your Fax Number" name="faxNumber">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">EMAIL</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="Email" placeholder="Enter Your Email" name="Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">WEB</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="web" placeholder="Enter Your Website" name="web">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">MOBILE PHONE</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="mobileNumber" placeholder="Enter Your Mobile Number" name="mobileNumber">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">BUSINESS TYPE</label>
                            <div class="col-sm-10">
                                <select class="js-example-basic-single" style="width:100%" id="BusinessType" name="BusinessType">
                                    <option></option>
                                </select>
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
                    <h5 class="modal-title">EDIT BUSINESS PARTNER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAddPartnerEdit">
                        <input type="hidden" id="idPartner" name="idPartner" class="form-control">
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">NAME OF BUSINESS PARTNER</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="businessNameEdit" name="businessNameEdit" placeholder="Enter Your Business Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">ADDRESS</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="AddressEdit" name="AddressEdit" placeholder="Enter Your Address">
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
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">PHONE</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="phoneNumberEdit" name="phoneNumberEdit" placeholder="Enter Your Phone Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">FAX</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="faxNumberEdit" name="faxNumberEdit" placeholder="Enter Your Fax Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">EMAIL</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="EmailEdit" name="EmailEdit" placeholder="Enter Your Email">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">WEB</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="webEdit" name="webEdit" placeholder="Enter Your Website">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">MOBILE PHONE</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="mobileNumberEdit" name="mobileNumberEdit" placeholder="Enter Your Mobile Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">BUSINESS TYPE</label>
                            <div class="col-sm-10">
                                <select class="js-example-basic-single" style="width:100%" id="BusinessTypeEdit" name="BusinessTypeEdit">
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


        $('#BusinessType').select2({
            //dropdownParent: $('#formmodal'),
            ajax: {
                url: '/getType',
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
                                text: item.BussinessTypeName,
                                slug: item.BussinessTypeName,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

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
                url: '/getBusinessPartner',
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
                    data: "BussinessName"
                },
                {
                    data: "Address"
                },
                {
                    data: "Phone"
                },
                {
                    data: "Fax"
                },
                {
                    data: "Email"
                },
                {
                    data: "Web"
                },
                {
                    data: "MobilePhone"
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
                url: '/getBusinessPartnerByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#idPartner').val(datob[0].id);
                $('#businessNameEdit').val(datob[0].BussinessName);
                $('#AddressEdit').val(datob[0].Address);

                var newOption1 = new Option(datob[0].CountryName, datob[0].CountryID, true, true);
                $('#CountryNameEdit').append(newOption1).trigger('change');

                var newOption2 = new Option(datob[0].CityName, datob[0].CityID, true, true);
                $('#CityNameEdit').append(newOption2).trigger('change');
                $('#phoneNumberEdit').val(datob[0].Phone);
                $('#faxNumberEdit').val(datob[0].Fax);
                $('#EmailEdit').val(datob[0].Email);
                $('#webEdit').val(datob[0].Web);
                $('#mobileNumberEdit').val(datob[0].MobilePhone);

                var newOption3 = new Option(datob[0].BussinessTypeName, datob[0].BussinessTypeID, true, true);
                $('#BusinessTypeEdit').append(newOption3).trigger('change');
                $('#formmodaledit').modal('show');
            });
        });

        $('#btn-submit-edit').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/updateBusinessPartner',
                data:  $('#formAddPartnerEdit').serialize() + "&_token="+ '{{ csrf_token() }}'
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Update', $('#idPartner').val(), 'success');
                } else {
                    errorAlert('Update', $('#idPartner').val(), 'error');
                }
                $('#formmodaledit').modal('toggle');
            });

        });

        $('#btn-submit-add').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/addBusinessPartner',
                data: $('#formAddPartner').serialize() + "&_token="+ '{{ csrf_token() }}'
                   
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Add', $('#businessName').val(), 'success');
                    $('#formAddPartner')[0].reset();
                    $('#CountryName').val('');
                    $('#CityName').val('');
                    $('#BusinessType').val('');
                } else {
                    errorAlert('Add', $('#businessName').val(), 'error');
                    $('#formAddPartner')[0].reset();
                    $('#CountryName').val('');
                    $('#CityName').val('');
                    $('#BusinessType').val('');
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
                            url: '/deleteBusinessPartner',
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


    $('#BusinessTypeEdit').select2({
        //dropdownParent: $('#formmodalEdit'),
        ajax: {
            url: '/getType',
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
                            text: item.BussinessTypeName,
                            slug: item.BussinessTypeName,
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