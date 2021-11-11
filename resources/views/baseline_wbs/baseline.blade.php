@extends('app')
@section('content')
<style>
    tr.odd td:first-child,
    tr.even td:first-child {
        padding-left: 4em;
    }
</style>
<div class="row">
    <!-- <div class="col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                <button type="button" class="btn btn-primary  waves-effect waves-light m-1">New</button>
                <button type="button" class="btn btn-secondary  waves-effect waves-light m-1">Print</button>
                <button type="button" class="btn btn-white  waves-effect waves-light m-1">Generate Pre WBS File</button>
            </div>
        </div>
    </div> -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center"> Baseline Work Breakdown Structure</h4>
            </div>
        </div>
    </div>
    @include('contractor-list')
    <div class="col-lg-12" id="card-table">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> List Bill of Quantity</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>INDEX</th>
                                <th>ID</th>
                                <th>PARENTITEM</th>
                                <th>CHILD</th>
                                <th>ITEM</th>
                                <th>UNIT</th>
                                <th>DURATION</th>
                                <th>START DATE</th>
                                <th>FINISH DATE</th>
                                <th>QTY</th>
                                <th>CURRENCY</th>
                                <th>UNIT PRICES</th>
                                <th>COST</th>
                                <th>WEIGHT (%)</th>
                                <th>CREATED BY</th>
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
    <div class="col-lg-12" id="card-scurve">
        <div class="card-body">
            <button class="btn btn-warning" id="btn-back-scurve"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-chart"></i> S-Curve</div>
                <div class="card-body" style="height:100%">
                    <div id="bar-chart"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formemodal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_parent">NEW PARENT RECORD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addParent">
                        <input type="hidden" class="form-control" id="parentIDMain" name="parentIDMain">
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">LEVEL</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="parentLevel" name="parentLevel">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-22" class="col-sm-2 col-form-label">ITEM</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="parentItem" name="parentItem" placeholder="Enter Your Item Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">UNIT ITEM</label>
                            <div class="col-sm-10">
                                <select class="js-example-basic-single" style="width:100%" id="unitType" name="unitType" disabled>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">QTY</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="parentQty" name="parentQty" placeholder="Enter Your Item Quantity" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-25" class="col-sm-2 col-form-label">UNIT PRICES</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select class="js-example-basic-single" style="width:100%" id="currencyType" name="currencyType" disabled>

                                        </select>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="parentAmount" name="parentAmount" placeholder="Enter Project Amount" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">

                        <button type="submit" class="btn btn-success px-5" id="btn-add-parent"><i class="fa fa-save"></i> Save</button>
                        <button type="submit" class="btn btn-success px-5" id="btn-edit-parent"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="formemodalchild">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title" id="title_child">NEW CHILD RECORD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addChild">
                        <input type="hidden" class="form-control" id="parentID" name="parentID">
                        <input type="hidden" class="form-control" id="parentLvl" name="parentLvl">
                        <input type="hidden" class="form-control" id="childID" name="childID">
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">LEVEL</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="childLevel" name="childLevel">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-22" class="col-sm-2 col-form-label">ITEM</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="childItem" name="childItem" placeholder="Enter Your Item Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">UNIT ITEM</label>
                            <div class="col-sm-10">
                                <select class="js-example-basic-single" style="width:100%" id="unitTypechild" name="unitTypechild">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">QTY</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="childQty" name="childQty" placeholder="Enter Your Item Quantity">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-25" class="col-sm-2 col-form-label">UNIT PRICES</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select class="js-example-basic-single" style="width:100%" id="currencyTypechild" name="currencyTypechild">
                                        </select>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="childAmount" name="childAmount" placeholder="Enter Project Amount">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">

                        <button type="submit" class="btn btn-success px-5" id="btn-add-child"><i class="fa fa-save"></i> Save</button>
                        <button type="submit" class="btn btn-success px-5" id="btn-edit-child"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var xBody = "";

    function format(d) {
        // `d` is the original data object for the row
        var xHead = '<table id="childExample" cellpadding="5" cellspacing="0" border="0" style="width:100%;padding-left:50px;">';
        var xFoot = '</table>';
        xBody = "";

        $.ajax({
            type: "POST",
            url: '/getWbschild',
            data: {
                _token: "{{ csrf_token() }}",
                idParent: d.id
            },
            async: false
        }).done(function(data) {
            datob = JSON.parse(data);
            if (datob.length > 0) {
                for (var i = 0; i < datob.length; i++) {
                    xBody += '<tr><td>' + d.merge + '.' + datob[i].no + '</td>' +
                        '<td>' + datob[i].itemName + '</td>' +
                        '<td>' + datob[i].UnitName + '</td>' +
                        '<td>' + datob[i].qty + '</td>' +
                        '<td>' + datob[i].currencyName + '</td>' +
                        '<td>' + datob[i].price + '</td>' +
                        '<td>' + datob[i].cost + '</td>' +
                        '<td>' + datob[i].weight + '</td>' +
                        '<td>' + datob[i].action + '</td></tr>';
                }
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
            errorAlertServer('Response Not Found, Please Check Your Data');
        });
        return xHead + '' + xBody + '' + xFoot;
    }


    $(document).ready(function() {
        $("#card-scurve").hide();
        //Default data table
        $('#default-datatable').DataTable();

        var table = $('#example').DataTable({
            lengthChange: false,
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            dom: 'Bfrtip',
            buttons: [{
                    text: 'New',
                    className: 'btn-primary',
                    action: function(e, dt, button, config) {
                        // $('#btn-edit-parent').css({
                        //     'display': 'none'
                        // });
                        // $('#title_parent').html('NEW PARENT RECORD');
                        // $('#parentIDMain').val();
                        // $('#currencyTypechild').val('').trigger('change');
                        // $('#unitTypechild').val('').trigger('change');
                        // $('#addParent')[0].reset();
                        // $('#formemodal').modal();

                        swal({
                            title: "Warning",
                            text: "Choose Contractor From List!",
                            icon: "warning",
                            // buttons: true,
                            dangerMode: true,
                        })
                    }
                }, {
                    extend: 'print'
                },
                {
                    text: 'Import WBS Source',
                    className: 'btn-secondary'
                },
                {
                    text: 'Gantt Chart',
                    className: 'btn-secondary',
                    action: function(e, dt, button, config) {
                        //window.open('/baseline-gantt/' + $('#contractor-list').val());
                        swal({
                            title: "Warning",
                            text: "Choose Contractor From List!",
                            icon: "warning",
                            // buttons: true,
                            dangerMode: true,
                        })
                    }
                },
                {
                    text: 'S-curve',
                    className: 'btn-secondary',
                    action: function(e, dt, button, config) {
                        // $("#card-scurve").show();
                        // $("#card-table").hide();
                        swal({
                            title: "Warning",
                            text: "Choose Contractor From List!",
                            icon: "warning",
                            // buttons: true,
                            dangerMode: true,
                        })
                    }
                }
            ],
            ajax: {
                url: '/getWbs',
                method: "POST",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                    contractorID: 0,
                }
            },

            rowGroup: {
                dataSrc: [2, 3]
            },
            order: [
                [0, "asc"]
            ],
            columnDefs: [{
                targets: [1, 2, 3, 4],
                visible: false
            }],
            ordering: false,
            lengthMenu: [
                [-1],
                ["All"]
            ],
            columns: [{
                    "className": 'details-control',
                    data: "merge"
                }, {
                    "className": 'details-control',
                    data: "no"
                },
                {
                    "className": 'details-control',
                    data: "id"
                },
                {
                    "className": 'details-control',
                    data: "parentItem"
                },
                {
                    "className": 'details-control',
                    data: "hasChild"
                },
                {
                    "className": 'details-control',
                    data: "itemName"
                },
                {
                    "className": 'details-control',
                    data: "UnitName"
                },
                {
                    "className": 'details-control',
                    data: "duration"
                },
                {
                    "className": 'details-control',
                    data: "startDates"
                },
                {
                    "className": 'details-control',
                    data: "endDates"
                },
                {
                    "className": 'details-control',
                    data: "qty"
                },
                {
                    "className": 'details-control',
                    data: "currencyName"
                },
                {
                    "className": 'details-control',
                    data: "price"
                },
                {
                    "className": 'details-control',
                    data: "cost"
                },
                {
                    "className": 'details-control',
                    data: "weight"
                },
                {
                    "className": 'details-control',
                    data: "Userfullname"
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

        // $('#example tbody').on('click', 'td.details-control', function() {
        //     var tr = $(this).closest('tr');
        //     var row = table.row(tr);

        //     if (row.child.isShown()) {
        //         // This row is already open - close it
        //         row.child.hide();
        //         tr.removeClass('shown');
        //     } else {
        //         // Open this row
        //         row.child(format(row.data())).show();
        //         var tr = $(this).closest('tr');
        //         tr.addClass('shown');
        //     }
        // });

        $('#currencyType').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                type: 'GET',
                url: '/getCurrency',
                data: {
                    _token: "{{ csrf_token() }}"
                },
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

        $('#example tbody').on('click', '.btn-form-child', function() {
            $('#title_child').html('NEW CHILD RECORD');
            var id = $(this).data("id");
            lvl = $(this).attr('data-lvl');

            $.ajax({
                type: "POST",
                url: '/getWbsLevel',
                data: {
                    _token: "{{ csrf_token() }}",
                    contractorID: $('#contractor-list').val(),
                    id: id
                }
            }).done(function(data) {
                datob = JSON.parse(data);

                if (datob.length < 1) {
                    $('#childLevel').html("<option value='1'>1</option>");
                } else {
                    idx = 1;
                    idxChild = 1;
                    var parent = "";
                    var child = "";
                    for (var i = 0; i < datob.length; i++) {
                        // if (datob[i].parentItem == null) {
                        //     parent += "<option value=" + (idx) + ">" + (idx) + "</option>";
                        //     idx++;
                        // } else {
                        child += "<option value=" + (idxChild) + ">" + (idxChild) + "</option>";
                        idxChild++;
                        // }
                    }
                    $('#childLevel').html(child);
                }

            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
            $('#parentID').val(id);
            $('#parentLvl').val(lvl);
            $('#btn-add-child').css({
                'display': 'inline'
            });
            $('#btn-edit-child').css({
                'display': 'none'
            });
            $('#currencyTypechild').val('').trigger('change');
            $('#unitTypechild').val('').trigger('change');
            $('#addChild')[0].reset();
            $('#formemodalchild').modal('show');

        });

        $('#example tbody').on('click', '.edit-btn', function() {
            $('#title_child').html('EDIT CHILD RECORD');
            var id = $(this).data("id");
            $('#btn-add-child').css({
                'display': 'none'
            });
            $('#btn-edit-child').css({
                'display': 'inline'
            });
            $.ajax({
                type: "POST",
                url: '/getWbsByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#childID').val(datob[0].id);
                $('#childItem').val(datob[0].itemName);
                $('#childQty').val(datob[0].qty);
                $('#childAmount').val(datob[0].price);

                var newOption1 = new Option(datob[0].currencyName, datob[0].CurrencyID, true, true);
                $('#currencyTypechild').append(newOption1).trigger('change');

                var newOption2 = new Option(datob[0].UnitName, datob[0].unitID, true, true);
                $('#unitTypechild').append(newOption2).trigger('change');

                $.ajax({
                    type: "POST",
                    url: '/getWbsLevel',
                    data: {
                        _token: "{{ csrf_token() }}",
                        contractorID: $('#contractor-list').val(),
                        id: datob[0].parentItem
                    }
                }).done(function(data) {
                    datob = JSON.parse(data);

                    if (datob.length < 1) {
                        $('#childLevel').html("<option value='1'>1</option>");
                    } else {
                        idx = 1;
                        idxChild = 1;
                        var parent = "";
                        var child = "";
                        for (var i = 0; i < datob.length; i++) {
                            // if (datob[i].parentItem == null) {
                            //     parent += "<option value=" + (idx) + ">" + (idx) + "</option>";
                            //     idx++;
                            // } else {
                            child += "<option value=" + (idxChild) + ">" + (idxChild) + "</option>";
                            idxChild++;
                            //}
                        }
                        $('#childLevel').html(child);
                    }

                }).fail(function(jqXHR, textStatus, errorThrown) {
                    errorAlertServer('Response Not Found, Please Check Your Data');
                });
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
            $('#formemodalchild').modal('show');

        });

        $('#example tbody').on('click', '.edit-btn-parent', function() {
            $('#title_parent').html('EDIT PARENT RECORD');
            $('#btn-add-parent').css({
                'display': 'none'
            });
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/getWbsByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#parentIDMain').val(datob[0].id);
                $('#parentItem').val(datob[0].itemName);
                $('#parentQty').val(datob[0].qty);
                $('#parentAmount').val(datob[0].price);

            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
            $('#formemodal').modal('show');

        });

        $('#unitType').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                type: 'GET',
                url: '/getUnit',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                processResults: function(data) {
                    datob = JSON.parse(data);
                    return {
                        results: $.map(datob, function(item) {
                            return {
                                text: item.unitName + " ( " + item.unitSymbol + " )",
                                slug: item.unitName + " ( " + item.unitSymbol + " )",
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('#unitTypechild').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                type: 'GET',
                url: '/getUnit',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                processResults: function(data) {
                    datob = JSON.parse(data);
                    return {
                        results: $.map(datob, function(item) {
                            return {
                                text: item.unitName + " ( " + item.unitSymbol + " )",
                                slug: item.unitName + " ( " + item.unitSymbol + " )",
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('#currencyTypechild').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                type: 'GET',
                url: '/getCurrency',
                data: {
                    _token: "{{ csrf_token() }}"
                },
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

        $('#btn-add-parent').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/addWbsParent',
                data: $('#addParent').serialize() + "&_token=" + '{{ csrf_token() }}' + "&contractorID=" + $('#contractor-list').val()
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Add', $('#parentItem').val(), 'success');
                    $('#addParent')[0].reset();
                } else {
                    successAlert('Add', $('#parentItem').val(), 'success');
                    $('#addParent')[0].reset();
                }
                $('#formemodal').modal('toggle');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
        });

        $('#btn-edit-child').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/updateWbsChild',
                data: $('#addChild').serialize() + "&_token=" + '{{ csrf_token() }}' + "&contractorID=" + $('#contractor-list').val()
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Update', $('#childID').val(), 'success');
                    $('#currencyTypechild').val('').trigger('change');
                    $('#unitTypechild').val('').trigger('change');
                    $('#addChild')[0].reset();
                } else {
                    errorAlert('Update', $('#childID').val(), 'error');
                    $('#currencyTypechild').val('').trigger('change');
                    $('#unitTypechild').val('').trigger('change');
                    $('#addChild')[0].reset();
                }
                $('#formemodalchild').modal('toggle');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
        });

        $('#btn-edit-parent').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/updateWbsParent',
                data: $('#addParent').serialize() + "&_token=" + '{{ csrf_token() }}'
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Update', $('#parentIDMain').val(), 'success');
                    $('#addParent')[0].reset();
                } else {
                    errorAlert('Update', $('#parentIDMain').val(), 'error');
                    $('#addParent')[0].reset();
                }
                $('#formemodal').modal('toggle');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
        });

        $('#btn-add-child').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/addWbsChild',
                data: $('#addChild').serialize() + "&_token=" + '{{ csrf_token() }}' + "&contractorID=" + $('#contractor-list').val()
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Add', $('#childItem').val(), 'success');
                    $('#currencyTypechild').val('').trigger('change');
                    $('#unitTypechild').val('').trigger('change');
                    $('#addChild')[0].reset();
                } else {
                    successAlert('Add', $('#childItem').val(), 'error');
                    $('#currencyTypechild').val('').trigger('change');
                    $('#unitTypechild').val('').trigger('change');
                    $('#addChild')[0].reset();
                }
                $('#formemodalchild').modal('toggle');
            });
        });

        $('#example tbody').on('click', '.confirm-btn-alert', function() {
            id = $(this).attr('data-ids');
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
                            url: '/deleteWbs',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id
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

        $('#example tbody').on('change', '.startDate', function() {
            var id = $(this).data("id");
            $("#endDate_" + id).attr("readonly", false);
            $("#endDate_" + id).attr("min", this.value);
        });

        $('#example tbody').on('change', '.endDate', function() {
            var id = $(this).data("id");

            if ($('#startDate_' + id).val() === null || this.value === null) {
                emptyAlert('input', 'Start Date Or End Date');
            } else {
                const startDate = $('#startDate_' + id).val().slice(0, 10)
                    .split('-');
                var startDateJoin = startDate[1] + '/' + startDate[2] + '/' + startDate[0];
                const endDate = this.value.slice(0, 10)
                    .split('-');
                var endDateJoin = endDate[1] + '/' + endDate[2] + '/' + endDate[0];

                var date_diff_indays = function(date1, date2) {
                    dt1 = new Date(date1);
                    dt2 = new Date(date2);
                    return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate())) / (1000 * 60 * 60 * 24));
                }
                $.ajax({
                    type: "POST",
                    url: '/updateWbsChildDate',
                    data: {
                        id: id,
                        startDate: $('#startDate_' + id).val(),
                        endDate: this.value,
                        _token: "{{ csrf_token() }}"
                    }
                }).done(function(msg) {
                    datob = JSON.parse(msg);
                });

                $('#duration_' + id).val(date_diff_indays(startDateJoin, endDateJoin) + " Day");
            }

        });

        $('#btn-back-scurve').click(function(e) {
            $("#card-scurve").hide();
            $("#card-table").show();
        });

        $('#contractor-list').on('change', function() {
            $('#example').DataTable().destroy();
            var table = $('#example').DataTable({
                lengthChange: false,
                //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
                dom: 'Bfrtip',
                buttons: [{
                        text: 'New',
                        className: 'btn-primary',
                        action: function(e, dt, button, config) {
                            $('#btn-edit-parent').css({
                                'display': 'none'
                            });
                            $('#title_parent').html('NEW PARENT RECORD');
                            $('#parentIDMain').val();
                            $('#currencyTypechild').val('').trigger('change');
                            $('#unitTypechild').val('').trigger('change');
                            $('#addParent')[0].reset();
                            $('#formemodal').modal();
                        }
                    }, {
                        extend: 'pdfHtml5',
                        text: 'Print',
                        exportOptions: {
                            columns: [0, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14]
                        }
                    },
                    {
                        text: 'Import WBS Source',
                        className: 'btn-secondary'
                    },
                    {
                        text: 'Gantt Chart',
                        className: 'btn-secondary',
                        action: function(e, dt, button, config) {
                            window.open('/baseline-gantt/' + $('#contractor-list').val());
                        }
                    },
                    {
                        text: 'S-curve',
                        className: 'btn-secondary',
                        action: function(e, dt, button, config) {
                            $("#card-scurve").show();
                            $("#card-table").hide();

                            $.ajax({
                                type: "POST",
                                url: '/getBaselineChart',
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    contractorID: $('#contractor-list').val(),
                                },
                                dataType: "JSON"
                            }).done(function(data) {
                                $("#bar-chart").empty();
                                Morris.Bar({
                                    element: 'bar-chart',
                                    data: data,
                                    xkey: 'x',
                                    ykeys: ['baseline'],
                                    labels: ['Baseline'],
                                    barColors: ['#03d0ea', '#d13adf', '#fba540'],
                                    gridTextColor: "#ddd",
                                    resize: true
                                });

                            });

                        }
                    }
                ],
                ajax: {
                    url: '/getWbs',
                    method: "POST",
                    dataSrc: "",
                    data: {
                        _token: "{{ csrf_token() }}",
                        contractorID: $('#contractor-list').val(),
                    }
                },

                rowGroup: {
                    dataSrc: [2, 3]
                },
                order: [
                    [0, "asc"]
                ],
                ordering: false,
                columnDefs: [{
                    targets: [1, 2, 3, 4],
                    visible: false
                }],
                lengthMenu: [
                    [-1],
                    ["All"]
                ],
                columns: [{
                        "className": 'details-control',
                        data: "merge"
                    }, {
                        "className": 'details-control',
                        data: "no"
                    },
                    {
                        "className": 'details-control',
                        data: "id"
                    },
                    {
                        "className": 'details-control',
                        data: "parentItem"
                    },
                    {
                        "className": 'details-control',
                        data: "hasChild"
                    },
                    {
                        "className": 'details-control',
                        data: "itemName"
                    },
                    {
                        "className": 'details-control',
                        data: "UnitName"
                    },
                    {
                        "className": 'details-control',
                        data: "duration"
                    },
                    {
                        "className": 'details-control',
                        data: "startDates"
                    },
                    {
                        "className": 'details-control',
                        data: "endDates"
                    },
                    {
                        "className": 'details-control',
                        data: "qty"
                    },
                    {
                        "className": 'details-control',
                        data: "currencyName"
                    },
                    {
                        "className": 'details-control',
                        data: "price"
                    },
                    {
                        "className": 'details-control',
                        data: "cost"
                    },
                    {
                        "className": 'details-control',
                        data: "weight"
                    }, {
                        "className": 'details-control',
                        data: "Userfullname"
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

            $("#card-table").show();
            $("#card-scurve").hide();
            $.ajax({
                type: "POST",
                url: '/getWbs',
                data: {
                    _token: "{{ csrf_token() }}",
                    contractorID: $('#contractor-list').val(),
                }
            }).done(function(data) {
                datob = JSON.parse(data);
                if (datob.length < 1) {
                    $('#parentLevel').html("<option value='1'>1</option>");
                } else {
                    idx = 1;
                    idxChild = 1;
                    for (var i = 0; i < datob.length; i++) {
                        if (datob[i].parentItem == null) {
                            $('#parentLevel').append("<option value=" + (idx) + ">" + (idx) + "</option>");
                            idx++;
                        }

                    }
                    $('#parentLevel').append("<option value=" + (idx) + ">" + (idx) + "</option>");

                }

            });

        });
        //     var input_field = function (data, type, full, meta) {
        //     data = $.trim(data);
        //     var row = meta.row;
        //     var col = meta.col;
        //     var colName = meta.settings.aoColumns[col].data;
        //     return '<input class="form-control input-xs input-width-sm" maxlength="4" id="' + colName + '" name="EditItems[' + row + '].' + colName + '" value="' + data + '" type="number"/>';
        // };
    });
</script>
@endsection