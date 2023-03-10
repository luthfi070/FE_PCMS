@extends('app')
@section('content')
<div class="row">
<div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Edit Project </h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Edit Project</div>
                <hr>
                <form>
                    <input type="hidden" id="Projectid" class="form-control">
                    
                    <div class="form-group row">
                        <label for="input-21" class="col-sm-2 col-form-label">Project Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="ProjectNameEdit" name="ProjectNameEdit" placeholder="Enter Your Project Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-22" class="col-sm-2 col-form-label">Project Description</label>
                        <div class="col-sm-10">
                            <textarea placeholder="Enter Your Project Description" id="ProjectDescEdit" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-23" class="col-sm-2 col-form-label">Project Location</label>
                        <div class="col-sm-3">
                            <select class="form-control" id="regency" name="regency">
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" id="district" name="district">
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select class="form-control" id="village" name="village">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-23" class="col-sm-2 col-form-label">Project Owner</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="ProjectOwnerEdit" name="ProjectOwnerEdit">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-24" class="col-sm-2 col-form-label">Project Manager Owner</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="ProjectManagerOwnerEdit" name="ProjectManagerOwnerEdit">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-25" class="col-sm-2 col-form-label">Amount</label>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-2">
                                    <select class="form-control"id="CurrencyTypeEdit" >
                                        <option></option>
                                    </select>
                                </div>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="ContractAmountEdit" placeholder="Enter Project Amount">
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div><!-- End Row-->

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
                <form id="ForminsertConsultant">
                    <input type="hidden" id="ProjectidConsultant"  name="ProjectidConsultant" class="form-control">
                    
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
                        <tbody>
                            
                        </tbody > 
                    </table>
                </div>
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
                <form id="ForminsertContractor">
                    <input type="hidden" id="ProjectidContractor"  name="ProjectidContractor" class="form-control">
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
                        <tbody>
                            
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
                <button type="button" class="btn btn-primary  waves-effect waves-light m-1" id="btn-submit-edit"><i class="fa fa-save"></i> Save Project</button>
                <a href="/project" class="btn btn-danger  waves-effect waves-light m-1"><i class="fa fa-times"></i> Cancel</a>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        //location
    
        $('#regency').select2({
            placeholder: "Select Regency",
            ajax: {
                url: '/getRegency',
                data: "",
                processResults: function (data) {
                    datob = JSON.parse(data);
                    return {
                        results: $.map(datob, function (item) {
                            return {
                                text: item.name,
                                slug: item.name,
                                id: item.id,
                            }
                        })
                    };
                }
            }
        });
        $('#regency').on('change', function () {
            $('#district').select2({
                placeholder: "Select District",
                ajax: {
                    url: '/getDistrict/' + $('#regency').val(),
                    data: "",
                    processResults: function (data) {
                        datob = JSON.parse(data);
                        return {
                            results: $.map(datob, function (item) {
                                return {
                                    text: item.name,
                                    slug: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });
        $('#district').on('change', function () {
            $('#village').select2({
                placeholder: "Select Village",
                ajax: {
                    url: '/getVillage/' + $('#district').val(),
                    data: "",
                    processResults: function (data) {
                        datob = JSON.parse(data);
                        return {
                            results: $.map(datob, function (item) {
                                return {
                                    text: item.name,
                                    slug: item.name,
                                    id: item.id
                                }
                            })
                        };
                    }
                }
            });
        });
        
        
        var tableConsultant = $('#consultant').DataTable({

    

            lengthChange: false,
            dom: 'Bfrtip',
            buttons: [{
                text: '<i class="icon-plus"></i> Add Consultant',
                className: 'btn-primary',
                action: function(e, dt, button, config) {
                    $('#formmodal').modal('toggle');
                }
            }],
            

            ajax: {
                url: '/getprojectnumberByidproject',
                method: "POST",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                id:<?php echo $id ?>
                }
            },
            columns: [{
                
                    data: "BussinessName"
                },
                {
                    data: "PersonilName"
                },
                {
                    data: "StartDate"
                },
                {
                    data: "EndDate"
                },
                {
                    data: "TotalAmount"
                },
                {
                    data: "action"
                }

            ],
           

        });
                


        var tableContractor = $('#contractor').DataTable({
            lengthChange: false,
            dom: 'Bfrtip',
            buttons: [{
                text: '<i class="icon-plus"></i> Add Contractor',
                className: 'btn-primary2',
                action: function(e, dt, button, config) {
                    $('#ContractorForm').modal('toggle');
                }
            }],
            ajax: {
                url: '/getprojectnumberByidprojectContractor',
                method: "POST",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                   id:<?php echo $id ?>
                }
            },
            columns: [{
                   
                    data: "BussinessName"
                },
                {
                    data: "PersonilName"
                },
                {
                    data: "StartDate"
                },
                {
                    data: "EndDate"
                },
                {
                    data: "TotalAmount"
                },
                
                {
                    data: "action"
                }

            ],
           
        });

        $('#CurrencyTypeEdit').select2({
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

        var ArrayConsultant = [];
        var ArrayContractor = [];
    
        $.ajax({
            type: "POST",
            url: '/getProjectByid',
            data: {
                _token: "{{ csrf_token() }}",
                id: <?php echo $id ?>
            }
        }).done(function(msg) {
            
            datob = JSON.parse(msg);
            id=$('#Projectid').val(datob[0].ProjectID);

            $('#ProjectNameEdit').val(datob[0].ProjectName);
            $('#ProjectDescEdit').val(datob[0].ProjectDesc);
            var newOption1 = new Option(datob[0].BussinessName, datob[0].ProjectOwner, true, true);
            $('#ProjectOwnerEdit').append(newOption1).trigger('change');       
            var newOption2 = new Option(datob[0].PersonilName, datob[0].ProjectManager, true, true);
            $('#ProjectManagerOwnerEdit').append(newOption2).trigger('change');
            var newOption3 = new Option(datob[0].CurrencyName, datob[0].Currenctype, true, true);
            $('#CurrencyTypeEdit').append(newOption3).trigger('change');
            $('#ContractAmountEdit').val(datob[0].ContractAmount);

            // var newOption4 = new Option(datob[0].village_id.substring(0,4), datob[0].village_id.substring(0,4), true, true);
            // $('#regency').append(newOption4).trigger('change');
            $.ajax({
                type: "GET",
                url: '/getDataLocation/'+datob[0].village_id,
                data: ''
            }).done(function(data){
                data = JSON.parse(data);
                console.log(data);
                var regency = new Option(data.district.regency.name, data.district.regency.id, true, true);
                $('#regency').append(regency).trigger('change');
                var district = new Option(data.district.name, data.district.id, true, true);
                $('#district').append(district).trigger('change');
                var village = new Option(data.name, data.id, true, true);
                $('#village').append(village).trigger('change');
            });
            // $('#regency').val(datob[0].village_id.substring(0,4)).trigger('change');
            // $('#formmodaledit').window.location('/editproject');
            
        });

        $('.btn-primary').on('click', function() {
            // var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/getLastProjectnumber',
                
                data: {

                    _token: "{{ csrf_token() }}",
                    
                }
            }).done(function(msg) {
                
                datob = JSON.parse(msg);
                id=$('#ContractNumberConsultant').val(msg);
                
            });

            $.ajax({
                type: "POST",
                url: '/ProjectIDContractor',
                
                data: {

                    _token: "{{ csrf_token() }}",
                    id: <?php echo $id ?>
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                id=$('#ProjectidConsultant').val(<?php echo $id ?>); 
            });
        });


        $('.btn-primary2').on('click', function() {
            // var id = $(this).data("id");
           
            $.ajax({
                type: "POST",
                url: '/getLastProjectnumber',
                
                data: {

                    _token: "{{ csrf_token() }}",
                    
                }
            }).done(function(msg) {
                console.log(<?php echo $id ?>)
                datob = JSON.parse(msg);
                id=$('#ContractNumberContractor').val(msg);
                
            });

            $.ajax({
                type: "POST",
                url: '/ProjectIDContractor',
                
                data: {

                    _token: "{{ csrf_token() }}",
                    id: <?php echo $id ?>
                }
            }).done(function(msg) {
                
                datob = JSON.parse(msg);
                $('#ProjectidContractor').val(<?php echo $id ?>);
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


        $('#ProjectOwnerEdit').select2({
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

        $('#ProjectOwnerEdit').on('change', function() {
            $('#ProjectManagerOwnerEdit').select2({
                //dropdownParent: $('#formmodalEdit'),
                ajax: {
                    type: 'POST',
                    url: '/getProjectManagerOwner',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $('#ProjectOwnerEdit').val()
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

        $('#btn_submit_consultant').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/addProjectNumber',
                data: $('#ForminsertConsultant').serialize() + "&_token="+ '{{ csrf_token() }}'
                // id:idproject
                   
            }).done(function(msg) {
                datob = JSON.parse(msg);
                //  id=$('#ProjectidConsultant').val(datob[0].id);
                
                $('#consultant').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Add', $('#ContractNumberConsultant').val(), 'success');
                    $('#ForminsertConsultant')[0].reset();
                    $('#ProjectidConsultant').val();
                   
                    $('#Consultant').val('');
                    $('#ProjectManagerConsultant').val('');
                    $('#PositionConsultant').val('');
                    $('#ScopeOfWorkConsultant').val('');
                    $('#StartConsultant').val('');
                    $('#EndConsultant').val('');
                    $('#ContractCurrencyConsultant').val('');
                    $('#ContractAmountConsultant').val('');
                } else {
                    errorAlert('Add', $('#ContractNumberConsultant').val(), 'error');
                    $('#ForminsertConsultant')[0].reset();
                    $('#Consultant').val('');
                    $('#ProjectidConsultant').val();
                    $('#ProjectManagerConsultant').val('');
                    $('#PositionConsultant').val('');
                    $('#ScopeOfWorkConsultant').val('');
                    $('#StartConsultant').val('');
                    $('#EndConsultant').val('');
                    $('#ContractCurrencyConsultant').val('');
                    $('#ContractAmountConsultant').val('');
                }
                $('#formmodal').modal('toggle');
            });

        });

        $('#btn_submit_contractor').click(function(e) {
            e.preventDefault;
            
           

            $.ajax({
                type: "POST",
                url: '/addProjectNumberContractor',
                data: $('#ForminsertContractor').serialize() + "&_token="+ '{{ csrf_token() }}'
                // id:idproject
                   
            }).done(function(msg) {
                datob = JSON.parse(msg);
                //  id=$('#ProjectidConsultant').val(datob[0].id);
                
                $('#contractor').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Add', $('#ContractNumberConsultant').val(), 'success');
                    $('#ForminsertContractor')[0].reset();
                    $('#ProjectidContractor').val();
                   
                    $('#Contractor').val('');
                    $('#ProjectManagerContractor').val('');
                    $('#PositionContractor').val('');
                    $('#ScopeOfWorkContractor').val('');
                    $('#StartContractor').val('');
                    $('#EndContractor').val('');
                    $('#ContractCurrencyContractor').val('');
                    $('#ContractAmountContractor').val('');
                } else {
                    errorAlert('Add', $('#ContractNumberContractor').val(), 'error');
                    $('#ForminsertContractor')[0].reset();
                    $('#ProjectidContractor').val();
                   
                    $('#Contractor').val('');
                    $('#ProjectManagerContractor').val('');
                    $('#PositionContractor').val('');
                    $('#ScopeOfWorkContractor').val('');
                    $('#StartContractor').val('');
                    $('#EndContractor').val('');
                    $('#ContractCurrencyContractor').val('');
                    $('#ContractAmountContractor').val('');
                }
                $('#ContractorForm').modal('toggle');
            });

        });

        $('#contractor').on('click', '.deleteContractor', function(e){
            if(confirm('Are you sure you want to delete this Contractor? This action cannot be undone.')){
                $.ajax({
                    type: "POST",
                    url: '/deleteProjectNumber',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $(this).attr('data-ids')
                    }
                }).done(function(msg) {
                    datob = JSON.parse(msg);
                    if (datob != 'error') {
                        successAlert('Delete', 'Contractor', 'success');
                        $('#contractor').DataTable().ajax.reload();
                    } else {
                        errorAlert('Delete', 'Contractor', 'error');
                    }
                });
            }
        });

        $('#consultant').on('click', '.deleteConsultant', function(e){
            if(confirm('Are you sure you want to delete this Consultant? This action cannot be undone.')){
                $.ajax({
                    type: "POST",
                    url: '/deleteProjectNumber',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: $(this).attr('data-ids')
                    }
                }).done(function(msg) {
                    datob = JSON.parse(msg);
                    if (datob != 'error') {
                        successAlert('Delete', 'Consultant', 'success');
                        $('#consultant').DataTable().ajax.reload();
                    } else {
                        errorAlert('Delete', 'Consultant', 'error');
                    }
                });
            }
        });

        
        $('#btn-submit-edit').click(function(e) {
            console.log("klik save")
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/updateProject',
                data: {

                    _token: "{{ csrf_token() }}",
                    // Consultant: JSON.stringify(ArrayConsultant),
                    // Constructor: JSON.stringify(ArrayContractor),
                    id: $('#Projectid').val(),
                    ProjectName: $('#ProjectNameEdit').val(),
                    ProjectOwner: $('#ProjectOwnerEdit').val(),
                    ProjectDesc: $('#ProjectDescEdit').val(),
                    ProjectManager: $('#ProjectManagerOwnerEdit').val(),
                    ContractAmount: $('#ContractAmountEdit').val(),
                    CurrencyType: $('#CurrencyTypeEdit').val(),
                    village_id: $('#village').val(),

                },
                success: function(e) {
                    console.log(e)
                    
                    successAlert('Add', $('#ProjectNameEdit').val(), 'success');
                    setTimeout(function(){ window.location="/project" }, 3000);
                
                },
                error: function(e) {
                    console.log(e)
                },
            }).done(function(msg) {
                // datob = JSON.parse(msg);
                console.log("save" + msg)
            });

        });
      
        $('#default-datatable').DataTable();



        tableConsultant.buttons().container()
            .appendTo('#consultant_wrapper .col-md-6:eq(0)');
        tableContractor.buttons().container()
            .appendTo('#contractor_wrapper .col-md-6:eq(0)');

    });
</script>
@endsection