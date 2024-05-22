@include('admin.common.table_header');
@include('admin.common.sidebar');

<style>
    .menu-container{
        background-color: #fff;
        padding:20px;
    }
    .form-check-input{
        border: 1px solid #000;
    }
    .submenu{
        margin-top:15px;
    }
    .mainmenu{
        border-bottom:1px dotted #000;
        padding-top:20px;
    }
</style>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Assign Menus to Roles</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Datatables</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container">
                <form action="{{ route('assign_menu_store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="role">Select Role:</label>
                        <select name="role" id="role" class="form-control">
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="margin-top:50px;">
                        <h4>Menus:</h4>
                        <div class="menu-container">
                        @foreach($menus as $menu)
                        <div class="form-check mainmenu">
                            <input type="checkbox" name="menus[]" value="{{ $menu->id }}" class="form-check-input menu-checkbox" id="menu_{{ $menu->id }}">
                            <label class="form-check-label" for="menu_{{ $menu->id }}"><b>{{ $menu->name }}</b></label>
                        </div>
                        <ul class="list-inline submenu">
                            @foreach($menu->menuItems as $menuItem)
                            <li class="list-inline-item">
                                <input type="checkbox" name="menu_items[]" value="{{ $menuItem->id }}" class="form-check-input menu-checkbox" id="menu_item_{{ $menuItem->id }}">
                                <label class="form-check-label" for="menu_item_{{ $menuItem->id }}">{{ $menuItem->name }}</label>
                            </li class="list-inline-item">
                            @endforeach
                        </ul>
                        @endforeach
                    </div>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin-top:50px;">Assign</button>
                </form>
            </div>
        </div>
    </div>
    @include('admin.common.dash_footer');

    <script>
        $(document).ready(function() {
            $('#role').change(function() {
                var roleId = $(this).val();
                if (roleId) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('get_assigned_menus', ':role') }}".replace(':role', roleId),
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                var assignedMenus = response.data;
                                $('.menu-checkbox, .menu-item-checkbox').prop('checked', false);
                                $.each(assignedMenus, function(index, value) {
                                    $('#menu_' + value.menu_id).prop('checked', true);
                                    $('#menu_item_' + value.menu_item_id).prop('checked', true);
                                });
                            } else {
                                console.error(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('.menu-checkbox, .menu-item-checkbox').prop('checked', false);
                }
            });
        });
    </script>