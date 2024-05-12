<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Role;
use App\Models\AssignedMenu;

class AssignMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $roles = Role::all();
        $assignedMenus = AssignedMenu::all()->groupBy('menu_id')->toArray();
        return view('assign_menus', compact('menus', 'roles', 'assignedMenus'));
    }

    public function store(Request $request)
    {
        AssignedMenu::truncate(); // Remove existing assignments

        foreach ($request->menus as $menuId => $roles) {
            foreach ($roles as $roleId => $value) {
                if ($value == 1) {
                    AssignedMenu::create([
                        'menu_id' => $menuId,
                        'role_id' => $roleId,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Menus assigned to roles successfully.');
    }
}
