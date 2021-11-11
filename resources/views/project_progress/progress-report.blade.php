@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Progress Report</h4>
            </div>
        </div>
    </div>
    @include('contractor-list')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> List Progress</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TITLE</th>
                                <th>CREATE DATE</th>
                                <th>CREATE BY</th>
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
                    <h5 class="modal-title">NEW RECORD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addReport">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">REPORTING TITLE</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="reportTitle" name="reportTitle">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">REPORTING DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="ReportDate" name="ReportDate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CREATED BY</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="createBy" name="createBy" readonly>
                                    <option value="<?php echo session('UserID');?>"><?php echo session('Userfullname');?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DESCRIPTION</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Enter Your Description" id="ReportDesc" name="ReportDesc"></textarea>
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">
                        <button type="submit" class="btn btn-success px-5" id="createDetail"><i class="fa fa-plus"></i> Create Detail Item</button>
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
    $(document).ready(function() {
        //Default data table
        $('#default-datatable').DataTable();


        var table = $('#example').DataTable({
            lengthChange: false,
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            buttons: [{
                text: 'GENERATE REPORT',
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
                url: '/getDocument',
                method: "POST",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                    contractorID: 0,
                }
            },
            columns: [{
                    data: "no"
                },
                {
                    data: "documentName"
                },
                {
                    data: "created_at"
                },
                {
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

        $('#contractor-list').on('change', function() {
        

            $('#example').DataTable().destroy();
            var table = $('#example').DataTable({
            lengthChange: false,
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            buttons: [{
                text: 'GENERATE REPORT',
                className: 'btn-primary-document',
                action: function(e, dt, button, config) {
                    $('#formmodal').modal();
                }
            }],
            ajax: {
                url: '/getDocument',
                method: "POST",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                    contractorID:$('#contractor-list').val()
                }
            },
            columns: [{
                    data: "no"
                },
                {
                    data: "documentName"
                },
                {
                    data: "created_at"
                },
                {
                    data: "Userfullname"
                },
                {
                    data: "action"
                }
            ],
            initComplete: function() {
                table.buttons().container()
                    .appendTo('#example_wrapper .col-md-6:eq(0)');
                    $('#btn-document').hide();
                    $('.btn-primary-document').hide();
            }
        });
        });

        $('#createDetail').click(function(e) {
            var arr = [];
            reportTitle = $('#reportTitle').val();
            ReportDate = $('#ReportDate').val();
            //createBy=$('#createBy').val();
            createBy = 1;
            ReportDesc = $('#ReportDesc').val();
            arr[0] = reportTitle;
            arr[1] = ReportDate;
            arr[2] = createBy;
            arr[3] = ReportDesc;
            arr[4] = $('#contractor-list').val();
            localStorage.setItem("reportData", JSON.stringify(arr));
            $('#addReport')[0].reset();
            window.location = '/actual-report';
        });

        $('#example tbody').on('click', '.detail-btn', function() {
            var id = $(this).data("id");
            var contractorid = $('#contractor-list').val();
            window.location = '/progress-report-detail/' + id+'/'+contractorid;
        });


    

    });
</script>
@endsection