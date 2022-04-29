@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Performance Analysis</h4>
            </div>
        </div>
    </div>
    @include('contractor-list')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Report</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TITLE</th>
                                <th>REPORT DATE</th>
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
                    <h5 class="modal-title">NEW REPORT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-document">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">REPORT DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="reportDate" id="reportDate">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">TITLE</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="reportTitle" id="reportTitle">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">AUTHOR</label>
                            <div class="col-sm-10">
                                <input type="hidden" readonly class="form-control" name="reportAuthor" id="reportAuthor">
                                <input type="text" readonly class="form-control" value="<?php echo session('Userfullname');?>" name="reportAuthorName" id="reportAuthorName">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">MONTH</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="reportMonth" id="reportMonth">
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">YEAR</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="reportYear" id="reportYear">
                                </select>
                            </div>
                        </div>
                        </form>
                        <div class="form-group float-right">

                            <button type="submit" class="btn btn-success px-5" id="btn-add-report"><i class="fa fa-save"></i> Save</button>
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
        let d = new Date();
        let ye = new Intl.DateTimeFormat('en', {
            timeZone: 'Asia/Jakarta',
            year: '2-digit'
        }).format(d);

        let mo = new Intl.DateTimeFormat('en', {
            timeZone: 'Asia/Jakarta',
            month: '2-digit'
        }).format(d);
        let da = new Intl.DateTimeFormat('en', {
            timeZone: 'Asia/Jakarta',
            day: '2-digit'
        }).format(d);

        $('#reportMonth').val(ye + '-' + mo + '-' + da);

        for (var i = parseInt(ye); i >= 10; i--) {
            i.toString().length == 1 ? $('#reportYear').append('<option value="200' + i + '">200' + i + '</option>') : $('#reportYear').append('<option value="20' + i + '">20' + i + '</option>');
        }

        //Default data table
        $('#default-datatable').DataTable();


        var table = $('#example').DataTable({
            lengthChange: false,
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            buttons: [{
                text: 'NEW REPORT',
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
            }]
        });

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

    });

    $('#btn-formmodaladdimage').click(function() {
        $('#formmodaldetail').modal('hide');
    });

    $('#reportAuthor').val(<?php echo session('UserID');?>);

    $('#btn-add-report').click(function() {
        var arr_temp = [$('#reportTitle').val(), $('#reportDate').val(), $('#reportAuthor').val(), $('#reportMonth').val(), $('#reportYear').val(), $('#contractor-list').val()];
        localStorage.setItem("reportTitle", JSON.stringify(arr_temp));
        window.location = '/performanceanalysisreport';
    });

    $('#example tbody').on('click', '.detail-btn', function() {
        var id = $(this).data("id");
        
    });

    $('#contractor-list').on('change', function() {
        var privilegedstatus="<?php echo session('PrivilegedStatus');?>";
        $('#example').DataTable().destroy();
            var table = $('#example').DataTable({
            lengthChange: false,
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            buttons: [{
                text: 'NEW REPORT',
                className: 'btn-primary',
                action: function(e, dt, button, config) {
                    if(privilegedstatus==1){
                     $('#formmodal').modal();
                    }else{
                        swal("Only Admin Permit to Generate !");
                    }
                }
            }],
            ajax: {
                url: '/getPerformanceList',
                method: "POST",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: <?php echo session('ProjectID'); ?>,
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
                    data: "reportingDate"
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
</script>
@endsection