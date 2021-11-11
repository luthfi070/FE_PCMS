@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card-body">
            <a href="/performanceanalysis" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Performance Analysis</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="input-23" class="col-sm-2 col-form-label">REPORT DATE</label>
                    <div class="col-lg-10">
                        <input type="date" readonly class="form-control" name="reportDate" id="reportDate">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input-23" class="col-sm-2 col-form-label">TITLE</label>
                    <div class="col-lg-10">
                        <input type="text" readonly class="form-control" name="reportTitle" id="reportTitle">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="input-23" class="col-sm-2 col-form-label">AUTHOR</label>
                    <div class="col-lg-10">
                        <input type="text" readonly class="form-control" name="reportAuthor" id="reportAuthor">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Report</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ITEM</th>
                                <th>AC</th>
                                <th>PC</th>
                                <th>EV</th>
                                <th>CV</th>
                                <th>STATUS</th>
                                <th>SV</th>
                                <th>STATUS</th>
                                <th>CPI</th>
                                <th>STATUS</th>
                                <th>SPI</th>
                                <th>STATUS</th>
                                <th>EAC1</th>
                                <th>EAC2</th>
                                <th>EAC3</th>
                                <th>EAC4</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <h5>TOTAL</h5>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-12 col-form-label">Actual Progress Cost</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly name="all_ac" id="all_ac">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-12 col-form-label">Planned Cost</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly name="all_ac" id="all_pc">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h5>TOTAL</h5>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-12 col-form-label">Earn Value</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly name="all_ev" id="all_ev">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-12 col-form-label">Cost Variance</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly name="all_cv" id="all_cv">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-12 col-form-label">Scheduled Value</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly name="all_sv" id="all_sv">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-12 col-form-label">CPI</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly name="all_cpi" id="all_cpi">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-12 col-form-label">SPI</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly name="all_spi" id="all_spi">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h5>ESTIMATE AT COMPLETION (EAC)</h5>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-12 col-form-label">Alternative EAC 1</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly name="all_eac1" id="all_eac1">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-12 col-form-label">Alternative EAC 2</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly name="all_eac2" id="all_eac2">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-12 col-form-label">Alternative EAC 3</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly name="all_eac3" id="all_eac3">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-12 col-form-label">Alternative EAC 4</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" readonly name="all_eac4" id="all_eac4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row float-right">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body text-center">
                        <button type="button" class="btn btn-primary  waves-effect waves-light m-1" id="btn-submit-add"><i class="fa fa-save"></i> Save Report</button>
                    </div>
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
                    <form>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">REPORT DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">TITLE</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">AUTHOR</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">MONTH</label>
                            <div class="col-sm-10">
                                <select class="form-control">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">YEAR</label>
                            <div class="col-sm-10">
                                <select class="form-control">
                                    <option></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group float-right">

                            <button type="submit" class="btn btn-success px-5"><i class="fa fa-save"></i> Save</button>
                            <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>

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
        var arr_report_data = JSON.parse(localStorage.getItem("reportTitle"));
        $('#reportTitle').val(arr_report_data[0]);
        $('#reportDate').val(arr_report_data[1]);
        $('#reportAuthor').val(arr_report_data[2]);

        //Default data table
        $('#default-datatable').DataTable();

        var table = $('#example').DataTable({
            lengthChange: false,
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            buttons: [{
                text: 'PRINT',
                extend:'print'
            }],
            ajax: {
                url: '/getPerformance',
                method: "POST",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                    contractorID: arr_report_data[5]
                }
            },
            columns: [{
                    data: "no"
                },
                {
                    data: "itemName"
                },
                {
                    data: "TOTAL_ACTUAL_COST",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "ACC_TOTAL_PLANNED_COST",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "EV",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "CV",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "status_1"
                },
                {
                    data: "SV",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "status_2"
                },
                {
                    data: "CPI",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "status_3"
                },
                {
                    data: "SPI",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "status_4"
                },
                {
                    data: "EAC1",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "EAC2"
                },
                {
                    data: "EAC3",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "EAC4",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }
            ],
            initComplete: function() {
                table.buttons().container()
                    .appendTo('#example_wrapper .col-md-6:eq(0)');
            }
        });

        $.ajax({
            type: "POST",
            url: '/getPerformance',
            data: {
                _token: "{{ csrf_token() }}",
                contractorID: arr_report_data[5]
            },
            async: false
        }).done(function(data) {
            datob = JSON.parse(data);
            if (datob.length > 0) {
                $("#all_ac").val(datob[0].ALL_ACTUAL_COST);
                $("#all_pc").val(datob[0].ALL_PLAN_COST);
                $("#all_ev").val(datob[0].ALL_EV);
                $("#all_cv").val(datob[0].ALL_CV);
                $("#all_sv").val(datob[0].ALL_SV);
                $("#all_cpi").val(datob[0].ALL_CPI);
                $("#all_spi").val(datob[0].ALL_SPI);
                $("#all_eac1").val(datob[0].ALL_EAC1);
                $("#all_eac3").val(datob[0].ALL_EAC3);
                $("#all_eac4").val(datob[0].ALL_EAC4);
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

        var total_eac2 = 0;
        $('#example tbody').on('change', '.EAC2', function() {
            $('#all_eac2').val('');
            total_eac2 += parseInt(this.value);
            $('#all_eac2').val(parseInt($("#all_ac").val())+total_eac2);
        })

        $('#btn-submit-add').click(function() {
            $.ajax({
                type: "POST",
                url: '/saveReport',
                data: "_token=" + '{{ csrf_token() }}' +
                    "&title=" + arr_report_data[0] + "&date=" + arr_report_data[1] + "&createdby=" + arr_report_data[2] + "&description=Performance" + "&contractorID=" + arr_report_data[5] + "&eac2=" +  $('#all_eac2').val(),
                async: false,
                dataType:"JSON"
            }).done(function(data) {
                if(data.status!='fail'){
                    successAlert('Create', arr_report_data[0], 'success');
                    localStorage.clear(); 
                    setTimeout(function(){ window.location="/performanceanalysis" }, 2000);
                }else{
                    successAlert('Create', arr_report_data[0], 'error');
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
        })

    });



    $('#btn-formmodaladdimage').click(function() {
        $('#formmodaldetail').modal('hide');
    });
</script>
@endsection