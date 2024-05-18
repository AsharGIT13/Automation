@include('admin.common.table_header');
@include('admin.common.sidebar');

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Product List</h4>

                        <div class="page-title-right">
                            <a href="{{ route('product.create') }}" class="btn btn-primary mb-2">Add New Product</a>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable-products" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S No</th>
                                        <th>Name</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>SubCategory</th>
                                        <th>Price</th>
                                        <th>Weight</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
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
@include('admin.common.dash_footer');

<script>
    $(document).ready(function() {
        loadproducts();

        function loadproducts() {
            $('#datatable-products').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: {
                    type: "POST",
                    url: "{{ route('get_product_list') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                    }
                },
                columns: [{
                        data: 'S No',
                        name: 'S No'
                    }, {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'brand_name',
                        name: 'brand_name'
                    },
                    {
                        data: 'category_name',
                        name: 'category_name'
                    },
                    {
                        data: 'subcategory_name',
                        name: 'subcategory_name'
                    },
                    {
                        data: 'product_price',
                        name: 'product_price'
                    }, 
                    {
                        data: 'product_weight',
                        name: 'product_weight'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        }
    });
</script>