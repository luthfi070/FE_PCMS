@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Mobilization Consultant</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Consultant List</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>SCHEDULED</th>
                                <th>CURRENT MANMONTH</th>
                                <th>COMPANY</th>
                                <th>NAME</th>
                                <th>POSITION CATEGORY</th>
                                <th>POSITION</th>
                                <th>START DATE</th>
                                <th>END DATE</th>
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
                    <h5 class="modal-title">Add Man Month</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="input-22" class="col-sm-2 col-form-label">COMPANY</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="width:100%" id="Consultant">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">PERSONEL NAME</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="width:100%" id="PersonelName">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">POSITION CATEGORY</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="width:100%" id="PositionCat">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">POSITION</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="width:100%" id="Position">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="input-21" class="col-sm-2 col-form-label">MOBILIZATION DATE</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="StartMobilDate">
                            </div>

                            <label for="input-21" class="col-sm-2 col-form-label">TO</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="EndMobilDate">
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <button type="button" class="btn btn-success px-5" id="buton_MobilDate"><i class="fa fa-plus"></i> Add</button>
                        </div>
                        <div class="table-responsive">
                            <table id="exampleAdd" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>START DATE</th>
                                        <th>END DATE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody id="tbodyMobilDate">


                                </tbody>
                            </table>
                        </div>
                        <div class="form-group float-right">

                            <button type="button" class="btn btn-success px-5" id="btn-submit-add"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>

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
                    <h5 class="modal-title">Edit Man Month</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="idMobilDate" class="form-control">
                        <div class="form-group row">
                            <label for="input-22" class="col-sm-2 col-form-label">COMPANY</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="width:100%" id="ConsultantEdit">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">PERSONEL NAME</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="width:100%" id="PersonelNameEdit">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">POSITION CATEGORY</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="width:100%" id="PositionCatEdit">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">POSITION</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="width:100%" id="PositionEdit">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="input-21" class="col-sm-2 col-form-label">MOBILIZATION DATE</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="StartMobilDateEdit">
                            </div>

                            <label for="input-21" class="col-sm-2 col-form-label">TO</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="EndMobilDateEdit">
                            </div>
                        </div>
                        <div class="form-group float-right">
                            <button type="submit" class="btn btn-success px-5"><i class="fa fa-plus"></i> Add</button>
                        </div>
                        <div class="table-responsive">
                            <table id="exampleEdit" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>START DATE</th>
                                        <th>END DATE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="form-group float-right">

                            <button type="submit" class="btn btn-success px-5" id="btn-submit-Edit"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>

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
                url: '/getMobilizationDate',
                method: "GET",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                }
            },
            columns: [{
                    data: "No"

                },
                {
                    data: "CurrentManMonth"
                },
                {
                    data: "Schedule"
                },
                {
                    data: "BussinessName"
                },
                {
                    data: "PersonilName"
                },
                {
                    data: "CategoryName"
                },

                {
                    data: "PositionName"
                },
                {
                    data: "StarDateMobilization"
                },

                {
                    data: "EndDateMobilization"
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

        $('#Consultant').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                type: 'GET',
                url: '/getPartnerBytype',
                data: {
                    types: 'Consultant'
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

        $('#Consultant').on('change', function() {
            $('#PersonelName').select2({
                //dropdownParent: $('#formmodalEdit'),
                ajax: {
                    type: 'POST',
                    url: '/getHumanResourcesbypartner',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('#Consultant').val()
                    },
                    processResults: function(data) {

                        datob = JSON.parse(data);
                        console.log(datob)
                        return {
                            results: $.map(datob, function(item) {
                                return {
                                    text: item.PersonilName,
                                    slug: item.PersonilName,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });



        $('#PersonelName').on('change', function() {
            $('#PositionCat').select2({
                //dropdownParent: $('#formmodalEdit'),
                ajax: {
                    type: 'POST',
                    url: '/getMobilizationPositionCategory',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('#PersonelName').val()
                    },
                    processResults: function(data) {

                        datob = JSON.parse(data);
                        console.log(datob)
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

        $('#PositionCat').on('change', function() {
            $('#Position').select2({
                //dropdownParent: $('#formmodalEdit'),
                ajax: {
                    type: 'POST',
                    url: '/getMobilizationPosition',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('#PositionCat').val()
                    },
                    processResults: function(data) {

                        datob = JSON.parse(data);
                        console.log("posisi")
                        console.log(datob)
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

        var ArrayMobilDate = [];


        $("#buton_MobilDate").click(function() {

            let StartMobilDate = $('#StartMobilDate').val()
            let EndMobilDate = $('#EndMobilDate').val()

            ArrayMobilDate.push(StartMobilDate)
            ArrayMobilDate.push(EndMobilDate)


            let row = `<tr>     
                       
                        <td>${StartMobilDate}</td>
                        <td>${EndMobilDate}</td>
                      
                    </tr>`
            $('#tbodyMobilDate').append(row)

        })


        $('#btn-submit-add').click(function(e) {
            console.log("klik save")
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/InsertMobilizationDate',
                data: {
                    _token: "{{ csrf_token() }}",
                    MobilDate: JSON.stringify(ArrayMobilDate),
                    BusinessPartnerID: $('#Consultant').val(),
                    PersonilID: $('#PersonelName').val(),
                    PositionCatID: $('#PositionCat').val(),
                    PositionID: $('#Position').val(),


                },
                success: function(e) {
                    console.log(e)
                },
                error: function(e) {
                    console.log(e)
                },
            }).done(function(msg) {
                // datob = JSON.parse(msg);
                console.log("save" + msg)
                // $('#example').DataTable().ajax.reload();
                // if (datob != 'error') {
                //     successAlert('Add', $('#ProjectName').val(), 'success');
                //     $('#ProjectName').val('');
                //     $('#ProjectOwner').val('');
                //     $('#ProjectDesc').val('');
                //     $('#ProjectManagerOwner').val('');
                //     $('#ContractAmount').val('');
                //     $('#CurrencyType').val('');

                // } else {
                //     errorAlert('Add', $('#ProjectName').val(), 'error');
                //     $('#ProjectName').val('');
                //     $('#ProjectOwner').val('');
                //     $('#ProjectDesc').val('');
                //     $('#ProjectManagerOwner').val('');
                //     $('#ContractAmount').val('');
                //     $('#CurrencyType').val('');
                // }
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
                            url: '/DeleteMobilizationDate',
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

        $('#example tbody').on('click', '.edit-btn', function() {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/getMobilizationDateByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#idMobilDate').val(datob[0].id);

                var newOption1 = new Option(datob[0].BussinessName, datob[0].BusinessPartnerID, true, true);
                $('#ConsultantEdit').append(newOption1).trigger('change');
                var newOption2 = new Option(datob[0].PersonilName, datob[0].PersonilID, true, true);
                $('#PersonelNameEdit').append(newOption2).trigger('change');
                var newOption3 = new Option(datob[0].CategoryName, datob[0].PositionCatID, true, true);
                $('#PositionCatEdit').append(newOption3).trigger('change');
                var newOption4 = new Option(datob[0].PositionName, datob[0].PositionID, true, true);
                $('#PositionEdit').append(newOption4).trigger('change');
                $('#StartMobilDateEdit').val(datob[0].StarDateMobilization);
                $('#EndMobilDateEdit').val(datob[0].EndDateMobilization);

                $('#formmodaledit').modal('show');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
        });

        $('#btn-submit-edit').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/updateMobilizationDate',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $('#idMobilDate').val(),
                    BusinessPartnerID: $('#ConsultantEdit').val(),
                    PersonilID: $('#PersonelNameEdit').val(),
                    PositionCatID: $('#PositionCatEdit').val(),
                    PositionID: $('#PositionEdit').val(),
                    StarDateMobilization: $('#StartMobilDateEdit').val(),
                    EndDateMobilization: $('#EndMobilDateEdit').val()

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

        $('#ConsultantEdit').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                type: 'GET',
                url: '/getPartnerBytype',
                data: {
                    types: 'Consultant'
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

        $('#ConsultantEdit').on('change', function() {
            $('#PersonelNameEdit').select2({
                //dropdownParent: $('#formmodalEdit'),
                ajax: {
                    type: 'POST',
                    url: '/getHumanResourcesbypartner',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('#ConsultantEdit').val()
                    },
                    processResults: function(data) {

                        datob = JSON.parse(data);
                        console.log(datob)
                        return {
                            results: $.map(datob, function(item) {
                                return {
                                    text: item.PersonilName,
                                    slug: item.PersonilName,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });



        $('#PersonelNameEdit').on('change', function() {
            $('#PositionCatEdit').select2({
                //dropdownParent: $('#formmodalEdit'),
                ajax: {
                    type: 'POST',
                    url: '/getMobilizationDateByBusinessPartner',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('#PersonelNameEdit').val()
                    },
                    processResults: function(data) {

                        datob = JSON.parse(data);
                        console.log(datob)
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

        $('#PositionCatEdit').on('change', function() {
            $('#PositionEdit').select2({
                //dropdownParent: $('#formmodalEdit'),
                ajax: {
                    type: 'POST',
                    url: '/getPositionbyPersonil',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('#PersonelNameEdit').val()
                    },
                    processResults: function(data) {

                        datob = JSON.parse(data);
                        console.log("posisi")
                        console.log(datob)
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



        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

        // var tableAdd = $('#exampleAdd').DataTable({
        //     lengthChange: false,
        //     //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        //     buttons: [{
        //         text: 'New',
        //         className: 'btn-primary',
        //         action: function(e, dt, button, config) {
        //             $('#formmodal').modal();
        //         }
        //     }]
        // });

        // tableAdd.buttons().container()
        //     .appendTo('#exampleAdd_wrapper .col-md-6:eq(0)');

        //     var tableEdit = $('#exampleEdit').DataTable({
        //     lengthChange: false,
        //     //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        //     buttons: [{
        //         text: 'New',
        //         className: 'btn-primary',
        //         action: function(e, dt, button, config) {
        //             $('#formmodaledit').modal();
        //         }
        //     }]
        // });

        // tableEdit.buttons().container()
        //     .appendTo('#exampleEdit_wrapper .col-md-6:eq(0)');

    });
</script>
@endsection