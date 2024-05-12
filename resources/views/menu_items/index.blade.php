@include('admin.common.table_header');
@include('admin.common.sidebar');
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Menu Items</h4>

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
            <a href="{{ route('menu-items.create') }}" class="btn btn-primary mb-2">Add New Menu Item</a>

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>URL</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menuItems as $menuItem)
                    <tr>
                        <td>{{ $menuItem->id }}</td>
                        <td>{{ $menuItem->name }}</td>
                        <td>{{ $menuItem->url }}</td>
                        <td>
                            <a href="{{ route('menu-items.edit', $menuItem->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('menu-items.destroy', $menuItem->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this menu item?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->


</div>
<!-- end main content-->

@include('admin.common.dash_footer');