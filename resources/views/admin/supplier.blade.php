    @include('admin.common.table_header');
    @include('admin.common.sidebar');

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Supplier Master</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                    <li class="breadcrumb-item active">Datatables</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Company Name</th>
                                            <th>Mobile Number</th>
                                            <th>VAT / GST Number</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach($suppliers as $key => $supplier)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{ $supplier->name }}</td>
                                            <td>{{ $supplier->email }}</td>
                                            <td>{{ $supplier->company_name}}</td>
                                            <td>{{ $supplier->mobile_number}}</td>
                                            <td>{{ $supplier->vat_no }}</td>
                                            @if($supplier->approved_status == 0)
                                            <td><button class="btn btn-primary approve-btn" data-supplier-id="{{ $supplier->id }}">Approve</button></td>
                                            @else
                                            <td><button class="btn btn-danger denied-btn" data-supplier-id="{{ $supplier->id }}">Denied</button></td>
                                            @endif
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $suppliers->links( "pagination::bootstrap-4") }}
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