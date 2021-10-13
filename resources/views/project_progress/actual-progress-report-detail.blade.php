@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-4">
        <div class="card-body">
            <a href="/actualprogress" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Actual Report</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-detail-tab" data-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-home" aria-selected="true">Detail</a>
                        <a class="nav-item nav-link" id="nav-curve-tab" data-toggle="tab" href="#nav-curve" role="tab" aria-controls="nav-profile" aria-selected="false">S-Curve</a>
                        <a class="nav-item nav-link" id="nav-financial-tab" data-toggle="tab" href="#nav-financial" role="tab" aria-controls="nav-contact" aria-selected="false">Financial Reports</a>
                    </div>
                </nav>
            </div>
            <div class="card-body">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-detail" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form id="progressForm">
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
                        </form>
                        <div class="row mt-3">
                            <div class="col-lg-12 mt-3">
                                <div class="row mt-3">
                                    <div class="col-lg-4 mt-3">
                                        <label class="float-right">Estimated Amount</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control float-right" id="totalEstimatedAmount" readonly>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                        <label class="float-right">Accumulative Last Month</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="totalAccumulateLastMonth" readonly>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                        <label class="float-right">This Month</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="totalThisMonth" readonly>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                        <label class="float-right">Accumulative This Month</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" id="totalAccumulateThisMonth" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3 float-right">

                            <button class="btn btn-warning px-5"><i class="fa fa-print"></i> Generate Progress Report</button>
                            <a class="btn btn-primary px-5" href="/payment-certificate-report/{{$docID}}"><i class="fa fa-money"></i> Generate Payment</a>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-curve" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase">Line Chart</div>
                                    <div class="card-body" style="height:100%">
                                        <div id="bar-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-financial" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header text-uppercase">Line Chart</div>
                                    <div class="card-body" style="height:100%">
                                        <div id="bar-chart-finance"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <form>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">REPORTING TITLE</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-25">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">REPORTING DATE</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="input-25">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">CREATED BY</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="input-25">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DESCRIPTION</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" placeholder="Enter Your Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group float-right">

                            <button type="submit" class="btn btn-success px-5"><i class="fa fa-plus"></i> Create Detail Item</button>
                            <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>

                        </div>
                    </form>
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
            url: '/getActualWbschild',
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
                        '<td>' + datob[i].startDate + '</td>' +
                        '<td>' + datob[i].endDate + '</td>' +
                        '<td>' + datob[i].qty + '</td>' +
                        '<td>' + datob[i].price + '</td>' +
                        '<td>' + datob[i].cost + '</td>' +
                        '<td>' + datob[i].accumulatedLastMonthQty + '</td>' +
                        '<td>' + datob[i].thisMonth + '</td>' +
                        '<td id="accumulatedThisMonth' + datob[i].id + '"></td>' +
                        '<td id="actualAmount' + datob[i].id + '"></td>' +
                        '<td id="actualProgress' + datob[i].id + '"></td></tr>';
                }
            }

        }).fail(function(jqXHR, textStatus, errorThrown) {
            errorAlertServer('Response Not Found, Please Check Your Data');
        });
        return xHead + '' + xBody + '' + xFoot;
    }

    $(document).ready(function() {
        //Default data table
        var data_chart = [];
        $('#default-datatable').DataTable();

        var arr = JSON.parse(localStorage.getItem("reportData"));

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
        var totalAccumulateThisMonth = 0;
        var totalThisMonth = 0;
        var totalAccumulateLastMonth = 0;
        var periode = 0;
        var contractorID = 0;

        $.ajax({
            type: "POST",
            url: '/getActualWbsDetail',
            data: {
                _token: "{{ csrf_token() }}",
                id: <?php echo $docID; ?>,
                contractorID: <?php echo $contractorID; ?>
            },
            async: false
        }).done(function(data) {
            datob = JSON.parse(data);
            console.log(<?php echo $docID; ?>);
            if (datob.length > 0) {
                console.log(datob[0].totalThisMonth);
                $('#totalAccumulateThisMonth').val(parseInt(datob[0].totalThisMonth) + parseInt(datob[0].totalLastMonth));
                $('#totalEstimatedAmount').val(datob[0].totalEstimated);
                $('#totalThisMonth').val(datob[0].totalThisMonth);
                $('#totalAccumulateLastMonth').val(datob[0].totalLastMonth);
                var dt = new Date(datob[0].periode);
                periode = dt.getMonth();
                contractorID = datob[0].contractorID;

            }


        }).fail(function(jqXHR, textStatus, errorThrown) {
            errorAlertServer('Response Not Found, Please Check Your Data');
        });


        $('#btn-submit-progress').click(function(e) {

            var arr = JSON.parse(localStorage.getItem("reportData"));

            $.ajax({
                type: "POST",
                url: '/submitProgress',
                data: $('#progressForm').serialize() + "&_token=" + '{{ csrf_token() }}' +
                    "&title=" + arr[0] + "&date=" + arr[1] + "&createdby=" + arr[2] + "&description=" + arr[3]
            }).done(function(msg) {
                datob = JSON.parse(msg);
                if (datob != 'error') {
                    successAlert('Create', arr[0], 'success');
                    localStorage.removeItem("reportData");
                    window.location = '/actualprogress';
                } else {
                    errorAlert('Create', arr[0], 'error');

                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
            // x = $('#progressForm').serializeArray();
            // data_chart = [];
            // date_chart = "";
            // total = 0;
            // data_chart.push({
            //     x: 0,
            //     y: 0
            // });
            // $.each(x, function(i, field) {

            //     if (field.name.search('form-endDate') == 0) {
            //         date_chart = field.value;
            //     }
            //     if (field.name.search('form-actual-amount') == 0) {
            //         total += parseInt(field.value);
            //     }
            // });
            // data_chart.push({
            //     x: 1,
            //     y: total
            // });
            // data_chart.sort((a, b) => (a.x > b.x) ? 1 : ((b.x > a.x) ? -1 : 0))
            // console.log(data_chart);
            // var target = $(e.target).attr("href") // activated tab
            // $("#line-chart").empty();
            // var curve = Morris.Area({
            //     element: 'line-chart',
            //     behaveLikeLine: true,
            //     resize: true,
            //     data: data_chart,
            //     xkey: 'x',
            //     ykeys: ['y'],
            //     labels: ['Y'],
            //     lineColors: ['#fba540'],
            //     resize: true,
            //     gridTextColor: "#ddd",
            //     fillOpacity: 0.1,
            // });

            // switch (target) {
            //     case "#nav-curve":
            //         curve.redraw();
            //         $(window).trigger('resize');
            //         break;
            // }
            $.ajax({
                type: "POST",
                url: '/getCurrentWbsChartProgress',
                data: {
                    _token: "{{ csrf_token() }}",
                    contractorID: contractorID,
                },
                dataType: "JSON"
            }).done(function(data) {
                data[periode].current = $('#totalThisMonth').val();
                // for(let i=0;i<data.length;i++){
                //     console.log($('#totalThisMonth').val());
                // }
                $("#bar-chart").empty();
                Morris.Bar({
                    element: 'bar-chart',
                    data: data,
                    xkey: 'x',
                    ykeys: ['baseline', 'actual', 'current'],
                    labels: ['Baseline', 'Actual', 'Current'],
                    barColors: ['#03d0ea', '#d13adf', '#fba540'],
                    gridTextColor: "#ddd",
                    resize: true
                });

                $("#bar-chart-finance").empty();
                console.log(data[0]);
                let arrTemp = [];
                arrTemp.push(data[0]);

                Morris.Bar({
                    element: 'bar-chart-finance',
                    data: arrTemp,
                    xkey: 'x',
                    ykeys: ['totalCostEstimate', 'current'],
                    labels: ['Baseline', 'Actual'],
                    barColors: ['#03d0ea', '#d13adf', '#fba540'],
                    gridTextColor: "#ddd",
                    resize: true
                });
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
        });



    });
</script>
@endsection