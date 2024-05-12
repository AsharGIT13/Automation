<div class="container">
    <h1>Edit Assigned Menus</h1>
    <form method="POST" action="{{ route('assign_menu_update', $role->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="role">Select Role:</label>
            <select name="role" id="role" class="form-control">
                <option value="{{ $role->id }}" selected>{{ $role->name }}</option>
                <!-- You can populate the role dropdown with all available roles -->
            </select>
        </div>

        <div class="form-group">
            <label for="menus">Select Menus:</label>
            <select name="menus[]" id="menus" class="form-control" multiple>
                @foreach ($menus as $menu)
                <option value="{{ $menu->id }}" {{ in_array($menu->id, $assignedMenus->pluck('menu_id')->toArray()) ? 'selected' : '' }}>{{ $menu->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="menu_items">Select Menu Items:</label>
            <select name="menu_items[]" id="menu_items" class="form-control" multiple>
                @foreach ($menuItems as $menuItem)
                <option value="{{ $menuItem->id }}" {{ in_array($menuItem->id, $assignedMenus->pluck('menu_item_id')->toArray()) ? 'selected' : '' }}>{{ $menuItem->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Assigned Menus</button>
    </form>
</div>