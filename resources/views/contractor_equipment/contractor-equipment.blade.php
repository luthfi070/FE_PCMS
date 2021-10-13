@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Contractor Equipments</h4>
            </div>
        </div>
    </div>
    @include('contractor-list')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Equipments List</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>EQUIPMENT</th>
                                <th>CONTRACTOR</th>
                                <th>UNIT</th>
                                <th>MOBILIZATION DATE</th>
                                <th>DEMOBILIZATION DATE</th>
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
                    <h5 class="modal-title">NEW EQUIPMENT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="input-22" class="col-sm-2 col-form-label">EQUIPMENT NAME</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="EquipmentName" name="EquipmentName" placeholder="Enter Your Equipment Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="width:100%" id="BusinessPartnerID" name="BusinessPartnerID">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">UNIT</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="width:100%" id="UnitID" name="UnitID">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">MOBILIZATION DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="MobilizationDate" name="MobilizationDate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DEMOBILIZATION DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="DemobilizationDate" name="DemobilizationDate">
                            </div>
                        </div>
                        <div class="form-group float-right">

                            <button class="btn btn-success px-5" id="btn-submit-add"><i class="fa fa-save"></i> Save</button>
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
                    <h5 class="modal-title">EDIT EQUIPMENT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="idEquipment" class="form-control">
                        <div class="form-group row">
                            <label for="input-22" class="col-sm-2 col-form-label">EQUIPMENT NAME</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="EquipmentNameEdit" name="EquipmentName1" placeholder="Enter Your Equipment Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="ContractorEdit" style="width:100%" name="ContractorEdit">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">UNIT</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="width:100%" id="UnitidEdit">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">MOBILIZATION DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="MobilizationEdit" name="MobilizationEdit">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DEMOBILIZATION DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="DemobilizationEdit" name="DemobilizationEdit">
                            </div>
                        </div>
                        <div class="form-group float-right">

                            <button type="submit" class="btn btn-success px-5" id="btn-submit-edit"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        //Default data table
        $('#default-datatable').DataTable();

        $('#BusinessPartnerID').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                url: '/getBusinessPartner',
                data: "",
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

        $('#UnitID').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                url: '/getUnit',
                data: "",
                processResults: function(data) {
                    datob = JSON.parse(data);
                    return {
                        results: $.map(datob, function(item) {
                            return {
                                text: item.unitName,
                                slug: item.unitName,
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
                    //$('#formmodal').modal();
                    swal({
                        title: "Warning",
                        text: "Choose Contractor From List!",
                        icon: "warning",
                        // buttons: true,
                        dangerMode: true,
                    })
                }
            }],

            ajax: {
                url: '/getContractorEquipment',
                method: "POST",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                    contractorID: $('#contractor-list').val(),
                }
            },
            columns: [{
                    data: "No"

                },
                {
                    data: "EquipmentName"
                },
                {
                    data: "BussinessName"
                },
                {
                    data: "unitName"
                },
                {
                    data: "MobilizationDate"
                },
                {
                    data: "DemobilizationDate"
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

        $('#btn-submit-add').click(function(e) {
            e.preventDefault;

            $.ajax({
                type: "POST",
                url: '/InsertContractorEquipment',
                data: {
                    _token: "{{ csrf_token() }}",
                    EquipmentName: $('#EquipmentName').val(),
                    BusinessPartnerID: $('#BusinessPartnerID').val(),
                    UnitID: $('#UnitID').val(),
                    MobilizationDate: $('#MobilizationDate').val(),
                    DemobilizationDate: $('#DemobilizationDate').val()

                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Add', $('#EquipmentName').val(), 'success');
                    $('#EquipmentName').val('');
                    $('#ContractorName').val('');
                    $('#unitName').val('');
                    $('#MobilizationDate').val('');
                    $('#DemobilizationDate').val('');

                } else {
                    errorAlert('Add', $('#EquipmentName ').val(), 'error');
                    $('#EquipmentName').val('');
                    $('#ContractorName').val('');
                    $('#unitName').val('');
                    $('#MobilizationDate').val('');
                    $('#DemobilizationDate').val('');
                }
                $('#formmodal').modal('toggle');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
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
                            url: '/DeleteContractorEquipment',
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
                        }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

                    } else {
                        swal("Your Data is safe!");
                    }
                });

        });

        $('#ContractorEdit').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                url: '/getBusinessPartner',
                data: "",
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

        $('#UnitidEdit').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                url: '/getUnit',
                data: "",
                processResults: function(data) {
                    datob = JSON.parse(data);
                    return {
                        results: $.map(datob, function(item) {
                            return {
                                text: item.unitName,
                                slug: item.unitName,
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
                url: '/getContractorEquipmentByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#idEquipment').val(datob[0].id);
                $('#EquipmentNameEdit').val(datob[0].EquipmentName);
                var newOption1 = new Option(datob[0].BussinessName, datob[0].BusinessPartnerID, true, true);
                $('#ContractorEdit').append(newOption1).trigger('change');
                var newOption2 = new Option(datob[0].unitName, datob[0].UnitID, true, true);
                $('#UnitidEdit').append(newOption2).trigger('change');
                $('#MobilizationEdit').val(datob[0].MobilizationDate);
                $('#DemobilizationEdit').val(datob[0].DemobilizationDate);

                $('#formmodaledit').modal('show');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
        });

        $('#btn-submit-edit').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/updateContractorEquipment',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $('#idEquipment').val(),
                    EquipmentName: $('#EquipmentNameEdit').val(),
                    BusinessPartnerID: $('#ContractorEdit').val(),
                    UnitID: $('#UnitidEdit').val(),
                    MobilizationDate: $('#MobilizationEdit').val(),
                    DemobilizationDate: $('#DemobilizationEdit').val()

                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Update', $('#idEquipment').val(), 'success');
                } else {
                    errorAlert('Update', $('#idEquipment').val(), 'error');
                }
                $('#formmodaledit').modal('toggle');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

        });


        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

        $('#contractor-list').on('change', function() {
            $('#example').DataTable().destroy();
            var table = $('#example').DataTable({
                lengthChange: false,
                //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
                buttons: [{
                    text: 'New',
                    className: 'btn-primary',
                    action: function(e, dt, button, config) {
                        $('#formmodal').modal();
                    }
                }],

                ajax: {
                    url: '/getContractorEquipment',
                    method: "POST",
                    dataSrc: "",
                    data: {
                        _token: "{{ csrf_token() }}",
                        contractorID: $('#contractor-list').val(),
                    }
                },
                columns: [{
                        data: "No"

                    },
                    {
                        data: "EquipmentName"
                    },
                    {
                        data: "BussinessName"
                    },
                    {
                        data: "unitName"
                    },
                    {
                        data: "MobilizationDate"
                    },
                    {
                        data: "DemobilizationDate"
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

    });
</script>
@endsection