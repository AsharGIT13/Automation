<div class="container">
    <h2>Edit Menu</h2>
    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $menu->name }}">
            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>