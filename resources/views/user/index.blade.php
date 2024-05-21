@include('admin.common.table_header');
@include('admin.common.sidebar');
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">User List</h4>
                        <div class="page-title-right">
                            <button class="btn btn-primary" id="add_user" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="float:right;">Add User</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="toast position-absolute top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" id="toastPlacement" data-delay="2000" data-original-class="toast-container position-absolute p-3" style="z-index:9999 !important;">
                                <div class="toast-header">
                                    <strong class="me-auto">Alert</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                                <div class="toast-body">
                                    <span id="toast_msg"></span>
                                </div>
                            </div>
                            <table id="datatable-user" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;z-index:10 !important">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Mobile No</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
            <!-- end page title -->

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="width:800px;">
                <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Add User</h5>
                    <button type="button" class="btn-close text-reset" id="new_cls" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="row">
                        <form id="form-data" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="formrow-select-input" class="form-label">Role</label>
                                        &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                        <select class="form-select select2" id="role_id" name="role_id">
                                            <option value='' disabled selected>Select Role</option>
                                        </select>
                                        <span class="text-danger" id="role_id_error"></span>
                                    </div>
                                </div>
                                <hr style="border-top: 1px solid #041229;">
                                <div id="user_portion" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <label for="formrow-text-input" class="form-label" id="">Name</label>
                                                &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                                <input type="text" class="form-control" id="name" name="name">
                                                <span class="text-danger" id="name_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <label for="formrow-text-input" class="form-label">Email</label>
                                                &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                                <input type="email" class="form-control" id="email" name="email">
                                                <span class="text-danger" id="email_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <label for="formrow-text-input" class="form-label">Mobile No</label>
                                                &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                                <input type="text" class="form-control" id="mobile_no" name="mobile_no">
                                                <span class="text-danger" id="mobile_no_error"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-4">
                                                <label for="formrow-text-input" class="form-label">Password</label>
                                                &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                                <input type="text" class="form-control" id="password" name="password">
                                                <span class="text-danger" id="password_error"></span>
                                            </div>
                                        </div>
                                        {{-- <br>
                                    <hr style="border-top: 1px solid #041229;"> --}}

                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <div class="mb-12">
                                            <button type="button" class="btn btn-primary w-sm add_user_submit_form" id="new_user">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRightEdit" aria-labelledby="offcanvasRightLabel" style="width:800px;">
                <div class="offcanvas-header">
                    <h5 id="offcanvasRightLabel">Edit User</h5>
                    <button type="button" class="btn-close text-reset" id="edit_cls" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <div class="row">
                        <form id="form-data-edit">
                            <div class="row">
                                <input type="hidden" id="user_id" name="user_id">
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="formrow-text-input" class="form-label" id="lbl_name">Name</label>
                                        &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                        <input type="text" class="form-control" id="edit_name" name="edit_name">
                                        <span class="text-danger" id="edit_name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="formrow-text-input" class="form-label">Mail</label>
                                        &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                        <input type="email" class="form-control" id="edit_email" name="edit_email">
                                        <span class="text-danger" id="edit_email_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="formrow-text-input" class="form-label">Mobile No</label>
                                        &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                        <input type="text" class="form-control" id="edit_mobile_no" name="edit_mobile_no">
                                        <span class="text-danger" id="edit_mobile_no_error"></span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div>
                                <button type="button" class="btn btn-primary w-sm submit-edit-form" id="update-user">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
</div>

@include('admin.common.dash_footer');

<script>
    $(document).ready(function() {

        loadUsers();

        function loadUsers() {
            $('#datatable-user').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: {
                    type: "GET",
                    url: "{{ route('user.create') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                    }
                },
                columns: [{
                        data: 'S No',
                        name: 'S No'
                    }, {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'mobile_no',
                        name: 'mobile_no'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role_name',
                        name: 'role_name'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },

                ]
            });
        }
        $.ajax({
            type: 'GET',
            url: "{{ route('role_list') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success == true) {
                    var select_class = $('#role_id');
                    var array = response.data;
                    if (array != '') {
                        for (var i in array) {
                            select_class.append("<option value=" + array[i].id + ">" + array[i]
                                .name +
                                "</option>");
                        }
                    }
                }
            },
        });


        $('#role_id').on('change', function() {
            $("#user_portion").css('display', 'block');
        });

        $(".add_user_submit_form").click(function(e) {
            e.preventDefault();
            var token = "{{ csrf_token() }}";
            var name = $("#name").val();
            var mobile_no = $("#mobile_no").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var role_id = $("#role_id").val();

            $.ajax({
                type: 'POST',
                url: "{{ route('user.store') }}",
                data: {
                    _token: token,
                    name: name,
                    mobile_no: mobile_no,
                    email: email,
                    password: password,
                    role_id: role_id,
                },
                beforeSend: function() {
                    $('#new_user').html('....Please wait');
                },
                success: function(response) {
                    if (response.success == true) {
                        $('.toast-header').css({
                            'background-color': '#5cb85c',
                            'color': '#ffffff'
                        });
                        toast_msg = $('#toast_msg').html(response.message);
                        loadUsers();
                        $('.toast').toast('show');
                        $('#new_cls').click();

                    } else if (response.success == false) {
                        $('#new_user').html('Submit');
                        toast_msg = $('#toast_msg').html(response.message);
                        $('.toast-header').css({
                            'background-color': '#d9534f',
                            'color': '#ffffff'
                        });
                        $('.toast').toast('show');
                    } else if (response.success == "validation") {
                        $('#new_user').html('Submit');
                        $('.toast-header').css({
                            'background-color': '#d9534f',
                            'color': '#ffffff'
                        });
                        var errors = response.message;
                        $.each(errors, function(key, value) {
                            toast_msg = $('#toast_msg').html(value);
                        });
                        $('.toast').toast('show');
                    }
                }
            });
        });



        $(".submit-edit-form").click(function(e) {
            e.preventDefault();
            var thisid = $("#user_id").val();
            var name = $("#edit_name").val();
            var mobile_no = $("#edit_mobile_no").val();
            var email = $("#edit_email").val();
            var token = "{{ csrf_token() }}";
            $.ajax({
                type: 'POST',
                url: "{{ route('user_update') }}",
                data: {
                    _token: token,
                    name: name,
                    mobile_no: mobile_no,
                    email: email,
                    id: thisid
                },
                beforeSend: function() {
                    $('#update-user').html("please wait...");
                },
                success: function(response) {
                    if (response.success == true) {
                        $('.toast-header').css({
                            'background-color': '#5cb85c',
                            'color': '#ffffff'
                        });
                        toast_msg = $('#toast_msg').html(response.message);
                        $('.toast').toast('show');
                        // window.location.reload();
                    } else if (response.success == false) {
                        $('#update-user').html('Submit');
                        toast_msg = $('#toast_msg').html(response.message);
                        $('.toast-header').css({
                            'background-color': '#d9534f',
                            'color': '#ffffff'
                        });
                        $('.toast').toast('show');
                    } else if (response.success == "validation") {
                        $('#update-user').html('Submit');
                        $('.toast-header').css({
                            'background-color': '#d9534f',
                            'color': '#ffffff'
                        });
                        var errors = response.message;
                        $.each(errors, function(key, value) {
                            toast_msg = $('#toast_msg').html(value);

                        });
                        $('.toast').toast('show');
                    }
                },
                // complete: function(jqXHR, textStatus) {
                //     if (jqXHR.responseJSON && jqXHR.responseJSON.success == true) {
                //         loadusers();
                //         $('#update-user').html("Update");
                //         $("#form-data-edit").trigger("reset");
                //         $('#edit_cls').click();
                //     } else {
                //         $('#update-user').html("Update");
                //     }
                // },
                complete: function(jqXHR, textStatus) {
                    if (jqXHR.responseJSON && jqXHR.responseJSON.success) {
                        loadUsers();
                        $('#update-user').html("Update");
                        $("#form-data-edit").trigger("reset");
                        $('#edit_cls').click();
                    } else {
                        $('#update-user').html("Update");
                    }
                },
            });
        });
    });

    function editdata(thisid) {
        var url = "{{ route('user.show', ['user' => ':id']) }}";
        url = url.replace(':id', thisid); // Replace the placeholder with the actual ID

        $.ajax({
            type: 'GET',
            url: url,
            data: {
                id: thisid
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {},

            success: function(response) {
                if (response.success == true) {
                    var edit_role = response.data.role_id;

                    $("#user_id").val(response.data.id);
                    $("#edit_name").val(response.data.name);
                    $("#edit_email").val(response.data.email);
                    $("#edit_mobile_no").val(response.data.mobile_no);
                    // $('#offcanvasRightEdit').offcanvas('show');
                    var offcanvasElement = document.getElementById('offcanvasRightEdit');
                    var offcanvasInstance = new bootstrap.Offcanvas(offcanvasElement);
                    offcanvasInstance.show();
                }
            },
        });
    }
</script>