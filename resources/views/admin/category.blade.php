    @include('admin.common.table_header');
    @include('admin.common.sidebar');

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Category Master</h4>
                        </div>
                       
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="float:right;margin-bottom:20px;">Add Category</button>
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
                                            <th>Category Name</th>
                                            <th>Action</th>
                                       
                                        </tr>
                                    </thead>

                                     <tbody>
									 <tr>
									    <td>1</td>
									    <td>Electronics</td>
									    <td><button>Delete</button></td>
									 </tr>
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
                        <form class="custom-validation" action="{{route('category.store')}}" method="post">
                         @csrf    
                        <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" class="form-control" required placeholder="Type something" name="category_name" value=""/>
                            </div>  
                            <div>
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                        Submit
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
            $('.approve-btn').click(function() {
                var supplierId = $(this).data('supplier-id');
                $.ajax({
                    url: "{{ route('supplier.approve') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: supplierId
                    },
                    success: function(response) {
                        // Handle success response
                        alert(response.message); // Show success message
                        location.reload();
                    },
                    error: function(xhr) {
                        // Handle error response
                        console.log(xhr.responseText); // Log error message
                        // You can show an error message to the user or handle the error as needed
                    }
                });
            });

            $('.denied-btn').click(function() {

                var supplierId = $(this).data('supplier-id');
                // Make an AJAX request to the approval route
                $.ajax({
                    url: "{{ route('supplier.denied') }}",
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: supplierId
                    },
                    success: function(response) {
                        // Handle success response
                        alert(response.message);
                        location.reload();
                    },
                    error: function(xhr) {
                        // Handle error response
                        console.log(xhr.responseText); // Log error message
                        // You can show an error message to the user or handle the error as needed
                    }
                });
            });
        });
    </script>