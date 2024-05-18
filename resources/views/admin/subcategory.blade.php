    @include('admin.common.table_header');
    @include('admin.common.sidebar');

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Sub Category Master</h4>
                        </div>
                       
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="float:right;margin-bottom:20px;">Add Sub Category</button>
                    </div>
                </div>
                <!-- end page title -->
                @if($errors->any())
                  @foreach($errors->all() as $error)
                  <div class="alert alert-danger">
                      <strong>{{$error}}</strong>
                  </div>
                  @endforeach
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                             @if(session()->has('message'))   
                            <div class="alert alert-success">
                            <strong>{{session()->get('message')}}</strong>
                            </div>
                            @endif
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Sub Category</th>
                                            <th>Category</th>
                                            <th>Action</th>
                                       
                                        </tr>
                                    </thead>

                                    <tbody>
                                     @foreach($allsubcat as $key => $subcat)
									 <tr>
									    <td>{{$key+1}}</td>
									    <td>{{$subcat->subcategory_name}}</td>
                                        <td>{{$subcat->category}}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Category Actions">
                                                <button class="btn btn-primary editcat" dataid="{{$subcat->id}}"><i class="fa fa-edit"></i></button>&nbsp;&nbsp;
                                                <form method="post" action="{{ route('subcategory.destroy', $subcat->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button class="btn btn-danger delbtn" type="button"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
									 </tr>
                                     @endforeach
									 </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->



            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


    </div>
    <!-- end main content-->

     <!-- right offcanvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Add Category</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
    <div class="card">
                    <div class="card-body">
                        <form class="custom-validation frm" action="{{route('subcategory.store')}}" method="post">
                         @csrf    
                         <div class="mb-3">
                            <label class="form-label"><b>Category</b></label>
                                <select class="form-select" name="category_id" id="category">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>  

                            <div class="mb-3">
                                <label class="form-label"><b>SubCategory Name</b></label>
                                <input type="text" class="form-control"  placeholder="Type something" name="subcategory_name" value=""/>
                            </div>  
                            
                            <div>
                                <div>
                                    <button type="submit" id="sub" class="btn btn-primary waves-effect waves-light me-1">
                                        Submit
                                    </button>

                                    <button type="submit" id="update" class="btn btn-primary waves-effect waves-light me-1" style="display:none;">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
    </div>
</div>



    @include('admin.common.dash_footer');

    <script>
       $(document).ready(function() {
       $('.editcat').click(function() {
        var categoryId = $(this).attr('dataid');
        $.ajax({
            type: "GET",
            url: "{{ route('subcategory.fetch') }}",
            data: {
                category_id: categoryId,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
              $("#sub").hide(); 
              $("#update").show(); 
              var categoryId = response.id; 
              $('.frm').attr('action', '{{ route("subcategory.update", ":id") }}'.replace(':id', categoryId));
              $('#offcanvasRight input[name="subcategory_name"]').val(response.subcategory_name);
              $('#offcanvasRight select[name="category_id"]').val(response.category_id);
              $('#offcanvasRight').offcanvas('show'); 
              
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Failed to fetch category data.");
            }
        });
    });
});

$(document).ready(function() {
    $('.delbtn').click(function(e) {
        e.preventDefault(); // Prevent default form submission
        
        // Prompt confirmation message
        if (confirm("Are you sure you want to delete this Sub Category?")) {
            // If user confirms, submit the form
            $(this).closest('form').submit();
        }
    });
});

    </script>

    