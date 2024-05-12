<?php

namespace App\Http\Controllers;

use App\Models\AssignedMenu;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Role;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('menus.menu_index', compact('menus'));
    }

    public function create()
    {
        return view('menus.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new menu
        $menu = new Menu();
        $menu->name = $request->input('name');
        $menu->save();

        return redirect()->route('menus.menu_index')->with('success', 'Menu created successfully');
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        $menu = Menu::find($id);
        return view('menus.edit', compact('menu'));
    }

    public function update(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $id = $request->input('menu_id');
        $menu = Menu::find($id);
        $menu->name = $request->input('name');
        $menu->save();

        return redirect()->route('menus.menu_index')->with('success', 'Menu updated successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $menu = Menu::find($id);
        $menu->delete();
        return redirect()->route('menus.menu_index')->with('success', 'Menu deleted successfully');
    }
    public function assign_menu_view()
    {
        // Fetch all roles, menus, and menu items
        $roles = Role::all();
        $menus = Menu::with('menuItems')->get();

        return view('menus.assign_menus', compact('roles', 'menus'));
    }

    public function assign_menu_store(Request $request)
    {
        // Validate the request
        $request->validate([
            'role' => 'required|exists:roles,id',
            'menus' => 'nullable|array',
            'menus.*' => 'exists:menus,id',
            'menu_items' => 'nullable|array',
            'menu_items.*' => 'exists:menu_items,id',
        ]);

        // Assign menus to the selected role
        try {

            $role_id = $request->input('role');
            AssignedMenu::where('role_id', $role_id)->delete();
            $menus = $request->input('menus', []);
            $menu_items = $request->input('menu_items', []);

            // $assignedMenus = new AssignedMenu();
            // $assignedMenus->role_id = $role_id;

            // $assignedMenus->menu_id = implode(',', $menus); // Convert array to comma-separated string
            // $assignedMenus->menu_item_id = implode(',', $menu_items); // Convert array to comma-separated string
            // $assignedMenus->save();

            // Insert records into the assigned_menus table
            foreach ($menus as $menu_id) {
                foreach ($menu_items as $menu_item_id) {
                    AssignedMenu::insert([
                        'role_id' => $role_id,
                        'menu_id' => $menu_id,
                        'menu_item_id' => $menu_item_id,
                    ]);
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage()); // Log or output the error message
        }
        return redirect()->route('assign_menu_view')->with('success', 'Menus assigned successfully.');
    }

    public function assign_menu_edit(Role $role)
    {
        // Retrieve all available menus and menu items
        $menus = Menu::all();
        $menuItems = MenuItem::all();

        // Retrieve assigned menus for the given role
        $assignedMenus = $role->menus()->get();

        return view('edit_assigned_menus', compact('role', 'menus', 'menuItems', 'assignedMenus'));
    }

    public function assign_menu_update(Request $request, Role $role)
    {
        // Validate the request data
        $request->validate([
            'menus' => 'nullable|array',
            'menus.*' => 'exists:menus,id',
            'menu_items' => 'nullable|array',
            'menu_items.*' => 'exists:menu_items,id',
        ]);

        // Sync menus and menu items with the role
        $role->menus()->sync($request->input('menus', []));
        $role->menuItems()->sync($request->input('menu_items', []));

        return redirect()->route('assigned_menus.edit', $role)->with('success', 'Assigned menus updated successfully.');
    }

    public function getAssignedMenus($roleId)
    {
        // Your logic to retrieve assigned menus based on the role ID goes here
        $data = AssignedMenu::where('role_id', $roleId)->get();
        return response()->json(['success' => true, 'data' => $data]);
    }
}
