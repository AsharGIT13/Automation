@include('admin.common.dash_header');
@include('admin.common.sidebar');
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Form Validation</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Form Validation</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <!-- end row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="custom-validation" action="#">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="formrow-text-input" class="form-label" id="">Name</label>
                                            &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Type Product Name">
                                            <span class="text-danger" id="name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="formrow-text-input" class="form-label" id="">Weight</label>
                                            <input type="text" class="form-control" id="weight" name="weight" placeholder="Type Product Weight">
                                            <span class="text-danger" id="name_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="formrow-text-input" class="form-label" id="">Price</label>
                                            &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                            <input type="text" class="form-control" id="price" name="price" placeholder="Type Product Price">
                                            <span class="text-danger" id="name_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="basicpill-address-input">Category</label>
                                            &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                            <select class="form-control select2 category" id="category" style="width: 100%;">
                                                <option value="">Select Category</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="basicpill-address-input">Sub Category</label>
                                            &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                            <select class="form-control select2 subcategory" id="subcategory" style="width: 100%;">
                                                <option value="">Select Sub Category</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="basicpill-address-input">Brand</label>
                                            &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                            <select class="form-control select2 brand" id="brand" style="width: 100%;">
                                                <option value="">Select Brand</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            Submit
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->


            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> © Minible.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end d-none d-sm-block">
                        Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://themesbrand.com/" target="_blank" class="text-reset">Themesbrand</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- end main content-->
@include('admin.common.dash_footer');

<script>
    $(document).ready(function() {

        CaregoryList();

        function CaregoryList() {
            var token = "{{ csrf_token() }}";
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _token: token,
                },
                success: function(response) {
                    if (response.success == true) {
                        var array = response.data;
                        console.log(array);
                        var select_class = $("#state");
                        select_class.empty();
                        select_class.append(
                            "<option value='' disabled selected>Select Caregory</option>"
                        );
                        if (array != '') {
                            for (i in array) {
                                select_class.append("<option value=" + array[i].id + ">" + array[i]
                                    .name + "</option>");
                            }
                        }
                    }
                },
            });
        }
    });
</script>