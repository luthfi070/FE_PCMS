@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Visual Progress</h4>
            </div>
        </div>
    </div>
    @include('contractor-list')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> List of Visual Progress</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ITEM</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>TEST</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger  waves-effect waves-light m-1">Delete</button>
                                    <button type="button" class="btn btn-warning  waves-effect waves-light m-1">Edit</button>
                                    <button class="btn btn-primary  waves-effect waves-light m-1" data-toggle="modal" data-target="#formmodaldetail">Details</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Another Visual Progress</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="otherVisual" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ITEM</th>
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
                    <h5 class="modal-title">ADD VISUAL PROGRESS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-add-visual">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="contractorName" name="contractorName" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ITEM</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="itemList" name="itemList">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">

                        <button type="submit" class="btn btn-success px-5" id="btn-add-visual"><i class="fa fa-save"></i> Save</button>
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
                    <h5 class="modal-title">EDIT VISUAL PROGRESS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-add-visual-edit">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR</label>
                            <div class="col-sm-10">
                                <input type="hidden" id="progressID" name="progressID">
                                <input type="text" readonly class="form-control" id="contractorNameEdit" name="contractorNameEdit" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ITEM</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="itemListEdit" name="itemListEdit">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">

                        <button type="submit" class="btn btn-success px-5" id="btn-add-visual-edit"><i class="fa fa-save"></i> Save</button>
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
                    <h5 class="modal-title">DETAIL VISUAL PROGRESS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="contractorNameDetail" name="contractorNameDetail" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ITEM</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="visualItemDetail" name="visualItemDetail" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="visualDate" name="visualDate" />
                            </div>
                        </div>
                    </form>
                    <div class="form-group row" id="imgContainer">


                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <a class="btn btn-success px-5" data-toggle="modal" data-target="#formmodaladdimage" id="btn-formmodaladdimage"><i class="fa fa-plus"></i> New</a>
                        </div>
                        <div class="col-sm-6">
                            <a data-dismiss="modal" style="float:right" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodaladdimage">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">ADD IMAGE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-add-img">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="contractorNameAddVisual" name="contractorNameAddVisual" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ITEM</label>
                            <div class="col-sm-10">
                                <input type="hidden" readonly class="form-control" id="IdvisualItemAddVisual" name="IdvisualItemAddVisual" />
                                <input type="text" readonly class="form-control" id="visualItemAddVisual" name="visualItemAddVisual" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="visualDateAddVisual" name="visualDateAddVisual" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">IMAGE FILE</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="imgAddVisual" name="imgAddVisual">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DESCRIPTION</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="descAddVisual" name="descAddVisual"></textarea>
                            </div>
                        </div>

                        <div class="form-group float-right">

                            <button class="btn btn-success px-5" id="btn-add-visual-img"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- ============================================================= -->
    <!-- ============================================================= -->
    <!-- ============================================================= -->
    <!-- ============================================================= -->

    <div class="modal fade" id="formmodalOther">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">ADD VISUAL PROGRESS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-add-visual-other">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="contractorNameOther" name="contractorNameOther" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ITEM</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="otherItemName" name="otherItemName" />
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">

                        <button type="submit" class="btn btn-success px-5" id="btn-add-visual-other"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodalOtheredit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">EDIT VISUAL PROGRESS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-add-visual-other-edit">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR</label>
                            <div class="col-sm-10">
                                <input type="hidden" id="progressOtherID" name="progressOtherID">
                                <input type="text" readonly class="form-control" id="contractorNameOtherEdit" name="contractorNameOtherEdit" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ITEM</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="otherItemNameEdit" name="otherItemNameEdit" />
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">

                        <button type="submit" class="btn btn-success px-5" id="btn-add-visual-other-edit"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodaldetailOther">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">DETAIL VISUAL PROGRESS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="contractorNameDetailOther" name="contractorNameDetailOther" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ITEM</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="visualItemDetailOther" name="visualItemDetailOther" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="visualDateOther" name="visualDateOther" />
                            </div>
                        </div>
                    </form>
                    <div class="form-group row" id="imgContainerOther">


                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <a class="btn btn-success px-5" data-toggle="modal" data-target="#formmodaladdimageOther" id="btn-formmodaladdimageOther"><i class="fa fa-plus"></i> New</a>
                        </div>
                        <div class="col-sm-6">
                            <a data-dismiss="modal" style="float:right" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodaladdimageOther">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">ADD IMAGE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-add-img-other">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" id="contractorNameAddVisualOther" name="contractorNameAddVisualOther" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">ITEM</label>
                            <div class="col-sm-10">
                                <input type="hidden" readonly class="form-control" id="IdvisualItemAddVisualOther" name="IdvisualItemAddVisualOther" />
                                <input type="text" class="form-control" id="visualItemAddVisualOther" name="visualItemAddVisualOther" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="visualDateAddVisualOther" name="visualDateAddVisualOther" />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">IMAGE FILE</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="imgAddVisualOther" name="imgAddVisualOther">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DESCRIPTION</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="descAddVisualOther" name="descAddVisualOther"></textarea>
                            </div>
                        </div>

                        <div class="form-group float-right">

                            <button class="btn btn-success px-5" id="btn-add-visual-img-other"><i class="fa fa-save"></i> Save</button>
                            <button class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>

                        </div>
                    </form>
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
                text: 'NEW',
                className: 'btn-primary',
                action: function(e, dt, button, config) {
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
                url: '/getVisualProgress',
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
                    data: "action"
                }
            ],
            initComplete: function() {
                table.buttons().container()
                    .appendTo('#example_wrapper .col-md-6:eq(0)');
            }
        });


        var tableOther = $('#otherVisual').DataTable({
            lengthChange: false,
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            buttons: [{
                text: 'NEW',
                className: 'btn-primary',
                action: function(e, dt, button, config) {
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
                url: '/getOtherVisualProgress',
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
                    data: "itemVisualName"
                },
                {
                    data: "action"
                }
            ],
            initComplete: function() {
                tableOther.buttons().container()
                    .appendTo('#otherVisual_wrapper .col-md-6:eq(0)');
            }
        });

        $('#btn-add-visual').click(function() {
            $.ajax({
                type: "POST",
                url: '/addVisualProgress',
                data: $('#form-add-visual').serialize() + "&_token=" + "{{ csrf_token() }}" + "&contractorID=" + $('#contractor-list').val(),
            }).done(function(msg) {
                if (msg != null || msg != "") {
                    successAlert('Create', $('#itemList').val(), 'success');
                    $('#form-add-visual')[0].reset();

                } else {
                    errorAlert('Create', $('#itemList').val(), 'error');
                    $('#form-add-visual')[0].reset();

                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlert('Create', $('#itemList').val(), 'error');
                $('#form-add-visual')[0].reset();
            });
            $('#example').DataTable().ajax.reload();
            $('#formmodal').modal('toggle');
        });


        $('#btn-add-visual-other').click(function() {
            $.ajax({
                type: "POST",
                url: '/addOtherVisualProgress',
                data: $('#form-add-visual-other').serialize() + "&_token=" + "{{ csrf_token() }}" + "&contractorID=" + $('#contractor-list').val(),
            }).done(function(msg) {
                if (msg != null || msg != "") {
                    successAlert('Create', $('#itemList').val(), 'success');
                    $('#form-add-visual-other')[0].reset();

                } else {
                    errorAlert('Create', $('#itemList').val(), 'error');
                    $('#form-add-visual-other')[0].reset();

                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlert('Create', $('#itemList').val(), 'error');
                $('#form-add-visual-other')[0].reset();
            });
            $('#otherVisual').DataTable().ajax.reload();
            $('#formmodalOther').modal('toggle');
        });


        $('#imgContainer').on('click', '.edit-img-btn', function() {

            var id = $(this).data("id");
            console.log(id);
        });

        $('#imgContainer').on('click', '.delete-img-btn', function() {

            var id = $(this).data("id");
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
                            url: '/deleteImage',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id
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

        $('#form-add-img').on('submit', (function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var files = $('#imgAddVisual')[0].files;
            formData.append('file', files[0]);

            $.ajax({
                type: "POST",
                url: '/addVisualImage',
                data: formData,
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                cache: false,
                contentType: false,
                processData: false,
            }).done(function(msg) {
                if (msg != null || msg != "") {
                    successAlert('Create', $('#IdvisualItemAddVisual').val(), 'success');
                    $('#form-add-img')[0].reset();

                } else {
                    errorAlert('Create', $('#IdvisualItemAddVisual').val(), 'error');
                    $('#form-add-img')[0].reset();

                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlert('Create', $('#itemList').val(), 'error');
                $('#form-add-img')[0].reset();
            });
            $('#formmodaladdimage').modal('toggle');
        }));

        $('#example tbody').on('click', '.detail-btn', function() {
            var id = $(this).data("id");
            $('#imgContainer').html('');
            $('#btn-img-container').html('');
            $.ajax({
                type: "POST",
                url: '/getVisualProgressDetail',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                if (datob[0].id != null) {
                    $('#imgContainer').html(datob[0].img);
                    $('#btn-img-container').html(datob[0].btn);
                }
                $('#contractorNameDetail').val(datob[0].BussinessName);
                $('#visualItemDetail').val(datob[0].itemName);
                $('#contractorNameAddVisual').val(datob[0].BussinessName);
                $('#visualItemAddVisual').val(datob[0].itemName);
                $('#IdvisualItemAddVisual').val(id);

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

                $('#visualDate').val(ye + '-' + mo + '-' + da);
                $('#visualDateAddVisual').val(ye + '-' + mo + '-' + da);

            });
            $('#formmodaldetail').modal();
        });

        $('#example tbody').on('click', '.edit-btn', function() {
            var id = $(this).data("id");
            $('#progressID').val(id);
            $.ajax({
                type: "POST",
                url: '/getVisualProgressDetail',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#contractorNameEdit').val(datob[0].BussinessName);

            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
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
                $('#itemListEdit').html(datob[0].option);

            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
            $('#formmodaledit').modal();
        });

        $('#otherVisual tbody').on('click', '.edit-btn', function() {
            var id = $(this).data("id");
            $('#progressOtherID').val(id);
            $.ajax({
                type: "POST",
                url: '/getOtherVisualProgressDetail',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#contractorNameOtherEdit').val(datob[0].BussinessName);
                $('#otherItemNameEdit').val(datob[0].itemVisualName);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

            $('#formmodalOtheredit').modal();
        });

        $('#btn-add-visual-edit').click(function() {
            $.ajax({
                type: "POST",
                url: '/editVisualProgress',
                data: $('#form-add-visual-edit').serialize() + "&_token=" + "{{ csrf_token() }}" + "&contractorID=" + $('#contractor-list').val(),
            }).done(function(msg) {
                if (msg != null || msg != "") {
                    successAlert('Update', $('#itemListEdit').val(), 'success');
                    $('#form-add-visual-edit')[0].reset();

                } else {
                    errorAlert('Update', $('#itemListEdit').val(), 'error');
                    $('#form-add-visual-edit')[0].reset();

                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlert('Update', $('#itemListEdit').val(), 'error');
                $('#form-add-visual-edit')[0].reset();
            });
            $('#example').DataTable().ajax.reload();
            $('#formmodaledit').modal('toggle');
        });

        $('#btn-add-visual-other-edit').click(function() {
            $.ajax({
                type: "POST",
                url: '/editOtherVisualProgress',
                data: $('#form-add-visual-other-edit').serialize() + "&_token=" + "{{ csrf_token() }}" + "&contractorID=" + $('#contractor-list').val(),
            }).done(function(msg) {
                if (msg != null || msg != "") {
                    successAlert('Update', $('#otherItemNameEdit').val(), 'success');
                    $('#form-add-visual-other-edit')[0].reset();

                } else {
                    errorAlert('Update', $('#otherItemNameEdit').val(), 'error');
                    $('#form-add-visual-other-edit')[0].reset();

                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlert('Update', $('#otherItemNameEdit').val(), 'error');
                $('#form-add-visual-other-edit')[0].reset();
            });
            $('#otherVisual').DataTable().ajax.reload();
            $('#formmodalOtheredit').modal('toggle');
        });

        $('#otherVisual tbody').on('click', '.detail-btn', function() {
            var id = $(this).data("id");
            $('#imgContainerOther').html('');
            $('#btn-img-container-other').html('');
            $.ajax({
                type: "POST",
                url: '/getOtherVisualProgressDetail',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                if (datob[0].id != null) {
                    $('#imgContainerOther').html(datob[0].img);
                    $('#btn-img-container-other').html(datob[0].btn);
                }
                $('#contractorNameAddVisualOther').val(datob[0].BussinessName);
                $('#contractorNameDetailOther').val(datob[0].BussinessName);
                $('#visualItemDetailOther').val(datob[0].itemVisualName);
                $('#visualItemAddVisualOther').val(datob[0].itemVisualName);
                $('#IdvisualItemAddVisualOther').val(id);

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

                $('#visualDateOther').val(ye + '-' + mo + '-' + da);
                $('#visualDateAddVisualOther').val(ye + '-' + mo + '-' + da);

            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
            $('#formmodaldetailOther').modal();
        });

        $('#form-add-img-other').on('submit', (function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var files = $('#imgAddVisualOther')[0].files;
            formData.append('file', files[0]);

            $.ajax({
                type: "POST",
                url: '/addOtherVisualImage',
                data: formData,
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                cache: false,
                contentType: false,
                processData: false,
            }).done(function(msg) {
                if (msg != null || msg != "") {
                    successAlert('Create', $('#IdvisualItemAddVisualOther').val(), 'success');
                    $('#form-add-img-other')[0].reset();

                } else {
                    errorAlert('Create', $('#IdvisualItemAddVisualOther').val(), 'error');
                    $('#form-add-img-other')[0].reset();

                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlert('Create', $('#IdvisualItemAddVisualOther').val(), 'error');
                $('#form-add-img-other')[0].reset();
            });
            $('#formmodaladdimageOther').modal('toggle');
        }));


        $.ajax({
            type: "POST",
            url: '/getParentItem',
            data: {
                _token: "{{ csrf_token() }}",
                contractorID: $('#contractor-list').val()
            }
        }).done(function(msg) {
            datob = JSON.parse(msg);
            $('#itemList').html(datob[0].option);

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
                $('#itemList').html(datob[0].option);

            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

            $('#example').DataTable().destroy();
            $('#otherVisual').DataTable().destroy();

            var table = $('#example').DataTable({
                lengthChange: false,
                //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
                buttons: [{
                    text: 'NEW',
                    className: 'btn-primary',
                    action: function(e, dt, button, config) {
                        let contractor = $("#contractor-list option[value='" + $('#contractor-list').val() + "']").text();
                        $('#contractorName').val(contractor);
                        $('#formmodal').modal();
                    }
                }],
                ajax: {
                    url: '/getVisualProgress',
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
                        data: "action"
                    }
                ],
                initComplete: function() {
                    table.buttons().container()
                        .appendTo('#example_wrapper .col-md-6:eq(0)');
                }
            });


            var tableOther = $('#otherVisual').DataTable({
                lengthChange: false,
                //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
                buttons: [{
                    text: 'NEW',
                    className: 'btn-primary',
                    action: function(e, dt, button, config) {
                        let contractor = $("#contractor-list option[value='" + $('#contractor-list').val() + "']").text();
                        $('#contractorNameOther').val(contractor);
                        $('#formmodalOther').modal();
                    }
                }],
                ajax: {
                    url: '/getOtherVisualProgress',
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
                        data: "itemVisualName"
                    },
                    {
                        data: "action"
                    }
                ],
                initComplete: function() {
                    tableOther.buttons().container()
                        .appendTo('#otherVisual_wrapper .col-md-6:eq(0)');
                }
            });
        });



    });

    $('#btn-formmodaladdimage #btn-formmodaladdimageOther').click(function() {
        $('#formmodaldetail').modal('hide');
        $('#formmodaldetailOther').modal('hide');
    });
</script>
@endsection