@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Risk Management</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Risk List</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>RISK</th>
                                <th>RANK</th>
                                <th>ASSIGN TO</th>
                                <th>DUE DATE</th>
                                <th>MITIGATION</th>
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
                    <h5 class="modal-title">ADD RISK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        {{-- <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">Nama Project</label>
                            <div class="col-sm-10">
                                <select class="js-example-basic-single" style="width:100%" id="ProjectName" name="ProjectName">
                                    <option></option>
                                </select>
                            </div>
                        </div> --}}
                    <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DESCRIPTION</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" id="Description" placeholder="Enter Your Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">RANK</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="Rank">
                                    <option>High</option>
                                    <option>Medium</option>
                                    <option>Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ASSIGN TO</label>
                            <div class="col-sm-10">
                                <select class="form-control"  style="width:100%" id="AssignTo">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DUE DATE</label>
                            <div class="col-sm-10">
                            <input type="date" class="form-control" id="DueDate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">MITIGATION</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" id="Mitigation" placeholder="Enter Your Mitigation"></textarea>
                            </div>
                        </div>
                        <div class="form-group float-right">

                            <button type="submit" class="btn btn-success px-5" id="btn-submit-add"><i class="fa fa-save"></i> Save</button>
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
                    <h5 class="modal-title">EDIT RISK</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <input type="hidden" id="idRisk" class="form-control">
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">Nama Project</label>
                            <div class="col-sm-10">
                                <select class="js-example-basic-single" style="width:100%" id="ProjectNameEdit" name="ProjectName">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DESCRIPTION</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" id="DescriptionEdit" placeholder="Enter Your Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">RANK</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="RankEdit">
                                    <option>High</option>
                                    <option>Medium</option>
                                    <option>Low</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ASSIGN TO Modal</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="width:100%" id="AssignToEdit">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DUE DATE</label>
                            <div class="col-sm-10">
                            <input type="date" class="form-control" id="DueDateEdit">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">MITIGATION</label>
                            <div class="col-sm-10">
                            <textarea class="form-control" id="MitigationEdit" placeholder="Enter Your Mitigation"></textarea>
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
                url: '/getRiskManagement',
                method: "GET",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                }
            },
            columns: [{
                    data:"No"

                },
                {
                    data: "DescriptionRisk"
                },
                {
                    data: "Rank"
                },
                {
                    data: "PersonilName"
                },
                {
                    data:"DueDateRisk"
                },
                {
                    data:"Mitigation"
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

        $('#ProjectName').select2({
        //dropdownParent: $('#formmodalEdit'),
        ajax: {
            url: '/getProject',
            data: "",
            processResults: function(data) {
                datob = JSON.parse(data);
                return {
                    results: $.map(datob, function(item) {
                        return {
                            text: item.ProjectName,
                                slug: item.ProjectName,
                                id: item.ProjectID
                        }
                    })
                };
            }
        }
    });

    $('#AssignTo').select2({
        //dropdownParent: $('#formmodalEdit'),
        ajax: {
            url: '/getHumanResourcesbypartnerProject',
            data: "",
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

    $('#btn-submit-add').click(function(e) {
            e.preventDefault;
            
            $.ajax({
                type: "POST",
                url: '/InsertRiskManagement',
                data: {
                    _token: "{{ csrf_token() }}",
                    DescriptionRisk: $('#Description').val(),
                    // ProjectID: $('#ProjectName').val(),
                    PersonilID: $('#AssignTo').val(),
                    Rank: $('#Rank').val(),
                    DueDateRisk: $('#DueDate').val(),
                    Mitigation: $('#Mitigation').val()
                   
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Add', $('#Description').val(), 'success');
                    $('#Description').val('');
                    $('#ProjectName').val('');
                    $('#AssignTo').val('');
                    $('#Rank').val('');
                    $('#DueDate').val('');
                    $('#Mitigation').val('');
                   
                } else {
                    errorAlert('Add', $('#Description').val(), 'error');
                    $('#Description').val('');
                    $('#ProjectName').val('');
                    $('#AssignTo').val('');
                    $('#Rank').val('');
                    $('#DueDate').val('');
                    $('#Mitigation').val('');
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
                            url: '/DeleteRiskManagement',
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

        $('#ProjectNameEdit').select2({
        //dropdownParent: $('#formmodalEdit'),
        ajax: {
            url: '/getProject',
            data: "",
            processResults: function(data) {
                datob = JSON.parse(data);
                return {
                    results: $.map(datob, function(item) {
                        return {
                            text: item.ProjectName,
                                slug: item.ProjectName,
                                id: item.ProjectID
                        }
                    })
                };
            }
        }
    });

    $('#AssignToEdit').select2({
        //dropdownParent: $('#formmodalEdit'),
        ajax: {
            url: '/getHumanResourcesbypartnerProject',
            data: "",
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

        $('#example tbody').on('click', '.edit-btn', function() {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/getRiskManagementByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#idRisk').val(datob[0].id);
                var newOption1 = new Option(datob[0].ProjectName, datob[0].ProjectID, true, true);
                $('#ProjectNameEdit').append(newOption1).trigger('change');
                $('#DescriptionEdit').val(datob[0].DescriptionRisk);
                var newOption2 = new Option(datob[0].Rank, datob[0].Rank, true, true);
                $('#RankEdit').append(newOption2).trigger('change');
                var newOption3 = new Option(datob[0].PersonilName, datob[0].PersonilID, true, true);
                $('#AssignToEdit').append(newOption3).trigger('change');
                $('#DueDateEdit').val(datob[0].DueDateRisk);
                $('#MitigationEdit').val(datob[0].Mitigation);
              
                $('#formmodaledit').modal('show');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
        });

        $('#btn-submit-edit').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/updateRiskManagement',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $('#idRisk').val(),
                    DescriptionRisk: $('#DescriptionEdit').val(),
                    ProjectID: $('#ProjectNameEdit').val(),
                    PersonilID: $('#AssignToEdit').val(),
                    Rank: $('#RankEdit').val(),
                    DueDateRisk: $('#DueDateEdit').val(),
                    Mitigation: $('#MitigationEdit').val()
                    
                },
                error: function (e){
                    console.log(e)
                },
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Update', $('#idRisk').val(), 'success');
                } else {
                    errorAlert('Update', $('#idRisk').val(), 'error');
                }
                $('#formmodaledit').modal('toggle');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

        });

        

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });
</script>
@endsection