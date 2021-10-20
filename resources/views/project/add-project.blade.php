@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Add New Project</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Add Project</div>
                <hr>
                <form>
                    <div class="form-group row">
                        <label for="input-21" class="col-sm-2 col-form-label">Project Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ProjectName" name="ProjectName" placeholder="Enter Your Project Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-22" class="col-sm-2 col-form-label">Project Description</label>
                        <div class="col-sm-10">
                            <textarea placeholder="Enter Your Project Description" class="form-control" id="ProjectDesc" name="ProjectDesc"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-23" class="col-sm-2 col-form-label">Project Owner</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="ProjectOwner" name="ProjectOwner">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-24" class="col-sm-2 col-form-label">Project Manager Owner</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="ProjectManagerOwner" name="ProjectManagerOwner">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-25" class="col-sm-2 col-form-label">Amount</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-2">
                                    <select class="form-control" id="CurrencyType" name="CurrencyType">
                                    
                                    </select>
                                </div>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="ContractAmount" name="ContractAmount" placeholder="Enter Project Amount">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div><!-- End Row-->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Consultant</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="consultant" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Consultant</th>
                                <th>Project Manager</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Contract Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyconsultan">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="formmodal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeInUp">
            <div class="modal-header">
                <h5 class="modal-title">ADD CONSULTANT</h5>
                <button type="button" id="btn_Consultant" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="input-21" class="col-sm-2 col-form-label">Contract Number</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="ContractNumberConsultant" name="ContractNumberConsultant" placeholder="Enter Your Business Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-21" class="col-sm-2 col-form-label">Consultant</label>
                        <div class="col-sm-10">
                            <select class="js-example-basic-single" style="width:100%" id="Consultant" name="Consultant">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-21" class="col-sm-2 col-form-label">Project Manager</label>
                        <div class="col-sm-10">
                            <select class="js-example-basic-single" style="width:100%" id="ProjectManagerConsultant" name="ProjectManagerConsultant">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-21" class="col-sm-2 col-form-label">Position</label>
                        <div class="col-sm-10">
                            <select class="js-example-basic-single" style="width:100%" id="PositionConsultant" name="PositionConsultant">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-22" class="col-sm-2 col-form-label">Scope Of Work</label>
                        <div class="col-sm-10">
                            <textarea placeholder="Enter Your Project Description" class="form-control" id="ScopeOfWorkConsultant" name="ScopeOfWorkConsultant"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-21" class="col-sm-2 col-form-label">Start</label>
                        <div class="col-sm-10">
                            <input type="Date" class="form-control" id="StartConsultant" name="StartConsultant" placeholder="Enter Your Start">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-21" class="col-sm-2 col-form-label">End</label>
                        <div class="col-sm-10">
                            <input type="Date" class="form-control" id="EndConsultant" name="EndConsultant" placeholder="Enter Your Address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-25" class="col-sm-2 col-form-label">Contract Amount</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-2">
                                    <select class="form-control" id="ContractCurrencyConsultant">
                                        
                                    </select>
                                </div>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="ContractAmountConsultant" name="ContractAmountConsultant" placeholder="Enter Project Amount">
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="form-group float-right">
                    <button class="btn btn-success px-5" type="button" id="btn_submit_consultant"><i class="fa fa-save"></i> Save</button>
                    <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Contractor</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="contractor" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Contractor</th>
                                <th>Project Manager</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Contract Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbodycontractor">
                            {{-- <tr>
                                <td>Tiger Nixon</td>
                                <td>Asep</td>
                                <td>10-10-2020</td>
                                <td>10-12-2020</td>
                                <td>IDR 2000000</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger  waves-effect waves-light m-1">DELETE</button>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row float-right">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body text-center">
                <button type="button" class="btn btn-primary  waves-effect waves-light m-1" id="btn-submit-add"><i class="fa fa-save"></i> Save Project</button>
                <button type="button" class="btn btn-danger  waves-effect waves-light m-1"><i class="fa fa-times"></i> Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ContractorForm">
    <div class="modal-dialog modal-lg">
        <div class="modal-content animated fadeInUp">
            <div class="modal-header">
                <h5 class="modal-title">ADD CONTRACTOR </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label for="input-21" class="col-sm-2 col-form-label">Contract Number</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="ContractNumberContractor" name="ContractNumberContractor" placeholder="Enter Your Contract Number">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-21" class="col-sm-2 col-form-label">Contractor</label>
                        <div class="col-sm-10">
                            <select class="js-example-basic-single" style="width:100%" id="Contractor" name="Contractor">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-21" class="col-sm-2 col-form-label">Project Manager</label>
                        <div class="col-sm-10">
                            <select class="js-example-basic-single" style="width:100%" id="ProjectManagerContractor" name="ProjectManagerContractor">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-21" class="col-sm-2 col-form-label">Position</label>
                        <div class="col-sm-10">
                            <select class="js-example-basic-single" style="width:100%" id="PositionContractor" name="PositionContractor">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-22" class="col-sm-2 col-form-label">Scope Of Work</label>
                        <div class="col-sm-10">
                            <textarea placeholder="Enter Your Scope Of Work" class="form-control" id="ScopeOfWorkContractor" name="ScopeOfWorkContractor"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-21" class="col-sm-2 col-form-label">Start</label>
                        <div class="col-sm-10">
                            <input type="Date" class="form-control" id="StartContractor" name="StartContractor" placeholder="Enter Your Start">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-21" class="col-sm-2 col-form-label">End</label>
                        <div class="col-sm-10">
                            <input type="Date" class="form-control" id="EndContractor" name="EndContractor" placeholder="Enter Your End">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-25" class="col-sm-2 col-form-label">Contract Amount</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-2">
                                    <select class="form-control" id="ContractCurrencyContractor">
                                        
                                    </select>
                                </div>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="ContractAmountContractor" name="ContractAmountContractor" placeholder="Enter Contract Amount">
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="form-group float-right">
                    <button class="btn btn-success px-5" type="button" id="btn_submit_contractor"><i class="fa fa-save"></i> Save</button>
                    <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>
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
        //$('#default-datatable').DataTable();


        var tableConsultant = $('#consultant').DataTable({
            lengthChange: false,
            buttons: [{
                text: '<i class="icon-plus"></i> Add Consultant',
                className: 'btn-primary1',
                action: function(e, dt, button, config) {
                    $('#formmodal').modal('toggle');
                }
            }]
        });

        $('#CurrencyType').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                url: '/getCurrency',
                data: "",
                processResults: function(data) {
                    datob = JSON.parse(data);
                    return {
                        results: $.map(datob, function(item) {
                            return {
                                text: item.CurrencyName,
                                slug: item.CurrencyName,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('#ContractCurrencyContractor').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                url: '/getCurrency',
                data: "",
                processResults: function(data) {
                    datob = JSON.parse(data);
                    return {
                        results: $.map(datob, function(item) {
                            return {
                                text: item.CurrencyName,
                                slug: item.CurrencyName,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('#ContractCurrencyConsultant').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                url: '/getCurrency',
                data: "",
                processResults: function(data) {
                    datob = JSON.parse(data);
                    return {
                        results: $.map(datob, function(item) {
                            return {
                                text: item.CurrencyName,
                                slug: item.CurrencyName,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('.btn-primary1').on('click', function() {
            // var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/getLastProjectnumber',
                
                data: {

                    _token: "{{ csrf_token() }}",
                    
                }
            }).done(function(msg) {
                console.log(msg);
              
                $('#ContractNumberConsultant').val(msg);
                
            });
        });
        
        var ArrayConsultant = [];
        var ArrayContractor = [];

        $('#btn-submit-add').click(function(e) {
            console.log("klik save")
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/InsertProject',
                data: {
                    _token: "{{ csrf_token() }}",
                    Consultant: JSON.stringify(ArrayConsultant),
                    Constructor: JSON.stringify(ArrayContractor),
                    ProjectName: $('#ProjectName').val(),
                    ProjectOwner: $('#ProjectOwner').val(),
                    ProjectDesc: $('#ProjectDesc').val(),
                    ProjectManager: $('#ProjectManagerOwner').val(),
                    ContractAmount: $('#ContractAmount').val(),
                    CurrencyType: $('#CurrencyType').val()

                },
                success: function(e) {
                    console.log(e)
                    
                    successAlert('Add', $('#ProjectName').val(), 'success');
                    setTimeout(function(){ window.location="/project" }, 3000);
                
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
                // $('#formmodal').modal('toggle');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

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
            $('#ProjectManagerConsultant').select2({
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

        $('#ProjectManagerConsultant').on('change', function() {
            $('#PositionConsultant').select2({
                //dropdownParent: $('#formmodalEdit'),
                ajax: {
                    type: 'POST',
                    url: '/getPositionbyPersonil',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('#ProjectManagerConsultant').val()
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


        $('#Contractor').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                type: 'GET',
                url: '/getPartnerBytype',
                data: {
                    types: 'Contractor'
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

        $('#Contractor').on('change', function() {
            $('#ProjectManagerContractor').select2({
                //dropdownParent: $('#formmodalEdit'),
                ajax: {
                    type: 'POST',
                    url: '/getHumanResourcesbypartner',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('#Contractor').val()
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

        $('#ProjectManagerContractor').on('change', function() {
            $('#PositionContractor').select2({
                //dropdownParent: $('#formmodalEdit'),
                ajax: {
                    type: 'POST',
                    url: '/getPositionbyPersonil',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('#ProjectManagerContractor').val()
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
        
        $('#ProjectOwner').select2({
                //dropdownParent: $('#formmodalEdit'),
                ajax: {
                    type: 'POST',
                    url: '/getProjectOwner',
                    data: {
                        _token: "{{ csrf_token() }}"
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

            $('#ProjectOwner').on('change', function() {
                $('#ProjectManagerOwner').select2({
                //dropdownParent: $('#formmodalEdit'),
                ajax: {
                    type: 'POST',
                    url: '/getProjectManagerOwner',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('#ProjectOwner').val()
                    },
                    processResults: function(data) {

                        datob = JSON.parse(data);
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



        $("#btn_submit_consultant").click(function() {
            let ContractNumberConsultant = $('#ContractNumberConsultant').val()
            let Consultant = $('#Consultant').val()
            let ConsultantText = $('#Consultant').text()
            let ProjectManagerConsultant = $('#ProjectManagerConsultant').text()
            let PositionConsultant = $('#PositionConsultant').val()
            let ScopeOfWorkConsultant = $('#ScopeOfWorkConsultant').val()
            let StartConsultant = $('#StartConsultant').val()
            let EndConsultant = $('#EndConsultant').val()
            let ContractAmountConsultant = $('#ContractAmountConsultant').val()

            ArrayConsultant.push(ContractNumberConsultant)
            ArrayConsultant.push(Consultant)
            ArrayConsultant.push(ProjectManagerConsultant)
            ArrayConsultant.push(PositionConsultant)
            ArrayConsultant.push(ScopeOfWorkConsultant)
            ArrayConsultant.push(StartConsultant)
            ArrayConsultant.push(EndConsultant)
            ArrayConsultant.push(ContractAmountConsultant)
            ArrayConsultant.push(ConsultantText)

            let row = `<tr>
                        <td>${ConsultantText}</td>
                        <td>${ProjectManagerConsultant}</td>
                        <td>${StartConsultant}</td>
                        <td>${EndConsultant}</td>
                        <td>${ContractAmountConsultant}</td>
                    </tr>`
            //$('#tbodyconsultan').append(row)
            var table = $('#consultant').DataTable();
            var action = "<button type='button' class='deleteConsultant btn btn-danger waves-effect waves-light '>Delete</button>"
            table.row.add([
                ConsultantText,
                ProjectManagerConsultant,
                StartConsultant,
                EndConsultant,
                ContractAmountConsultant,
                action
            ]).draw();
            $('#formmodal').modal('hide')
        })

        $('#consultant tbody').on("click", ".deleteConsultant", function() {
            console.log($(this).parent());
            table.row($(this).parents('tr')).remove().draw(false);
        });

        $("#btn_submit_contractor").click(function() {
            let ContractNumberContractor = $('#ContractNumberContractor').val()
            let Contractor = $('#Contractor').val()
            let ContractorText = $('#Contractor').text()
            let ProjectManagerContractor = $('#ProjectManagerContractor').text()
            let PositionContractor = $('#PositionContractor').val()
            let ScopeOfWorkContractor = $('#ScopeOfWorkContractor').val()
            let StartContractor = $('#StartContractor').val()
            let EndContractor = $('#EndContractor').val()
            let ContractAmountContractor = $('#ContractAmountContractor').val()

            ArrayContractor.push(ContractNumberContractor)
            ArrayContractor.push(Contractor)
            ArrayContractor.push(ProjectManagerContractor)
            ArrayContractor.push(PositionContractor)
            ArrayContractor.push(ScopeOfWorkContractor)
            ArrayContractor.push(StartContractor)
            ArrayContractor.push(EndContractor)
            ArrayContractor.push(ContractAmountContractor)


            let row = `<tr>
                        <td>${ContractorText}</td>
                        <td>${ProjectManagerContractor}</td>
                        <td>${StartContractor}</td>
                        <td>${EndContractor}</td>
                        <td>${ContractAmountContractor}</td>
                    </tr>`
            //$('#tbodycontractor').append(row)
            var table = $('#contractor').DataTable();
            var action = "<button type='button' class='deleteConsultant btn btn-danger waves-effect waves-light '>Delete</button>"
            table.row.add([
                ContractorText,
                ProjectManagerContractor,
                StartContractor,
                EndContractor,
                ContractAmountContractor,
                action
        ]).draw(false);

            $('#ContractorForm').modal('hide')
        })



        // $('#Consultant').on('change', function() {    
        // $.ajax({
        //             type: "POST",
        //             url: "/getHumanResourcesbypartner",
        //             dataType: "json",
        //             data: {
        //                 id: $('#Consultant').val()
        //             },
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             success: function (data) {
        //                 $.each(data, function(key, value){
        //                     console.log(value.PersonilName)
        //                     var newOption1 = new Option(value.PersonilName, value.BussinessPartnerID, true, true);
        //                     $('#ProjectManagerConsultant').append(newOption1);
        //                 })


        //               console.log(data)
        //             },
        //             error: function (data) {
        //                 console.log(data)
        //             }

        //         })
        // })

        // $('#ProjectManagerConsultant').select2({
        //     //dropdownParent: $('#formmodalEdit'),
        //     ajax: {
        //         url: '/getBusinessPartner',
        //         data: "",
        //         processResults: function(data) {
        //             datob = JSON.parse(data);
        //             return {
        //                 results: $.map(datob, function(item) {
        //                     return {
        //                         text: item.BussinessName,
        //                             slug: item.BussinessName,
        //                             id: item.id
        //                     }
        //                 })
        //             };
        //         }
        //     }
        // });



        var tableContractor = $('#contractor').DataTable({
            lengthChange: false,
            buttons: [{
                text: '<i class="icon-plus"></i> Add Contractor',
                className: 'btn-primary2',
                action: function(e, dt, button, config) {
                    $('#ContractorForm').modal('toggle');
                }
            }]
        });



        // $('#Position').select2({
        //     //dropdownParent: $('#formmodal'),
        //     ajax: {
        //         url: '/getPosition',
        //         data: function(params) {
        //             var queryParameters = {
        //                 term: params.term
        //             }
        //             return queryParameters;
        //         },
        //         error : function(e){
        //             console.log(e);

        //         },
        //         processResults: function(data) {
        //             datob = JSON.parse(data);
        //             return {
        //                 results: $.map(datob, function(item) {
        //                     return {
        //                         text: item.PositionName,
        //                         slug: item.PositionName,
        //                         id: item.id
        //                     }
        //                 })
        //             };
        //         }
        //     }
        // });





        tableConsultant.buttons().container()
            .appendTo('#consultant_wrapper .col-md-6:eq(0)');
        tableContractor.buttons().container()
            .appendTo('#contractor_wrapper .col-md-6:eq(0)');

    });
</script>
@endsection