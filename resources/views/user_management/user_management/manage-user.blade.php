@extends('app')
@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="text-center">User Manager</h4>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-table"></i> User</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAME</th>
                                <th>LOGIN</th>
                                <th>MAIL</th>
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
                    <h5 class="modal-title">ADD USER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addUser">
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">NAME</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Userfullname" name="Userfullname" placeholder="Enter Your Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-22" class="col-sm-2 col-form-label">LOGIN</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="UserLogin" name="UserLogin" placeholder="Enter Your Username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">MAIL</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="UserMail" name="UserMail" placeholder="Enter Your Mail">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">PROFILE</label>
                            <div class="col-sm-10">
                                <select class="js-example-basic-single" style="width:100%" id="UserProfile" name="UserProfile">

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">SET AS ADMIN</label>
                            <div class="col-sm-4">
                                <input type="checkbox" id="PrivilegedStatus" name="PrivilegedStatus" value="1">
                            </div>
                            <label for="input-23" class="col-sm-2 col-form-label">SET AS GUEST</label>
                            <div class="col-sm-4">
                                <input type="checkbox" id="GuestStatus" name="GuestStatus" value="1">
                            </div>
                        </div>
                        <div class="form-group row" id="formProject">
                            <label for="input-23" class="col-sm-2 col-form-label">SET PROJECT</label>
                            <div class="col-sm-10">
                            <select class="form-control" style="width:100%" id="viewProject" name="viewProject"></select>
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">
                        <button class="btn btn-success px-5" id="add_user"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodaledit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">EDIT USER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editUser">
                        <input type="hidden" id="idUser" name="idUser" class="form-control">
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">NAME</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="UserfullnameEdit" name="UserfullnameEdit" placeholder="Enter Your Name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-22" class="col-sm-2 col-form-label">LOGIN</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="UserLoginEdit" name="UserLoginEdit" placeholder="Enter Your Username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">MAIL</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="UserMailEdit" name="UserMailEdit" placeholder="Enter Your Mail">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">PROFILE</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="width:100%" id="UserProfileEdit" name="UserProfileEdit">

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-23" class="col-sm-2 col-form-label">PRIVILEGED USER</label>
                            <div class="col-sm-4">
                                <input type="checkbox" id="PrivilegedStatusEdit" name="PrivilegedStatusEdit" value="1">
                            </div>
                            <label for="input-23" class="col-sm-2 col-form-label">SET AS GUEST</label>
                            <div class="col-sm-4">
                                <input type="checkbox" id="GuestStatusEdit" name="GuestStatusEdit" value="1">
                            </div>
                        </div>
                        <div class="form-group row" id="formProjectEdit">
                            <label for="input-23" class="col-sm-2 col-form-label">SET PROJECT</label>
                            <div class="col-sm-10">
                            <select class="form-control" style="width:100%" id="viewProjectEdit" name="viewProjectEdit"></select>
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">

                        <button class="btn btn-success px-5" id="btn-submit-edit"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodalpass">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">SET USER PASSWORD : " "</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="password">
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">PASSWORD</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="password" name="password" placeholder="Enter Password">
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">

                        <button class="btn btn-success px-5" id="btn-submit-add"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodalpassEdit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">SET USER PASSWORD : " <span id='UserfullnameTitle'></span> "</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="Editpassword">
                        <input type="hidden" id="idUser2" name="idUser2" class="form-control">
                        <div class="form-group row">
                            <label for="input-21" class="col-sm-2 col-form-label">PASSWORD</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="passwordEdit" name="passwordEdit" placeholder="Enter Password">
                            </div>
                        </div>
                    </form>
                    <div class="form-group float-right">

                        <button class="btn btn-success px-5" id="btn-edit-pass"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="formmodalright">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated fadeInUp">
                <div class="modal-header">
                    <h5 class="modal-title">SET PROFILE RIGHT : " <span id="profName"></span> "</h5>
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

                        <button class="btn btn-success px-5" id="btn-submit-edit-right"><i class="fa fa-save"></i> Save</button>
                        <button type="reset" class="btn btn-danger px-5"><i class="fa fa-times"></i> Cancel</button>

                    </div>
                </div>

            </div>
        </div>
    </div>


</div><!-- End Row-->
@endsection
@section('script')
<script>
      $('#formProject').hide();
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
                url: '/getUser',
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
                    data: "Userfullname"
                },
                {
                    data: "UserLogin"
                },
                {
                    data: "UserMail"
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

        table.buttons().container()
            .appendTo('#example_wrapper .col-md-6:eq(0)');

        $('#add_user').click(function() {
            $('#formmodal').modal('hide');
            $('#formmodalpass').modal('toggle');
        });

        $('#btn-submit-add').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/addUser',
                data: $('#addUser,#password').serialize() + "&_token=" + '{{ csrf_token() }}'

            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Add', $('#businessName').val(), 'success');
                    $('#addUser')[0].reset();
                    $('#password')[0].reset();
                } else {
                    errorAlert('Add', $('#businessName').val(), 'error');
                    $('#addUser')[0].reset();
                    $('#password')[0].reset();
                }
                $('#formmodal').modal('hide');
                $('#formmodalpass').modal('hide');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

        });

        $('#example tbody').on('click', '.edit-btn', function() {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/getUserByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#idUser').val(datob[0].id);
                $('#UserfullnameEdit').val(datob[0].Userfullname);
                $('#UserLoginEdit').val(datob[0].UserLogin);
                $('#UserMailEdit').val(datob[0].UserMail);
                var newOption = new Option(datob[0].PrivilegedName, datob[0].UserProfile, true, true);
                $('#UserProfileEdit').append(newOption).trigger('change');
                if (datob[0].PrivilegedStatus == 1) {
                    $('#PrivilegedStatusEdit').prop('checked', true);
                } else {
                    $('#PrivilegedStatusEdit').prop('checked', false);
                }
                if (datob[0].guest == 1) {
                    $('#GuestStatusEdit').prop('checked', true);
                    $('#formProjectEdit').show();
                }else{
                    $('#GuestStatusEdit').prop('checked', false);
                    $('#formProjectEdit').hide();
                }
                $('#formmodaledit').modal('show');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
        });


        $('#btn-submit-edit-right').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/addPrivileged',
                data: $('#formRight').serialize() + "&_token=" + '{{ csrf_token() }}'
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

        $('#btn-edit-pass').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/updateUserPassword',
                data: $('#Editpassword').serialize() + "&_token=" + '{{ csrf_token() }}'
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Update', $('#idUser').val(), 'success');
                    $('#passwordEdit').val('');
                } else {
                    errorAlert('Update', $('#idUser').val(), 'error');
                    $('#passwordEdit').val('');
                }
                $('#formmodalpassEdit').modal('toggle');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
        });

        $('#example tbody').on('click', '.btn-formmodalright', function() {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/getUserPrivilegedByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#profName').html(datob[0].PrivilegedName);
                $('#idPrivilegedNameRight').val(datob[0].id);
                for (var i = 0; i < datob.length; i++) {
                    if (datob[i].status != 0) {
                        $("input[type=checkbox][value=" + datob[i].UserPrivileged + "]").prop("checked", true);
                    }
                }

            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
            $('#formmodalright').modal('show');
        });

        $('#example tbody').on('click', '.edit-pass', function() {
            var id = $(this).data("id");
            $.ajax({
                type: "POST",
                url: '/getUserByid',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                }
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#idUser2').val(datob[0].id);
                $('#UserfullnameTitle').html(datob[0].Userfullname);
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });

            $('#formmodalpassEdit').modal('show');
        });

        $('#btn-submit-edit').click(function(e) {
            e.preventDefault;
            $.ajax({
                type: "POST",
                url: '/updateUser',
                data: $('#editUser').serialize() + "&_token=" + '{{ csrf_token() }}'
            }).done(function(msg) {
                datob = JSON.parse(msg);
                $('#example').DataTable().ajax.reload();
                if (datob != 'error') {
                    successAlert('Update', $('#idUser').val(), 'success');
                } else {
                    errorAlert('Update', $('#idUser').val(), 'error');
                }
                $('#formmodaledit').modal('toggle');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                errorAlertServer('Response Not Found, Please Check Your Data');
            });
        });

        $('#UserProfile').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                type: 'GET',
                url: '/getPrivilegedName',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                processResults: function(data) {
                    datob = JSON.parse(data);
                    return {
                        results: $.map(datob, function(item) {
                            return {
                                text: item.PrivilegedName,
                                slug: item.PrivilegedName,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('#viewProject').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                type: 'GET',
                url: '/getProject',
                data: {
                    _token: "{{ csrf_token() }}"
                    
                },
                processResults: function(data) {
                    datob = JSON.parse(data);
                    return {
                        results: $.map(datob, function(item) {
                            return {
                                text: item.ProjectName,
                                slug: item.ProjectName,
                                id: item.ProjectID
                            }
                        })
                    };
                }
            }
        });

        $('#viewProjectEdit').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                type: 'GET',
                url: '/getProject',
                data: {
                    _token: "{{ csrf_token() }}"
                    
                },
                processResults: function(data) {
                    datob = JSON.parse(data);
                    return {
                        results: $.map(datob, function(item) {
                            return {
                                text: item.ProjectName,
                                slug: item.ProjectName,
                                id: item.ProjectID
                            }
                        })
                    };
                }
            }
        });


        $('#UserProfileEdit').select2({
            //dropdownParent: $('#formmodalEdit'),
            ajax: {
                type: 'GET',
                url: '/getPrivilegedName',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                processResults: function(data) {
                    datob = JSON.parse(data);
                    return {
                        results: $.map(datob, function(item) {
                            return {
                                text: item.PrivilegedName,
                                slug: item.PrivilegedName,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });

        $('#example tbody').on('click', '.confirm-btn-alert', function() {
            id = $(this).attr('data-ids');
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
                            url: '/deleteUser',
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id
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

        $('#GuestStatus').click(function() {
                $('#formProject').toggle();
        });
        $('#GuestStatusEdit').click(function() {
                $('#formProjectEdit').toggle();
        });
    });
</script>
@endsection