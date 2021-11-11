@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">Profile Group</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> Profile</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>PROFILE</th>
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
                    <h5 class="modal-title">ADD PROFILE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addPrivilegedName">
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">NAME</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="PrivilegedName" name="PrivilegedName" placeholder="Enter Your Name">
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">
                        <button class="btn btn-success px-5" id="btn-submit-add"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodaledit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">EDIT PROFILE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addPrivilegedNameEdit">
                    <input type="hidden" id="idPrivilegedName" name="idPrivilegedName" class="form-control">
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">NAME</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="PrivilegedNameEdit" name="PrivilegedNameEdit" placeholder="Enter Your Name">
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">
                        <button class="btn btn-success px-5" id="btn-submit-edit"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodalright">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">SET PROFILE RIGHT : " "</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formRight">
                    <input type="hidden" id="idPrivilegedNameRight" name="idPrivilegedNameRight" class="form-control">
                        <ul class="sidebar-menu do-nicescrol">
                            <li>
                                <a href="javaScript:void();" class="waves-effect">
                                    <i class="zmdi zmdi-view-dashboard"></i> <span>Planning</span><i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li><i class="zmdi zmdi-long-arrow-right"></i> Projects <input type="checkbox" class="UserRight" name="UserRight[]" value="Planning1"></li> 
                                    <li><i class="zmdi zmdi-long-arrow-right"></i> BoQs <input type="checkbox" class="UserRight" name="UserRight[]" value="Planning2"></li>
                                    <li><i class="zmdi zmdi-long-arrow-right"></i> Baseline WBS <input type="checkbox" class="UserRight" name="UserRight[]" value="Planning3"></li>
                                    <li><i class="zmdi zmdi-long-arrow-right"></i> Contractor Equipments <input type="checkbox" class="UserRight" name="UserRight[]" value="Planning4"></li>
                                    <li><i class="zmdi zmdi-long-arrow-right"></i> Mobilization of Consultants <input type="checkbox" class="UserRight" name="UserRight[]" value="Planning5"></li>
                                    <li><i class="zmdi zmdi-long-arrow-right"></i> Risk Management <input type="checkbox" class="UserRight" name="UserRight[]" value="Planning6"></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javaScript:void();" class="waves-effect">
                                    <i class="zmdi zmdi-layers"></i>
                                    <span>Execution & Controlling</span><i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li><i class="zmdi zmdi-long-arrow-right"></i> WBS Current <input type="checkbox" class="UserRight" name="UserRight[]" value="Execute1"></li>
                                    <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-long-arrow-right"></i><span>Project Progress</span><i class="fa fa-angle-left pull-right">
                                    </i></a>
                                        <ul class="sidebar-submenu">
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> Actual Progress <input type="checkbox" class="UserRight" name="UserRight[]" value="Execute2"></li>
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> Station Progress <input type="checkbox" class="UserRight" name="UserRight[]" value="Execute3"></li>
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> Visual Progress <input type="checkbox" class="UserRight" name="UserRight[]" value="Execute4"></li>
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> Performance Analysis <input type="checkbox" class="UserRight" name="UserRight[]" value="Execute5"></li>
                                        </ul>
                                    </li>
                                    <li><i class="zmdi zmdi-long-arrow-right"></i> Payment Certificates <input type="checkbox" class="UserRight" name="UserRight[]" value="Execute6"></li>
                                    <li><i class="zmdi zmdi-long-arrow-right"></i> Issue Management <input type="checkbox" class="UserRight" name="UserRight[]" value="Execute7"></li>
                                    <li><i class="zmdi zmdi-long-arrow-right"></i> Weather Info <input type="checkbox" class="UserRight" name="UserRight[]" value="Execute8"></li>
                                    <li><i class="zmdi zmdi-long-arrow-right"></i> Monthly Meeting <input type="checkbox" class="UserRight" name="UserRight[]" value="Execute9"></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javaScript:void();" class="waves-effect">
                                    <i class="zmdi zmdi-card-travel"></i>
                                    <span>Info & Reporting</span>
                                    <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li><i class="zmdi zmdi-long-arrow-right"></i> Progress Report <input type="checkbox" class="UserRight" name="UserRight[]" value="Report1"></li>
                                </ul>
                                
                            </li>
                            <li>
                                <a href="javaScript:void();" class="waves-effect">
                                    <i class="zmdi zmdi-chart"></i> <span>Tools</span>
                                    <i class="fa fa-angle-left float-right"></i>
                                </a>
                                <ul class="sidebar-submenu">
                                    <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-long-arrow-right"></i> <span>User Management</span><i class="fa fa-angle-left pull-right"></i></a>
                                        <ul class="sidebar-submenu">
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> Manage User <input type="checkbox" class="UserRight" name="UserRight[]" value="Master1"> </li>
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> Profile Group <input type="checkbox" class="UserRight" name="UserRight[]" value="Master2"></li>
                                        </ul>     
                                    </li>
                                    <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-long-arrow-right"></i> <span>Master Data Management</span><i class="fa fa-angle-left pull-right"></i></a>
                                        <ul class="sidebar-submenu">
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> Business Type <input type="checkbox" class="UserRight" name="UserRight[]" value="Master3"></li>
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> Business Partner <input type="checkbox" class="UserRight" name="UserRight[]" value="Master4"></li>
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> Position Category <input type="checkbox" class="UserRight" name="UserRight[]" value="Master5"></li>
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> Position <input type="checkbox" class="UserRight" name="UserRight[]" value="Master6"></li>
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> Human Resources <input type="checkbox" class="UserRight" name="UserRight[]" value="Master7"></li>
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> Weather Conditions <input type="checkbox" class="UserRight" name="UserRight[]" value="Master8"></li>
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> Country <input type="checkbox" class="UserRight" name="UserRight[]" value="Master9"></li>
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> City <input type="checkbox" class="UserRight" name="UserRight[]" value="Master10"></li>
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> Currency <input type="checkbox" class="UserRight" name="UserRight[]" value="Master11"></li>
                                            <li><i class="zmdi zmdi-long-arrow-right"></i> Units <input type="checkbox" class="UserRight" name="UserRight[]" value="Master12"></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </form>
                    <div class="form-group float-right">

                        <button class="btn btn-success px-5" id="btn-submit-add-right"><i class="fa fa-save"></i> Save</button>
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
        //Default data table
        $('#default-datatable').DataTable();


        var table = $('#example').DataTable({
            lengthChange: false,
            //buttons: ['copy', 'excel', 'pdf', 'print', 'colvis']
            buttons: [{
                text: 'New',
                className: 'btn-primary',
                action: function(e, dt, button, config) {
                    $('#formmodal').modal('toggle');
                }
            }],
            ajax: {
                url: '/getPrivilegedName',
                method: "GET",
                dataSrc: "",
                data: {
                    _token: "{{ csrf_token() }}",
                }
            },
            columns: [{
                    data: "id"
                },
                {
                    data: "PrivilegedName"
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

        $('#btn-submit-add').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/addPrivilegedName',
                data: $('#addPrivilegedName').serialize() + "&_token="+ '{{ csrf_token() }}'
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Add', $('#PrivilegedName').val(), 'success');
                    $('#PrivilegedName').val('');
                } else {
                    errorAlert('Add', $('#PrivilegedName').val(), 'error');
                    $('#PrivilegedName').val('');
                }
                $('#formmodal').modal('toggle');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

        });

        
        $('#example tbody').on('click', '.edit-btn', function() {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/getPrivilegedNameByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#idPrivilegedName').val(datob[0].id); 
                $('#PrivilegedNameEdit').val(datob[0].PrivilegedName);
                $('#formmodaledit').modal('show');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
        });

        $('#btn-submit-edit').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/updatePrivilegedName',
                data:  $('#addPrivilegedNameEdit').serialize() + "&_token="+ '{{ csrf_token() }}'
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Update', $('#idPrivilegedName').val(), 'success');
                } else {
                    errorAlert('Update', $('#idPrivilegedName').val(), 'error');
                }
                $('#formmodaledit').modal('toggle');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

        });

        $('#example tbody').on('click', '.formmodalright', function() {
            $('#formRight')[0].reset();
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/getPrivilegedNameByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#idPrivilegedNameRight').val(datob[0].id); 
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
            $.ajax({
                type: "POST",
                url: '/getPrivilegedByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                for(var i=0;i<datob.length;i++){
                    if(datob[i].status!=0){
                        $("input[type=checkbox][value="+datob[i].UserPrivileged+"]").prop("checked",true);
                    }        
                }
                
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
            $('#formmodalright').modal('show');
        });

        $('#btn-submit-add-right').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/addPrivileged',
                data:  $('#formRight').serialize() + "&_token="+ '{{ csrf_token() }}'
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Add', 'Privileged', 'success');
                    $('#formRight')[0].reset();
                } else {
                    successAlert('Add', 'Privileged', 'success');
                    $('#formRight')[0].reset();
                }
                $('#formmodalright').modal('toggle');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

        });

    });
</script>
@endsection