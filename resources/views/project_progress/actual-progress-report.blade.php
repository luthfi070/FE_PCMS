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
                                            <th>QTY ACC LAST MONTH</th>
                                            <th>QTY THIS MONTH</th>
                                            <th>QTY ACC THIS MONTH</th>
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
                                        <input type="number" class="form-control float-right" id="totalEstimatedAmount" value=0 readonly>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                        <label class="float-right">Accumulative Last Month</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" id="totalAccumulateLastMonth" value=0 readonly>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                        <label class="float-right">This Month</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" id="totalThisMonth" value=0 readonly>
                                    </div>
                                    <div class="col-lg-4 mt-3">
                                        <label class="float-right">Accumulative This Month</label>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" id="totalAccumulateThisMonth" value=0 readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-3 float-right">
                            <button class="btn btn-success px-5" id="btn-submit-progress"><i class="fa fa-save"></i>Save</button>
                            <button class="btn btn-warning px-5"><i class="fa fa-print"></i> Generate Progress Report</button>
                            <button class="btn btn-primary px-5"><i class="fa fa-money"></i> Generate Payment</button>
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
                                    <div class="card-header text-uppercase">Financial Chart</div>
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
                            <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>

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
                url: '/getActualWbs',
                method: "POST",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                    contractorID: arr[4]
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
            autoWidth: true,
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
                    data: "qty"
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
            url: '/getActualWbs',
            data: {
                _token: "{{ csrf_token() }}",
                contractorID: arr[4]
            },
            async: false
        }).done(function(data) {
            datob = JSON.parse(data);

            if (datob.length > 0) {
                if(datob[0].TotalaccumulatedLastMonthQty=="" || datob[0].TotalaccumulatedLastMonthQty==null){
                    $('#totalAccumulateLastMonth').val(0);
                }else{
                    $('#totalAccumulateLastMonth').val(datob[0].TotalaccumulatedLastMonthQty);
                }
                
            }


        }).fail(function(jqXHR, textStatus, errorThrown) {
            errorAlertServer('Response Not Found, Please Check Your Data');
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
        $('#totalAccumulateThisMonth').val(0);
        $('#totalEstimatedAmount').val(0);
        $('#totalThisMonth').val(0);
        //$('#totalAccumulateLastMonth').val("0");
        $('#example tbody').on('change', '.form-this-month', function() {
            var direction = this.defaultValue < this.value;
            var lama = this.defaultValue;
            var baru = this.value;
            this.defaultValue = this.value;


            var ids = $(this).attr('data-ids');
            var id = $(this).data("id");
            var inp = $(this).val();


            $.ajax({
                type: "POST",
                url: '/getDetailActualWbsChild',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: ids
                },
                async: false
            }).done(function(data) {
                datob = JSON.parse(data);

                if (datob.length > 0) {

                    var accumulatedThisMonth = (parseInt(inp) + parseInt($('#form-last-month-accumulated' + ids).val()));
                    var actualAmount = datob[0].price * accumulatedThisMonth;
                    var actualProgress = (actualAmount / datob[0].totalEstimated) * 100;
                    $('#form-this-month-accumulated' + ids).val(accumulatedThisMonth);
                    $('#form-actual-amount' + ids).val(actualAmount);
                    $('#form-actual-progress' + ids).val(actualProgress.toFixed(2));
                    if (direction) {
                        totalAccumulateThisMonth += (parseInt($('#form-last-month-accumulated' + ids).val()) + (baru - lama)) * datob[0].price;
                        totalAccumulateLastMonth += parseInt($('#form-last-month-accumulated' + ids).val()) * datob[0].price;
                        totalThisMonth += datob[0].price * (baru - lama);
                    } else {
                        totalAccumulateThisMonth -= (parseInt($('#form-last-month-accumulated' + ids).val()) + (lama - baru)) * datob[0].price;
                        totalAccumulateLastMonth -= parseInt($('#form-last-month-accumulated' + ids).val()) * datob[0].price;
                        totalThisMonth -= datob[0].price * (lama - baru);
                    }

                    $('#totalAccumulateThisMonth').val(parseInt($('#totalAccumulateLastMonth').val()) + totalThisMonth);
                    $('#totalEstimatedAmount').val(datob[0].totalEstimated);
                    $('#totalThisMonth').val(totalThisMonth);
                    // $('#totalAccumulateLastMonth').val(totalAccumulateLastMonth);

                }


            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

        });

        $('#btn-submit-progress').click(function(e) {

            var arr = JSON.parse(localStorage.getItem("reportData"));

            $.ajax({
                type: "POST",
                url: '/submitProgress',
                data: $('#progressForm').serialize() + "&_token=" + '{{ csrf_token() }}' +
                    "&title=" + arr[0] + "&date=" + arr[1] + "&createdby=" + arr[2] + "&description=" + arr[3] + "&contractorID=" + arr[4]
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
            var dt = new Date(arr[1]);
            var month = dt.getMonth();

            x = $('#progressForm').serializeArray();
            data_chart = [];
            date_chart = "";
            total = 0;
            data_chart.push({
                x: 0,
                y: 0
            });
            $.each(x, function(i, field) {

                if (field.name.search('form-endDate') == 0) {
                    date_chart = field.value;
                }
                if (field.name.search('form-actual-amount') == 0) {
                    total += parseInt(field.value);
                }
            });
            data_chart.push({
                x: 1,
                y: total
            });
            data_chart.sort((a, b) => (a.x > b.x) ? 1 : ((b.x > a.x) ? -1 : 0))
            console.log(data_chart);
            var target = $(e.target).attr("href") // activated tab
            $.ajax({
                type: "POST",
                url: '/getCurrentWbsChartProgress',
                data: {
                    _token: "{{ csrf_token() }}",
                    contractorID: arr[4],
                },
                dataType: "JSON"
            }).done(function(data) {
                data[month].current = $('#totalThisMonth').val();
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
            // $("#bar-chart").empty();
            // Morris.Bar({
            //     element: 'bar-chart',
            //     data: data,
            //     xkey: 'x',
            //     ykeys: ['baseline', 'actual'],
            //     labels: ['Baseline', 'Actual'],
            //     barColors: ['#03d0ea', '#d13adf', '#fba540'],
            //     gridTextColor: "#ddd",
            //     resize: true
            // });

            // switch (target) {
            //     case "#nav-curve":
            //         curve.redraw();
            //         $(window).trigger('resize');
            //         break;
            // }
        });



    });
</script>
@endsection