@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2">
                        <a href="/payment-certificate" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back</a>
                    </div>
                    <div class="col-lg-10">
                        <h4 class="text-center">Payment Certificate Report</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form id="form-title">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="input-23" class="col-sm-12 col-form-label">PAYMENT ID</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="idPayment" id="idPayment" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="input-23" class="col-sm-12 col-form-label">REPORT DATE</label>
                                <div class="col-lg-10">
                                    <input type="date" class="form-control" name="datePayment" id="datePayment" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="input-23" class="col-sm-12 col-form-label">CONTRACTOR NAME</label>
                                <div class="col-lg-10">
                                    <input type="hidden" name="contractorID" id="contractorID">
                                    <p class="form-control" name="contractorName" id="contractorName"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group row">
                                <label for="input-23" class="col-sm-12 col-form-label">SAY / COMMENT</label>
                                <div class="col-lg-10">
                                    <textarea name="commentPayment" id="commentPayment" class="form-control" readonly></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Payment List</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>DIVISION</th>
                                <th>CEA</th>
                                <th>PAA</th>
                                <th>CA</th>
                                <th>TA</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="col-lg-12">
                    <label for="input-23" class="col-sm-12 col-form-label">SUB TOTAL A :</label>
                    <div class="row">
                        <div class="col-lg-3">
                            <label for="input-23" class="col-sm-12 col-form-label">CEA</label>
                            <input type="text" class="form-control" id="totalCEA" name="totalCEA" readonly>
                            <input type="hidden" class="form-control" id="totalCEA_hide" name="totalCEA_hide" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="input-23" class="col-sm-12 col-form-label">PAA</label>
                            <input type="text" class="form-control" id="totalPAA" name="totalPAA" readonly>
                            <input type="hidden" class="form-control" id="totalPAA_hide" name="totalPAA_hide" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="input-23" class="col-sm-12 col-form-label">TA</label>
                            <input type="text" class="form-control" id="totalTA" name="totalTA" readonly>
                            <input type="hidden" class="form-control" id="totalTA_hide" name="totalTA_hide" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="input-23" class="col-sm-12 col-form-label">CA</label>
                            <input type="text" class="form-control" id="totalCA" name="totalCA" readonly>
                            <input type="hidden" class="form-control" id="totalCA_hide" name="totalCA_hide" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Deduction List</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>DEDUCTION ITEM (%)</th>
                                <th>PAA</th>
                                <th>CA</th>
                                <th>TA</th> 
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="col-lg-12">
                    <label for="input-23" class="col-sm-12 col-form-label">PAYMENT DUE BEFORE VAT :</label>
                    <div class="row">
                        <!-- <div class="col-lg-3">
                            <label for="input-23" class="col-sm-12 col-form-label">CEA</label>
                            <input type="text" class="form-control" id="totalCEA_non_vat" name="totalCEA_non_vat" readonly>
                        </div> -->
                        <div class="col-lg-3">
                            <label for="input-23" class="col-sm-12 col-form-label">PAA</label>
                            <input type="text" class="form-control" id="totalPAA_non_vat" name="totalPAA_non_vat" readonly>
                            <input type="hidden" class="form-control" id="totalPAA_non_vat_hide" name="totalPAA_non_vat_hide" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="input-23" class="col-sm-12 col-form-label">TA</label>
                            <input type="text" class="form-control" id="totalTA_non_vat" name="totalTA_non_vat" readonly>
                            <input type="hidden" class="form-control" id="totalTA_non_vat_hide" name="totalTA_non_vat_hide" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="input-23" class="col-sm-12 col-form-label">CA</label>
                            <input type="text" class="form-control" id="totalCA_non_vat" name="totalCA_non_vat" readonly>
                            <input type="hidden" class="form-control" id="totalCA_non_vat_hide" name="totalCA_non_vat_hide" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> VAT List</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>VAT ITEM (%)</th>
                                <th>PAA</th>
                                <th>CA</th>
                                <th>TA</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="col-lg-12">
                    <label for="input-23" class="col-sm-12 col-form-label">TOTAL PAYMENT :</label>
                    <div class="row">
                        <!-- <div class="col-lg-3">
                            <label for="input-23" class="col-sm-12 col-form-label">CEA</label>
                            <input type="text" class="form-control" id="totalCEA_vat" name="totalCEA_vat" readonly>
                        </div> -->
                        <div class="col-lg-3">
                            <label for="input-23" class="col-sm-12 col-form-label">PAA</label>
                            <input type="text" class="form-control" id="totalPAA_vat" name="totalPAA_vat" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="input-23" class="col-sm-12 col-form-label">TA</label>
                            <input type="text" class="form-control" id="totalTA_vat" name="totalTA_vat" readonly>
                        </div>
                        <div class="col-lg-3">
                            <label for="input-23" class="col-sm-12 col-form-label">CA</label>
                            <input type="text" class="form-control" id="totalCA_vat" name="totalCA_vat" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="col-lg-12">
        <div class="card float-right">
            <div class="card-body">
                <button class="btn btn-info waves-effect waves-light m-1"><i class="fa fa-print"></i>Print</button>
                <button class="btn btn-success waves-effect waves-light m-1" id="btn-save-payment"><i class="fa fa-save"></i>Save</button>
                <button class="btn btn-danger waves-effect waves-light m-1"><i class="fa fa-times"></i>Cancel</button>
            </div>
        </div>
    </div> -->

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
                    <form id="form-non-vat">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DEDUCTION NAME</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="deductionName" name="deductionName">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">VALUE (%)</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="deductionValue" name="deductionValue">
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">
                        <button type="submit" id="btn-save-non-vat" class="btn btn-success px-5"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodalVat">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">NEW RECORD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-vat">
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">DEDUCTION NAME</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="vatName" name="vatName">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">VALUE (%)</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="vatValue" name="vatValue">
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">
                        <button type="submit" class="btn btn-success px-5" id="btn-save-vat"><i class="fa fa-save"></i> Save</button>
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
        //Default data table
        $('#default-datatable').DataTable();

        var table = $('#example').DataTable({
            lengthChange: false,
            dom: 'Bfrtip',
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            buttons: [],
            ajax: {
                url: '/getPaymentList',
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
                    data: "amount",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "CA",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "PAA",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "TA",
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
            url: '/getPaymentList',
            method: "POST",
            dataSrc: "",
            data: {
                _token: "{{ csrf_token() }}",
                docID: <?php echo $id; ?>

            },
            dataType: 'JSON'
        }).done(function(response) {
            var totalCEA = 0;
            var totalCA = 0;
            var totalPAA = 0;
            var totalTA = 0;

            for (let i = 0; i < response.length; i++) {
                totalCEA += response[i].amount;
                totalCA += response[i].CA;
                totalPAA += response[i].PAA;
                totalTA += response[i].TA;
            }
            $('#totalCEA').val(totalCEA.toLocaleString('id-ID'));
            $('#totalCA').val(totalCA.toLocaleString('id-ID'));
            $('#totalPAA').val(totalPAA.toLocaleString('id-ID'));
            $('#totalTA').val(totalTA.toLocaleString('id-ID'));
            $('#totalCEA_hide').val(totalCEA);
            $('#totalCA_hide').val(totalCA);
            $('#totalPAA_hide').val(totalPAA);
            $('#totalTA_hide').val(totalTA);
        }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

        $.ajax({
            type: "POST",
            url: '/getCertificateTitle',
            method: "POST",
            dataSrc: "",
            data: {
                _token: "{{ csrf_token() }}",
                docID: <?php echo $id; ?>

            },
            dataType: 'JSON'
        }).done(function(response) {
            $('#idPayment').val(response[0].id);
            $('#datePayment').val(response[0].ReportDate);
            $('#contractorName').html(response[0].BussinessName);
            $('#contractorID').val(response[0].contractorID);
            $('#commentPayment').val(response[0].COMMENT);
        }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });


        // table.buttons().container()
        //     .appendTo('#example_wrapper .col-md-6:eq(0)');

        var table2 = $('#example2').DataTable({
            lengthChange: false,
            dom: 'Bfrtip',
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            buttons: [],
            ajax: {
                url: '/getPaymentNonVAT',
                method: "POST",
                dataSrc: function(json) {
                    var return_data = new Array();
                    var totalPAA=0;
                    var totalCA=0;
                    var totalTA=0;
                    for (var i = 0; i < json.length; i++) {
                        return_data.push({
                            'no' :json[i].no,
                            'DeductionItem' :json[i].DeductionItem +" ( "+ json[i].Value +"% )",
                            'CA' : $('#totalCA_hide').val()*(json[i].Value / 100),
                            'PAA' : $('#totalPAA_hide').val()*(json[i].Value / 100),
                            'TA' : $('#totalTA_hide').val()*(json[i].Value / 100)
                        })
                        totalPAA+=$('#totalPAA_hide').val()*(json[i].Value / 100);
                        totalCA+=$('#totalCA_hide').val()*(json[i].Value / 100);
                        totalTA+=$('#totalTA_hide').val()*(json[i].Value / 100);
                    }
                    $('#totalPAA_non_vat').val(($('#totalPAA_hide').val()-totalPAA).toLocaleString('id-ID'));
                    $('#totalCA_non_vat').val(($('#totalCA_hide').val()-totalCA).toLocaleString('id-ID'));
                    $('#totalTA_non_vat').val(($('#totalTA_hide').val()-totalTA).toLocaleString('id-ID'));
                    return return_data;
                },
                data: {
                    _token: "{{ csrf_token() }}",
                    docID: <?php echo $id; ?>

                }
            },
            columns: [{
                    data: "no"
                },
                {
                    data: "DeductionItem"
                },
                {
                    data: "PAA",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "CA",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "TA",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }
            ]
        });


        var table3 = $('#example3').DataTable({
            lengthChange: false,
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            dom: 'Bfrtip',
            buttons: [],
            ajax: {
                url: '/getPaymentVAT',
                method: "POST",
                dataSrc: function(json) {
                    var return_data = new Array();
                    var totalPAA=0;
                    var totalCA=0;
                    var totalTA=0;
                    for (var i = 0; i < json.length; i++) {
                        return_data.push({
                            'no' :json[i].no,
                            'DeductionItem' :json[i].DeductionItem +" ( "+ json[i].Value +"% )",
                            'CA' : $('#totalCA_hide').val()*(json[i].Value / 100),
                            'PAA' : $('#totalPAA_hide').val()*(json[i].Value / 100),
                            'TA' : $('#totalTA_hide').val()*(json[i].Value / 100)
                        })
                        totalPAA+=$('#totalPAA_hide').val()*(json[i].Value / 100);
                        totalCA+=$('#totalCA_hide').val()*(json[i].Value / 100);
                        totalTA+=$('#totalTA_hide').val()*(json[i].Value / 100);
                    }
                    $('#totalPAA_vat').val(($('#totalPAA_hide').val()-totalPAA).toLocaleString('id-ID'));
                    $('#totalCA_vat').val(($('#totalCA_hide').val()-totalCA).toLocaleString('id-ID'));
                    $('#totalTA_vat').val(($('#totalTA_hide').val()-totalTA).toLocaleString('id-ID'));
                    return return_data;
                },
                data: {
                    _token: "{{ csrf_token() }}",
                    docID: <?php echo $id; ?>

                }
            },
            columns: [{
                    data: "no"
                },
                {
                    data: "DeductionItem"
                },
                {
                    data: "PAA",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "CA",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                },
                {
                    data: "TA",
                    render: $.fn.dataTable.render.number(',', '.', 2)
                }
            ]

        });

        var arr_vat = [];
        var arr_non_vat = [];
        var idx1 = 0;
        var idx2 = 0;
        $('#btn-save-non-vat').click(function(e) {

            //var data_form = $('#form-non-vat').serialize();
            var data_form = {
                name: $('#deductionName').val(),
                value: $('#deductionValue').val()
            }
            arr_non_vat.push(data_form);
            let cea = 0;
            let paa = 0;
            let ta = 0;
            let ca = 0;
            for (let i = 0; i < arr_non_vat.length; i++) {
                cea += $('#totalCEA_hide').val() - ($('#totalCEA_hide').val() * (arr_non_vat[i].value / 100));
                paa += $('#totalPAA_hide').val() - ($('#totalPAA_hide').val() * (arr_non_vat[i].value / 100));
                ta += $('#totalTA_hide').val() - ($('#totalTA_hide').val() * (arr_non_vat[i].value / 100));
                ca += $('#totalCA_hide').val() - ($('#totalCA_hide').val() * (arr_non_vat[i].value / 100));
            }
            // $('#totalCEA_non_vat').val(cea.toLocaleString('id-ID'));
            $('#totalPAA_non_vat').val(paa.toLocaleString('id-ID'));
            $('#totalTA_non_vat').val(ta.toLocaleString('id-ID'));
            $('#totalCA_non_vat').val(ca.toLocaleString('id-ID'));
            $('#totalPAA_non_vat_hide').val(paa);
            $('#totalTA_non_vat_hide').val(ta);
            $('#totalCA_non_vat_hide').val(ca);
            idx1++;
            table2.row.add([
                idx1,
                $('#deductionName').val(),
                ($('#totalPAA_hide').val() * ($('#deductionValue').val() / 100)).toLocaleString('id-ID'),
                ($('#totalTA_hide').val() * ($('#deductionValue').val() / 100)).toLocaleString('id-ID'),
                ($('#totalCA_hide').val() * ($('#deductionValue').val() / 100)).toLocaleString('id-ID'),
                "<button id='btn-delete-non-vat' class='btn-delete btn btn-danger form-control'>DELETE</button>"
            ]).draw(false);

            $('#form-non-vat')[0].reset();
            $('#formmodal').modal('toggle');
        });

        $('#btn-save-vat').click(function(e) {
            //var data_form = $('#form-vat').serialize();
            var data_form = {
                name: $('#vatName').val(),
                value: $('#vatValue').val()
            }
            arr_vat.push(data_form);
            let cea = 0;
            let paa = 0;
            let ta = 0;
            let ca = 0;
            for (let i = 0; i < arr_vat.length; i++) {
                cea += ($('#totalCEA_hide').val() * (arr_vat[i].value / 100));
                paa += ($('#totalPAA_hide').val() * (arr_vat[i].value / 100));
                ta += ($('#totalTA_hide').val() * (arr_vat[i].value / 100));
                ca += ($('#totalCA_hide').val() * (arr_vat[i].value / 100));
            }
            // $('#totalCEA_vat').val(cea.toLocaleString('id-ID'));
            $('#totalPAA_vat').val(($('#totalPAA_non_vat_hide').val() - paa).toLocaleString('id-ID'));
            $('#totalTA_vat').val(($('#totalTA_non_vat_hide').val() - ta).toLocaleString('id-ID'));
            $('#totalCA_vat').val(($('#totalCA_non_vat_hide').val() - ca).toLocaleString('id-ID'));
            idx2++;
            table3.row.add([
                idx2,
                $('#vatName').val(),
                ($('#totalPAA_hide').val() * ($('#vatValue').val() / 100)).toLocaleString('id-ID'),
                ($('#totalTA_hide').val() * ($('#vatValue').val() / 100)).toLocaleString('id-ID'),
                ($('#totalCA_hide').val() * ($('#vatValue').val() / 100)).toLocaleString('id-ID'),
                "<button id='btn-delete-vat' class='btn-delete btn btn-danger form-control'>DELETE</button>"
            ]).draw(false);

            $('#form-vat')[0].reset();
            $('#formmodalVat').modal('toggle');
        });

        $('#btn-save-payment').click(function(e) {

            $.ajax({
                type: "POST",
                url: '/addPayment',
                method: "POST",
                data: $('#form-title').serialize() + "&_token=" + '{{ csrf_token() }}' + "&deduction=" + JSON.stringify(arr_non_vat) + "&vat=" + JSON.stringify(arr_vat),
                dataType: 'JSON'
            }).done(function(response) {
                if (response.status != 'error') {
                    successAlert('Add', $('#idPayment').val(), 'success');
                    setTimeout(function() {
                        window.location = "/payment-certificate"
                    }, 3000);
                } else {
                    successAlert('Add', $('#idPayment').val(), 'fail');
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlert('Create', $('#idPayment').val(), 'error');
            });

        });

    });
</script>
@endsection