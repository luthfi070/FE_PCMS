@extends('app')
@section('content')
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
                <div class="row">
                    <div class="col-lg-2">
                        <a href="/boq" class="btn btn-secondary waves-effect waves-light"><i class="fa fa-arrow-left"></i>Back</a>
                    </div>
                    <div class="col-lg-10">
                        <h4 class="text-center">History Bill of Quantity</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> History Version</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="version" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>VERSION</th>
                                <th>LAST MODIFICATION</th>
                                <th>MODIFICATION BY</th>
                                <th>TOTAL ITEM</th>
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

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Bill of Quantity Detail</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="history" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>INDEX</th>
                                <th>ID</th>
                                <th>PARENTITEM</th>
                                <th>CHILD</th>
                                <th>ITEM</th>
                                <th>UNIT</th>
                                <th>QTY</th>
                                <th>CURRENCY</th>
                                <th>UNIT PRICES</th>
                                <th>COST</th>
                                <th>WEIGHT (%)</th>
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
@endsection
@section('script')
<script>
    $(document).ready(function() {
        //Default data table
        $('#default-datatable').DataTable();

        var table = $('#history').DataTable();

        $('#version').DataTable({
            lengthChange: false,
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            ajax: {
                url: '/getBoqHistory',
                method: "GET",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                }
            },
            columns: [{
                    data: "no"
                },
                {
                    data: "version"
                },
                {
                    data: "created_at"
                },
                {
                    data: "Created_By"
                },
                {
                    data: "total_item"
                },
                {
                    data: "action"
                }
            ]
        });

        $('#version tbody').on('click', '.detail-btn', function() {
            var idContractor = $(this).attr("data-idContractor");
            var createdAt = $(this).attr("data-createdAt");
            var idProject = $(this).attr("data-idProject");

            detailBoq(idProject, idContractor, createdAt);
        });

        function detailBoq(ProjectID, contractorID, created_at) {

            table.destroy();
            table = $('#history').DataTable({
                lengthChange: false,

                ajax: {
                    url: '/getBoqHistoryDetail',
                    method: "POST",
                    dataSrc: "",
                    data: {
                        _token: "{{ csrf_token() }}",
                        ProjectID: ProjectID,
                        contractorID: contractorID,
                        created_at: created_at
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
                columns: [{
                        "className": 'details-control',
                        data: "merge"
                    }, {
                        "className": 'details-control',
                        data: "no"
                    },
                    {
                        "className": 'details-control',
                        data: "boqID"
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
                    }
                ],
                initComplete: function() {
                    table.buttons().container()
                        .appendTo('#example_wrapper .col-md-6:eq(0)');
                }
            });
        }

        $('#history tbody').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(row.data())).show();
                var tr = $(this).closest('tr');
                tr.addClass('shown');
            }
        });

        function format(d) {
            // `d` is the original data object for the row
            var xHead = '<table id="childExample" cellpadding="5" cellspacing="0" border="0" style="width:100%;padding-left:50px;">';
            var xFoot = '</table>';
            xBody = "";

            $.ajax({
                type: "POST",
                url: '/getBoqchildHistory',
                data: {
                    _token: "{{ csrf_token() }}",
                    idParent: d.boqID
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
                            '<td>' + datob[i].weight + '</td>';
                    }
                }

            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
            return xHead + '' + xBody + '' + xFoot;
        }

    });
</script>
@endsection