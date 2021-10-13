@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card-body">
            <a href="/progress-report" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Progress Report</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-project-tab" data-toggle="tab" href="#nav-project" role="tab" aria-controls="nav-home" aria-selected="true">Project Info</a>
                        <a class="nav-item nav-link" id="nav-status-tab" data-toggle="tab" href="#nav-status" role="tab" aria-controls="nav-profile" aria-selected="false">Progress Status</a>
                        <a class="nav-item nav-link" id="nav-actual-tab" data-toggle="tab" href="#nav-actual" role="tab" aria-controls="nav-contact" aria-selected="false">Detail Actual Progress</a>
                        <a class="nav-item nav-link" id="nav-curve-tab" data-toggle="tab" href="#nav-curve" role="tab" aria-controls="nav-profile" aria-selected="false">Curve & Table Monitoring</a>
                    </div>
                </nav>
            </div>
            <div class="card-body">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-project" role="tabpanel" aria-labelledby="nav-project-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase">PROJECT DATA</div>
                                    <div class="card-body" style="height:100%">
                                        <div class="table-responsive">
                                            <table id="projectData" class="table table-bordered">
                                                <tr>
                                                    <td style="width:50%">PROJECT NAME</td>
                                                    <td><input type="text" class="form-control" id="projectName" name="projectName" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>DESCRIPTION</td>
                                                    <td><textarea class="form-control" id="projectDesc" name="projectDesc" readonly></textarea></td>
                                                </tr>
                                                <tr>
                                                    <td>PROJECT MANAGER</td>
                                                    <td><input type="text" class="form-control" id="projectManager" name="projectManager" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>CONTRACTOR NAME</td>
                                                    <td><input type="text" class="form-control" id="contractorName" name="contractorName" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>PROJECT MANAGEMENT AND SUPERVISOR CONSULTANT</td>
                                                    <td><input type="text" class="form-control" id="projectManagement" name="projectManagement" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>COMMENCEMENT DATE</td>
                                                    <td><input type="text" class="form-control" id="commencementDate" name="commencementDate" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>COMPLETION DATE</td>
                                                    <td><input type="text" class="form-control" id="completionDate" name="completionDate" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>CONSTRUCTION PERIOD (DAYS)</td>
                                                    <td><input type="text" class="form-control" id="constructionPeriod" name="constructionPeriod" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>CONTRACT AMOUNT</td>
                                                    <td><input type="text" class="form-control" id="contractAmount" name="contractAmount" readonly></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase">SUMMARY OF PHYSICAL WORK PROGRESS</div>
                                    <div class="card-body" style="height:100%">
                                        <div class="table-responsive">
                                            <table id="physicalWork" class="table table-bordered">
                                                <tr>
                                                    <td style="width:50%">TIME ELAPSED (DAYS)</td>
                                                    <td><input type="text" class="form-control" id="elapsedDay" name="elapsedDay" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>TIME ELAPSED (%)</td>
                                                    <td><input type="text" class="form-control" id="elapsedPercent" name="elapsedPercent" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>SCHEDULED PROGRESS(%)</td>
                                                    <td><input type="text" class="form-control" id="scheduleProgress" name="scheduleProgress" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>ACTUAL OVERALL PROGRESS (%)</td>
                                                    <td><input type="text" class="form-control" id="actualProgress" name="actualProgress" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>BALANCE (%)</td>
                                                    <td><input type="text" class="form-control" id="balance" name="balance" readonly></td>
                                                </tr>
                                                <tr>
                                                    <td>PROGRESS THIS MONTH (%)</td>
                                                    <td><input type="text" class="form-control" id="progressThisMonth" name="progressThisMonth" readonly></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="nav-status" role="tabpanel" aria-labelledby="nav-status-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase">PROGRESS STATUS</div>
                                    <div class="card-body" style="height:100%">
                                        <div class="table-responsive">
                                            <table id="progressStatus" class="table table-bordered" style="width:50%">
                                                <tr>
                                                    <td>TIME STATUS (%)</td>
                                                    <td><input type="text" class="form-control" id="timeStatus" name="timeStatus" readonly></td>
                                                    <td id="timeIndicator"></td>

                                                </tr>
                                                <tr>
                                                    <td>COST STATUS (%)</td>
                                                    <td><input type="text" class="form-control" id="costStatus" name="costStatus" readonly></td>
                                                    <td id="costIndicator"></i></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab-2" role="tablist">
                                                <a class="nav-item nav-link active" id="nav-issue-tab" data-toggle="tab" href="#nav-issue" role="tab" aria-controls="nav-issue" aria-selected="true">Issue</a>
                                                <a class="nav-item nav-link" id="nav-risk-tab" data-toggle="tab" href="#nav-risk" role="tab" aria-controls="nav-risk" aria-selected="false">Risks</a>
                                            </div>
                                        </nav>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade show active" id="nav-issue" role="tabpanel" aria-labelledby="nav-project-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header text-uppercase">MAJOR PROBLEMS</div>
                                                            <div class="card-body" style="height:100%">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <table id="issueTable" class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Description</th>
                                                                                    <th>Resolution</th>
                                                                                    <th>Level</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div id="donut-chart-issue"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="nav-risk" role="tabpanel" aria-labelledby="nav-status-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card">
                                                            <div class="card-header text-uppercase">RISKS</div>
                                                            <div class="card-body" style="height:100%">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <table id="riskTable" class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Description</th>
                                                                                    <th>Mitigation</th>
                                                                                    <th>Level</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div id="donut-chart-risk"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-actual" role="tabpanel" aria-labelledby="nav-actual-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase">Detail Actual Progress</div>
                                    <div class="card-body" style="height:100%">
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
                                                        <th>START DATE</th>
                                                        <th>END DATE</th>
                                                        <th>ESTIMATED QTY</th>
                                                        <th>UNIT PRICES</th>
                                                        <th>TOTAL AMOUNT</th>
                                                        <th>QTY ACCUMULATIVE LAST MONTH</th>
                                                        <th>QTY THIS MONTH</th>
                                                        <th>QTY ACCUMULATIVE THIS MONTH</th>
                                                        <th>AMOUNT</th>
                                                        <th>ACTUAL PROGRESS (%)</th>
                                                        <!-- <th>ACTION</th> -->
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
                    </div>
                    <div class="tab-pane fade" id="nav-curve" role="tabpanel" aria-labelledby="nav-curve-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase">PHYSICAL PROGRESS MONITORING CURVE</div>
                                    <div class="card-body" style="height:100%">
                                        <div id="line-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase">PHYSICAL PROGRESS MONITORING TABLE</div>
                                    <div class="card-body" style="height:100%">
                                        <div class="table-responsive">
                                            <table id="table1" class="table table-bordered text-center">
                                            </table>
                                        </div>
                                        <div id="table2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
<script>
    $('#default-datatable').DataTable();
    var table = $('#example').DataTable({
        lengthChange: false,
        //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
        buttons: ['print'],
        ajax: {
            url: '/getActualWbsDetail',
            method: "POST",
            dataSrc: "",
            data: {
                _token: "{{ csrf_token() }}",
                id: <?php echo $docID; ?>,
                contractorID: <?php echo $contractorID; ?>
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
        autoWidth:true,
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
                data: "startDate"
            },
            {
                "className": 'details-control',
                data: "endDate"
            },
            {
                "className": 'details-control',
                data: "qty",

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
                data: "accumulatedLastMonthQty"
            },
            {
                "className": 'details-control',
                data: "thisMonth"
            },
            {
                "className": 'details-control',
                data: "accumulatedThisMonth"
            },
            {
                "className": 'details-control',
                data: "actualAmount"
            },
            {
                "className": 'details-control',
                data: "actualProgress"
            }
            // {
            //     data: "action"
            // }
        ],
        initComplete: function() {
            table.buttons().container()
                .appendTo('#example_wrapper .col-md-6:eq(0)');
        }
    });

    $.ajax({
        type: "POST",
        url: '/getProjectDetail',
        data: {
            _token: "{{ csrf_token() }}",
            contractorID: <?php echo $contractorID; ?>
        },
        dataType: "JSON"
    }).done(function(data) {
        console.log(data);
        $('#projectName').val(data[0].ProjectName);
        $('#projectDesc').val(data[0].ProjectDesc);
        $('#projectManager').val(data[0].PersonilName);
        $('#contractorName').val(data[0].BussinessName);
        $('#projectManagement').val(data[0].BussinessName);
        $('#commencementDate').val(data[0].CommencementDate);
        $('#completionDate').val(data[0].CompletionDate);
        $('#contractAmount').val(data[0].ContractAmount.toLocaleString("id-ID"));
        $('#constructionPeriod').val(data[0].ProjectDuration);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        errorAlertServer('Response Not Found, Please Check Your Data');
    });

    $.ajax({
        type: "POST",
        url: '/getWorkProgress',
        data: {
            _token: "{{ csrf_token() }}",
            contractorID: <?php echo $contractorID; ?>,
            docID: <?php echo $docID; ?>
        },
        dataType: "JSON"
    }).done(function(data) {
        console.log(data);
        $('#elapsedDay').val(data[0].timeelapsed);
        $('#elapsedPercent').val(data[0].percentelapse);
        $('#scheduleProgress').val(data[0].scheduledProgress);
        $('#actualProgress').val(data[0].actualProgress);
        $('#progressThisMonth').val(data[0].thisMonthProgress);
        $('#balance').val(data[0].balance);
        $('#timeIndicator').html(data[0].timestatus);
        $('#costIndicator').html(data[0].coststatus);
        $('#timeStatus').val(data[0].percentelapse);
        $('#costStatus').val(data[0].cost);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        errorAlertServer('Response Not Found, Please Check Your Data');
    });

    $('#nav-tab a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        $.ajax({
            type: "POST",
            url: '/getIssueReport',
            data: {
                _token: "{{ csrf_token() }}",
                contractorID: <?php echo $contractorID; ?>
            },
            dataType: "JSON"
        }).done(function(data) {
            var row = "";
            for (let i = 0; i < data.length; i++) {
                row += '<tr><td>' + data[i].description + '</td><td>' + data[i].resolution + '</td><td>' + data[i].priority + '</td></tr>';
            }
            $('#issueTable tbody').html(row);
            arrayData = data;

            $('#riskTable tbody').html(row);
            $("#donut-chart-issue").empty();
            Morris.Donut({
                element: 'donut-chart-issue',
                data: [{
                        value: arrayData[0].high,
                        label: 'High'
                    },
                    {
                        value: arrayData[0].medium,
                        label: 'Medium'
                    },
                    {
                        value: arrayData[0].low,
                        label: 'Low'
                    }
                ],
                colors: [
                    '#eb5076',
                    '#eea930',
                    '#008000'
                ],
                resize: true,
                labelColor: "#ffffff",
                formatter: function(x) {
                    return x + "%"
                }
            });
        }).fail(function(jqXHR, textStatus, errorThrown) {
            errorAlertServer('Response Not Found, Please Check Your Data');
        });

    

        $.ajax({
            type: "POST",
            url: '/monitoringCurve',
            data: {
                _token: "{{ csrf_token() }}",
                contractorID: <?php echo $contractorID; ?>
            },
            dataType: "JSON"
        }).done(function(data) {
            
            $("#line-chart").empty();
            Morris.Area({
                element: 'line-chart',
                behaveLikeLine: true,
                data: data,
                xkey: 'month',
                parseTime: false,
                ykeys: ['baseline', 'actual', 'current'],
                labels: ['Baseline', 'Actual', 'Current'],
                lineColors: ['#fba540', '#03d0ea', '#05dea0'],
                resize: true,
                gridTextColor: "#ddd",
                fillOpacity: 0.1,
                hideHover:true  
            });
        }).fail(function(jqXHR, textStatus, errorThrown) {
            errorAlertServer('Response Not Found, Please Check Your Data');
        });

        $.ajax({
            type: "POST",
            url: '/monitoringTable',
            data: {
                _token: "{{ csrf_token() }}",
                contractorID: <?php echo $contractorID; ?>
            }
            // dataType: "JSON"
        }).done(function(data) {
            $('#table1').html(data);
        }).fail(function(jqXHR, textStatus, errorThrown) {
            errorAlertServer('Response Not Found, Please Check Your Data');
        });
    });

    $('#nav-tab-2 a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        $.ajax({
            type: "POST",
            url: '/getRiskReport',
            data: {
                _token: "{{ csrf_token() }}",
                contractorID: <?php echo $contractorID; ?>
            },
            dataType: "JSON"
        }).done(function(data) {
            var row = "";
            for (let i = 0; i < data.length; i++) {
                row += '<tr><td>' + data[i].DescriptionRisk + '</td><td>' + data[i].Mitigation + '</td><td>' + data[i].Rank + '</td></tr>';
            }
            arrayData = data;
console.log(arrayData);
            $('#riskTable tbody').html(row);
            $("#donut-chart-risk").empty();
            Morris.Donut({
                element: 'donut-chart-risk',
                data: [{
                        value: arrayData[0].high,
                        label: 'High'
                    },
                    {
                        value: arrayData[0].medium,
                        label: 'Medium'
                    },
                    {
                        value: arrayData[0].low,
                        label: 'Low'
                    }
                ],
                colors: [
                    '#eb5076',
                    '#eea930',
                    '#008000'
                ],
                resize: true,
                labelColor: "#ffffff",
                formatter: function(x) {
                    return x + "%"
                }
            });
        }).fail(function(jqXHR, textStatus, errorThrown) {
            errorAlertServer('Response Not Found, Please Check Your Data');
        });

    });
</script>
@endsection