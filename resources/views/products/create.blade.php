@include('admin.common.dash_header');
@include('admin.common.sidebar');

<link href="{{asset('admin/summernote/summernote-bs4.css')}}"  rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Add Product</h4>
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
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-text-input" class="form-label" id="">Name</label>
                                            &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Type Product Name">
                                            <span class="text-danger" id="name_error"></span>
                                        </div>
                                    </div>
                                   
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="basicpill-address-input" class="form-label">Brand</label>
                                            &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                            <select class="form-control select2 brand" id="brand" style="width: 100%;">
                                                <option value="">Select Brand</option>
                                                @foreach($branddata as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="basicpill-address-input" class="form-label">Category</label>
                                            &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                            
                                            <select class="form-control select2 category" id="category" style="width: 100%;">
                                                <option value="">Select Category</option>
                                                @foreach($categoriesdata as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>

                                          
                                        </div>
                                    </div>
                                <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="basicpill-address-input" class="form-label">Sub Category</label>
                                            &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                            <select class="form-control select2 subcategory" id="subcategory" style="width: 100%;">
                                                <option value="">Select Sub Category</option>
                                                @foreach($subcategoriesdata as $subcategory)
                                                    <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div>
                                <div class="row">
                                <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-text-input" class="form-label" id="">Price</label>
                                            &nbsp;&nbsp;<span style="font-size: 70%; color: red; vertical-align: top;">&starf;</span>
                                            <input type="text" class="form-control" id="price" name="price" placeholder="Type Product Price">
                                            <span class="text-danger" id="name_error"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="formrow-text-input" class="form-label" id="">Weight</label>
                                            <input type="text" class="form-control" id="weight" name="weight" placeholder="Type Product Weight">
                                            <span class="text-danger" id="name_error"></span>
                                        </div>
                                    </div>
                                   
                                </div>

                                <div class="row">
                                <div class="col-md-6">
											<div class="form-group">
												<div class="mb-3">
													<label for="exampleInputEmail1" class="form-label">Description</label>
													<textarea class="textarea" name="description" placeholder=""
													style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
													
												</textarea>
												</div>

											</div>
										</div>
                        
                               

                                <div class="col-md-6">
											<div class="form-group">
												<div class="mb-3">
													<label for="exampleInputEmail1" class="form-label">Specification</label>
													<textarea class="textarea" name="key_facts" placeholder="Place some text here"
													style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
												</textarea>
												</div>

											</div>
										</div>
                                        </div>

                                      <div class="row">
                                      <div class="mb-3">
                                                <label class="form-label">Product Image</label>
                                                <input type="file" class="form-control" required placeholder="" name="proimage" />
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

</div>
<!-- end main content-->
@include('admin.common.dash_footer');

<script src="{{asset('admin/summernote/summernote-bs4.min.js')}}"></script>


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


    $(function () {
    // Summernote
    $('.textarea').summernote({
        height: 300,
        toolbar: [
            [ 'style', [ 'style' ] ],
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            [ 'fontname', [ 'fontname' ] ],
            [ 'fontsize', [ 'fontsize' ] ],
            [ 'color', [ 'color' ] ],
            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            [ 'table', [ 'table' ] ],
            [ 'insert', [ 'link'] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
        ]
    })
  })
</script>