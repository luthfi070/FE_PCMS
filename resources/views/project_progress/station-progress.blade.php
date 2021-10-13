@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Station Progress</h4>
            </div>
        </div>
    </div>
    @include('contractor-list')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Main Report</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="stationTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ITEM NAME</th>
                                <th>DESCRIPTION</th>
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
                    <h5 class="modal-title">ADD PROGRESS CHART</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-station">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="contractorName" name="contractorName" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ITEM</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="parentItem" name="parentItem" required>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DESCRIPTION</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Enter Your Description" id="descStation" name="descStation"></textarea>
                            </div>
                        </div>
                    </form>
                    <div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> Station</div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="input-23" class="col-sm-2 col-form-label">STATION NAME :</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="station-name" name="station-name">
                                </div>
                                <button class="btn btn-primary px-5 m-1" id="btn-add-station"><i class="fa fa-plus"></i> Add</button>
                            </div>
                            <table id="addStationProgress" class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th style="display:none;">NO</th>
                                        <th>STATION</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Remove</button> -->

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group float-right">

                        <button class="btn btn-success px-5" id="btn-submit-station"><i class="fa fa-save"></i> Save</button>
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
                    <h5 class="modal-title">EDIT PROGRESS CHART</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit-station">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="contractorNameEdit" name="contractorNameEdit" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ITEM</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="parentItemEdit" name="parentItemEdit" required>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DESCRIPTION</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Enter Your Description" id="descStationEdit" name="descStationEdit"></textarea>
                            </div>
                        </div>
                    </form>
                        <div class="form-group float-right">

                            <button class="btn btn-success px-5" id="btn-edit-station"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodaldetail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">DETAIL PROGRESS CHART</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-sub-item">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="contractorNameDetail" name="contractorNameDetail" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">GENERAL</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="generalItemID" name="generalItemID">
                                <input type="text" class="form-control" id="generalItem" name="generalItem" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">SUB ITEM</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="childItem" name="childItem" required>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="form-group row">
                        <div class="col-sm-12 ">
                            <button type="submit" class="float-right btn btn-primary px-5 m-1" id="btn-add-sub"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header"><i class="fa fa-table"></i> Item Name</div>
                        <div class="card-body">
                            <table id="subTable" class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>ITEM NAME</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- <div class="col-sm-12 ">
                            <button class="float-right btn btn-success px-5" data-dismiss="modal"><i class="fa fa-check"></i> OK</button>
                        </div> -->
                        <div class="col-sm-12">
                            <button class="btn btn-info px-5" data-toggle="modal" id="btn-formmodaldetailitem"><i class="fa fa-list"></i> View Progress</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodaldetailitem">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">DETAIL ITEM PROGRESS CHART</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="contractorItemName" name="contractorItemName" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ITEM</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="generalItemDetailID" name="generalItemDetailID" readonly>
                                <input type="text" class="form-control" id="generalItemDetail" name="generalItemDetail" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="itemDate">
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header"><i class="fa fa-table"></i> Sub Item</div>
                            <div class="card-body" id="cardTable">
                            <div class="table-responsive">
                                <table id="subItemTable" class="table table-bordered text-center">
                                </table>
                            </div>
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">
                        <!-- <button class="btn btn-success px-5"><i class="fa fa-save"></i> Save</button> -->
                        <button class="btn btn-danger px-5" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodaleditdetailitem">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">EDIT DETAIL ITEM</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit-completion">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR</label>
                            <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="itemID" name="itemID" readonly>
                                <input type="text" class="form-control" id="contractorEditItemName" name="contractorEditItemName" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ITEM</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="generalEditItemDetailID" name="generalEditItemDetailID" readonly>
                                <input type="text" class="form-control" id="generalEditItemDetail" name="generalEditItemDetail" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">SUB ITEM</label>
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" id="EditItemDetailID" name="EditItemDetailID" readonly>
                                <input type="text" class="form-control" id="EditItemDetail" name="EditItemDetail" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">STATION</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="optionStationItemDetail" name="optionStationItemDetail">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="dateItemDetail" name="dateItemDetail">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">PROGRESS</label>
                            <div class="col-sm-10">
                                <input type="checkbox" id="ProgressStatus" name="ProgressStatus" value="1">
                                <label for="input-23" class="col-sm-2 col-form-label">Completed</label>
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">
                        <button class="btn btn-success px-5" id="btn-edit-completion"><i class="fa fa-save"></i> Save</button>
                        <button class="btn btn-danger px-5" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                    </div>
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


        var table = $('#stationTable').DataTable({
            lengthChange: false,
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            buttons: [{
                text: 'NEW',
                className: 'btn-primary',
                action: function(e, dt, button, config) {
                    // $('#formmodal').modal();

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
                url: '/getStationData',
                method: "POST",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                    contractorID: $('#contractor-list').val()
                }
            },
            columns: [{
                    data: "no"
                },
                {
                    data: "itemName"
                },
                {
                    data: "description"
                },
                {
                    data: "action"
                }
            ],
            initComplete: function() {
                table.buttons().container()
                    .appendTo('#stationTable_wrapper .col-md-6:eq(0)');
            }
        });

        $("#btn-formmodaldetailitem").click(function() {
            $("#formmodaldetail").modal('hide');
        });

        $("#subItemTable").on("click", ".edit-btn-detail", function() {
            var id = $(this).data("id");
            var itemName = $(this).attr('data-name');
            $('#EditItemDetail').val(itemName);
            $('#EditItemDetailID').val(id);
            let d = new Date();
            let ye = new Intl.DateTimeFormat('en', {
                timeZone: 'Asia/Jakarta',
                year: 'numeric'
            }).format(d);
            let mo = new Intl.DateTimeFormat('en', {
                timeZone: 'Asia/Jakarta',
                month: '2-digit'
            }).format(d);
            let da = new Intl.DateTimeFormat('en', {
                timeZone: 'Asia/Jakarta',
                day: '2-digit'
            }).format(d);

            $('#dateItemDetail').val(ye + '-' + mo + '-' + da);
            
            itemID = $(this).attr('data-itemID');
            $('#itemID').val(itemID);
            $.ajax({
                type: "POST",
                url: '/getSubItemStation',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $('#generalItemID').val()
                },
            }).done(function(data) {
                datob = JSON.parse(data);
                var option = "";
                for (var i = 0; i < datob.length; i++) {
                    option = option + "<option value='" + datob[i].id + "'>" + datob[i].stationName + "</option>";
                }
                $('#optionStationItemDetail').html(option);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
            $('#formmodaldetailitem').modal('toggle');
            $('#formmodaleditdetailitem').modal();
        });

        var stationList = [];
        $("#btn-add-station").click(function() {
            no = '';
            $('#addStationProgress:last tr').each(function() {
                if (isNaN($(this).find("td").eq(0).html())) {
                    no = 1;
                } else {
                    no += 1;
                }
            });
            if ($("#station-name").val() === null || $("#station-name").val() === "") {
                alert("Please Fill Station Name !");
            } else {
                $("#addStationProgress tr:last").after('<tr><td style="display:none;">' + no + '</td><td>' + $("#station-name").val() + '</td><td> <button type="reset" id="delete-btn" data-id="' + no + '" class="btn btn-danger px-5"><i class="fa fa-times"></i> Remove</button></td></tr>');
                stationList.push($("#station-name").val());
                $("#station-name").val('');
            }
        });

        $("#btn-add-sub").click(function(e) {
            
            $.ajax({
                type: "POST",
                url: '/addSubItem',
                data: {
                    _token: "{{ csrf_token() }}",
                    contractorID: $('#contractor-list').val(),
                    childItem:$('#childItem').val(),
                    generalItemID:$('#generalItemID').val(),

                },
            }).done(function(msg) {
                if (datob != 'error') {
                    successAlert('Create', $('#childItem').val(), 'success');
                    //$('#form-sub-item')[0].reset();
                    $('#subTable').DataTable().ajax.reload();

                } else {
                    errorAlert('Create', $('#childItem').val(), 'error');
                    //$('#form-sub-item')[0].reset();
                    $('#subTable').DataTable().ajax.reload();

                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
            //$('#formmodaldetail').modal('toggle');
        });

        $("#btn-edit-completion").click(function() {

            $.ajax({
                type: "POST",
                url: '/editCompletion',
                data: $('#form-edit-completion').serialize() + "&_token=" + "{{ csrf_token() }}",
            }).done(function(msg) {
                if (datob != 'error') {
                    successAlert('Update', $('#EditItemDetail').val(), 'success');


                } else {
                    errorAlert('Update', $('#EditItemDetail').val(), 'error');

                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
            $('#formmodaleditdetailitem').modal('toggle');
        });

        $("#btn-formmodaldetailitem").click(function() {
            $('#formmodaldetailitem').modal();
            $.ajax({
                type: "POST",
                url: '/getSubItemTableRow',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $('#generalItemID').val()
                },
            }).done(function(msg) {
                $("#subItemTable").html(msg);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

            $.ajax({
                type: "POST",
                url: '/getCompletion',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: $('#generalItemID').val()
                },
                dataType:'JSON'
            }).done(function(msg) {
                for(let i=0;i<msg.length;i++){
                    $("#progressTab_"+msg[i].itemID2+"_"+msg[i].id).css('background-color','yellow');
                }
                console.log(msg);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
        });

        $("#subTable").on("click", ".delete-btn", function() {
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
                            url: '/deleteSub',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: idData
                            }
                        }).done(function(msg) {
                            datob = JSON.parse(msg);
                            $('#subTable').DataTable().ajax.reload();
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

        $("#stationTable").on("click", ".delete-btn", function() {
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
                            url: '/deleteItem',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: idData
                            }
                        }).done(function(msg) {
                            datob = JSON.parse(msg);
                            $('#stationTable').DataTable().ajax.reload();
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

        $("#addStationProgress").on("click", "#delete-btn", function() {
            var id = $(this).data("id");
            var name = "";
            var currentRow = $(this).closest("tr");
            var col2 = currentRow.find("td:eq(1)").text();
            const index = stationList.indexOf(col2);
            if (index > -1) {
                stationList.splice(index, 1);
            }

            $(this).closest("tr").remove();
        });

        $("#btn-submit-station").click(function() {

            $.ajax({
                type: "POST",
                url: '/addStation',
                data: $('#form-station').serialize() + "&_token=" + "{{ csrf_token() }}" + "&list=" + stationList + "&contractorID=" + $('#contractor-list').val(),
                dataType: "JSON"
            }).done(function(msg) {
                $('#stationTable').DataTable().ajax.reload();
                if (msg.status != 'error') {
                    successAlert('Create', $('#parentItem').val(), 'success');
                    $('#form-station')[0].reset();
                    stationList = [];
                } else {
                    errorAlert('Create', $('#parentItem').val(), 'error');
                    $('#form-station')[0].reset();
                    stationList = [];
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
            $('#formmodal').modal('toggle');
        });

        $('#stationTable tbody').on('click', '.edit-btn', function() {
            var id = $(this).data("id");

            $.ajax({
                type: "POST",
                url: '/stationDetail',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#contractorNameEdit').val(datob[0].BussinessName);
                $('#parentItemEdit').html('<option value="' + datob[0].itemID + '">' + datob[0].itemName + '</option>');
                $('#descStationEdit').val(datob[0].description);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

            $('#formmodaledit').modal();

        });

        $("#btn-edit-station").click(function() {
            $.ajax({
                type: "POST",
                url: '/editStation',
                data: $('#form-edit-station').serialize() + "&_token=" + "{{ csrf_token() }}",
                dataType: "JSON"
            }).done(function(msg) {
                $('#stationTable').DataTable().ajax.reload();
                if (msg.status != 'error') {
                    successAlert('Update', $('#parentItemEdit').val(), 'success');
                    $('#form-edit-station')[0].reset();
                } else {
                    errorAlert('Update', $('#parentItemEdit').val(), 'error');
                    $('#form-edit-station')[0].reset();

                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
            $('#formmodaledit').modal('toggle');
        });

        $('#stationTable tbody').on('click', '.detail-btn', function() {
            $('#subTable').DataTable().destroy();
            var id = $(this).data("id");
            var subTable = $('#subTable').DataTable({
                lengthChange: false,
                //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
                ajax: {
                    url: '/getSubItem',
                    method: "POST",
                    dataSrc: "",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    }
                },
                columns: [{
                        data: "no"
                    },
                    {
                        data: "itemName"
                    },
                    {
                        data: "action"
                    }
                ],
                initComplete: function() {
                    table.buttons().container()
                        .appendTo('#stationTable_wrapper .col-md-6:eq(0)');
                }
            });


            var contractor = $(this).attr('data-contractor');
            var item = $(this).attr('data-item');
            $('#contractorNameDetail').val(contractor);
            $('#generalItem').val(item);
            $('#generalItemID').val(id);
            $('#contractorItemName').val(contractor);
            $('#generalItemDetail').val(item);
            $('#generalItemDetailID').val(id);
            $('#contractorEditItemName').val(contractor);
            $('#generalEditItemDetail').val(item);
            $('#generalEditItemDetailID').val(id);

            let d = new Date();
            let ye = new Intl.DateTimeFormat('en', {
                timeZone: 'Asia/Jakarta',
                year: 'numeric'
            }).format(d);
            let mo = new Intl.DateTimeFormat('en', {
                timeZone: 'Asia/Jakarta',
                month: '2-digit'
            }).format(d);
            let da = new Intl.DateTimeFormat('en', {
                timeZone: 'Asia/Jakarta',
                day: '2-digit'
            }).format(d);

            $('#itemDate').val(ye + '-' + mo + '-' + da);

            $.ajax({
                type: "POST",
                url: '/getChildItem',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    contractorID: $('#contractor-list').val()
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#childItem').html(datob[0].option);

            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
            $('#formmodaldetail').modal();
        });



        $.ajax({
            type: "POST",
            url: '/getParentItem',
            data: {
                _token: "{{ csrf_token() }}",
                contractorID: $('#contractor-list').val()
            }
        }).done(function(msg) {
            datob = JSON.parse(msg);
            $('#parentItem').html(datob[0].option);

        }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

        $('#contractor-list').on('change', function() {
            $.ajax({
                type: "POST",
                url: '/getParentItem',
                data: {
                    _token: "{{ csrf_token() }}",
                    contractorID: $('#contractor-list').val()
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#parentItem').html(datob[0].option);

            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

            $('#stationTable').DataTable().destroy();
            var table = $('#stationTable').DataTable({
                lengthChange: false,
                //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
                buttons: [{
                    text: 'NEW',
                    className: 'btn-primary',
                    action: function(e, dt, button, config) {
                        let contractor =$("#contractor-list option[value='"+$('#contractor-list').val()+"']").text();
                        $('#contractorName').val(contractor);
                        $('#formmodal').modal();
                    }
                }],
                ajax: {
                    url: '/getStationData',
                    method: "POST",
                    dataSrc: "",
                    data: {
                        _token: "{{ csrf_token() }}",
                        contractorID: $('#contractor-list').val()
                    }
                },
                columns: [{
                        data: "no"
                    },
                    {
                        data: "itemName"
                    },
                    {
                        data: "description"
                    },
                    {
                        data: "action"
                    }
                ],
                initComplete: function() {
                    table.buttons().container()
                        .appendTo('#stationTable_wrapper .col-md-6:eq(0)');
                }
            });

        });




    });
</script>
@endsection