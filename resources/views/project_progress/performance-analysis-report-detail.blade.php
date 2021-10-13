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
                            <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>

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
        // var arr_report_data = JSON.parse(localStorage.getItem("reportTitle"));
        // $('#reportTitle').val(arr_report_data[0]);
        // $('#reportDate').val(arr_report_data[1]);
        // $('#reportAuthor').val(arr_report_data[2]);

        //Default data table
        $('#default-datatable').DataTable();

        var table = $('#example').DataTable({
            lengthChange: false,
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            buttons: [{
                text: 'PRINT',
                className: 'btn-primary',
                action: function(e, dt, button, config) {

                }
            }],
            ajax: {
                url: '/getPerformanceDetail',
                method: "POST",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                    docID: <?php echo $id; ?>
                }
            },
            columns: [{
                    data: "no"
                },
                {
                    data: "itemName"
                },
                {
                    data: "AC",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "PC",
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
                    data: "EAC2",
                    render: $.fn.dataTable.render.number(',', '.', 2)
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
            url: '/getPerformanceDetail',
            data: {
                _token: "{{ csrf_token() }}",
                docID: <?php echo $id; ?>
            },
            async: false
        }).done(function(data) {
            datob = JSON.parse(data);
            if (datob.length > 0) {
                $('#reportTitle').val(datob[0].documentName);
                $('#reportDate').val(datob[0].reportingDate.split(" ")[0]);
                $('#reportAuthor').val(datob[0].Userfullname);
                var ALL_ACTUAL_COST=0;
                var ALL_PLAN_COST=0;
                var ALL_EV=0;
                var ALL_CV=0;
                var ALL_SV=0;
                var ALL_CPI=0;
                var ALL_SPI=0;
                var ALL_EAC1=0;
                var ALL_EAC2=0;
                var ALL_EAC3=0;
                var ALL_EAC4=0;
                for(let i=0;i<datob.length;i++){
                    ALL_ACTUAL_COST += datob[i].AC;
                    ALL_PLAN_COST +=  datob[i].AC;
                    ALL_EV +=  datob[i].AC;
                    ALL_CV +=  datob[i].CV;
                    ALL_SV +=  datob[i].SV;
                    ALL_CPI +=  datob[i].CPI;
                    ALL_SPI +=  datob[i].SPI;
                    ALL_EAC1 +=  datob[i].EAC1;
                    ALL_EAC2 +=  datob[i].EAC2;
                    ALL_EAC3 +=  datob[i].EAC3;
                    ALL_EAC4 +=  datob[i].EAC4;
                }
                $("#all_ac").val(ALL_ACTUAL_COST.toLocaleString('id-ID'));
                $("#all_pc").val(ALL_PLAN_COST.toLocaleString('id-ID'));
                $("#all_ev").val(ALL_EV.toLocaleString('id-ID'));
                $("#all_cv").val(ALL_CV.toLocaleString('id-ID'));
                $("#all_sv").val(ALL_SV.toLocaleString('id-ID'));
                $("#all_cpi").val(ALL_CPI.toLocaleString('id-ID'));
                $("#all_spi").val(ALL_SPI.toLocaleString('id-ID'));
                $("#all_eac1").val(ALL_EAC1.toLocaleString('id-ID'));
                $("#all_eac2").val(ALL_EAC2.toLocaleString('id-ID'));
                $("#all_eac3").val(ALL_EAC3.toLocaleString('id-ID'));
                $("#all_eac4").val(ALL_EAC4.toLocaleString('id-ID'));
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
            errorAlertServer('Response Not Found, Please Check Your Data');
        });

        var total_eac2 = 0;
        $('#example tbody').on('change', '.EAC2', function() {
            $('#all_eac2').val('');
            total_eac2 += parseInt(this.value);
            $('#all_eac2').val(parseInt($("#all_ac").val()) + total_eac2);
        })

        // $('#btn-submit-add').click(function() {
        //     $.ajax({
        //         type: "POST",
        //         url: '/saveReport',
        //         data: "_token=" + '{{ csrf_token() }}' +
        //             "&title=" + arr_report_data[0] + "&date=" + arr_report_data[1] + "&createdby=" + arr_report_data[2] + "&description=Performance" + "&contractorID=" + arr_report_data[5] + "&eac2=" +  $('#all_eac2').val(),
        //         async: false,
        //         dataType:"JSON"
        //     }).done(function(data) {
        //         if(data.status!='fail'){
        //             successAlert('Create', arr_report_data[0], 'success');
        //             setTimeout(function(){ window.location="/performanceanalysis" }, 2000);
        //         }else{
        //             successAlert('Create', arr_report_data[0], 'error');
        //         }
        //     }).fail(function(jqXHR, textStatus, errorThrown) {
        //         errorAlertServer('Response Not Found, Please Check Your Data');
        //     });
        // })

    });



    $('#btn-formmodaladdimage').click(function() {
        $('#formmodaldetail').modal('hide');
    });
</script>
@endsection