@extends('app')
@section('content')
<div class="row">
    <!-- <div class="col-lg-4">
        <div class="card">
            <div class="card-body text-center">
                <button type="button" class="btn btn-primary  waves-effect waves-light m-1">New</button>
            </div>
        </div>
    </div> -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center"> PROJECT</h4>
            </div>
        </div>
    </div>
    <!-- <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="form-group row">
                    <label for="input-23" class="col-sm-2 col-form-label">CONTRACTOR NAME</label>
                    <div class="col-lg-7">
                        <select class="form-control">
                            <option></option>
                        </select>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-success px-5"><i class="fa fa-save"></i> SHOW DATA</button>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> PROJECT LIST </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Project Name</th>
                                
                                <th>Description</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Row-->
@endsection
@section('script')
<script>
    $(document).ready(function() {
        var privilegedstatus="<?php echo session('PrivilegedStatus');?>";
        //Default data table
        $('#default-datatable').DataTable();
        
        var idPartner="<?php echo session('BussinessPartnerID'); ?>"
        
        var table = $('#example').DataTable({
            lengthChange: false,
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            buttons: [{
                text: 'New',
                className: 'btn-primary',
                action: function(e, dt, button, config) {
                    if(privilegedstatus==1){
                    window.location = '/addproject';
                    }else{
                        swal("Only Admin Permit to Add !");
                    }
                }
            }],
            
            ajax: {
                url: '/getProject',
                method: "GET",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}"
                }
            },
            columns: [{
                    data: "No"
                },
                {
                    data: "ProjectName"
                },
                {
                    data: "ProjectDesc"
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
        
       $('#example tbody').on('click', '.confirm-btn-alert', function() {
            idData = $(this).attr('data-ids');
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
                            url: '/DeleteProject',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: idData
                            }
                        }).done(function(msg) {
                            datob = JSON.parse(msg);
                            $('#example').DataTable().ajax.reload();
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

        $('#example tbody').on('click', '.edit-btn', function() {
           
            var id = $(this).data("id");
            
            window.location = '/editproject/'+id;
            // $.ajax({
            //     type: "POST",
            //     url: '/getProjectByid',
                
            //     data: {

            //         _token: "{{ csrf_token() }}",
            //         id: id
            //     }
            // }).done(function(msg) {
            //     datob = JSON.parse(msg);
            //     id= $('#Projectid').val(datob[0].id);

            //     // $('#ProjectNameEdit').val(datob[0].ProjectName);
            //     // $('#ProjectDescEdit').val(datob[0].ProjectDesc);
            //     // $('#ProjectOwnerEdit').val(datob[0].ProjectOwner);
            //     // $('#ProjectManagerOwnerEdit').val(datob[0].ProjectManagerOwner);
            //     // var newOption1 = new Option(datob[0].CurrencyName, datob[0].CurrencyID, true, true);
            //     // $('#CurrencyTypeEdit').append(newOption1).trigger('change');
            //     // $('#ContractAmountEdit').val(datob[0].ContractAmount);
                
            //     // $('#formmodaledit').window.location('/editproject');
            //     window.location = '/editproject/'+id;
            // });
        });

        $('#example tbody').on('click', '.btn-info', function() {
           
           var id = $(this).data("id");
           // window.location = '/editproject';
           $.ajax({
               type: "POST",
               url: '/updateProjectSetDefault',
               data: {
                   _token: "{{ csrf_token() }}",
                   id: id
               }
           }).fail(function(jqXHR, textStatus, errorThrown) {
                        swal("Please Wait, Refresh if menu not appear");
            });

           location.reload();
           
       });


        


       table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');


               
        var ProjectID = String(<?php echo session('ProjectID'); ?>);
        if (ProjectID == '0') {
            emptyAlert('session');
            $('#Planning2').addClass("disabled");
            $('#Planning3').addClass("disabled");
            $('#Planning4').addClass("disabled");
            $('#Planning5').addClass("disabled");
            $('#Planning6').addClass("disabled");
            $('.Execute').addClass("disabled");
            $('.Report').addClass("disabled");

            swal({
                    title: "Warning",
                    text: "Please Create or Set your Project first!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((setProject) => {
                    if (setProject) {
                    //  window.location="/project";

                    } else {
                        swal("You Can't Access All Menu Until Project is Set !");
                    }
                });

        }else{
            $('#Planning2').removeClass("disabled");
            $('#Planning3').removeClass("disabled");
            $('#Planning4').removeClass("disabled");
            $('#Planning5').removeClass("disabled");
            $('#Planning6').removeClass("disabled");
            $('.Execute').removeClass("disabled");
            $('.Report').removeClass("disabled");
            //$('.Master').removeClass("disabled");
        }

    

    });
</script>
@endsection