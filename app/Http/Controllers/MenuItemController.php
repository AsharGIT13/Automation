<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\MenuItem;

class MenuItemController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::all();
        return view('menu_items.index', compact('menuItems'));
    }
    public function create()
    {
        $menus = Menu::all();
        return view('menu_items.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'menu_id' => 'required|exists:menus,id', // Ensure menu_id exists in menus table
        ]);

        MenuItem::create([
            'name' => $request->name,
            'url' => $request->url,
            'menu_id' => $request->menu_id, // Assign menu_id provided by the user
        ]);
        return redirect()->route('menu-items.index')->with('success', 'Menu item created successfully.');
    }

    public function edit(MenuItem $menuItem)
    {
        $menus = Menu::all();
        return view('menu_items.edit', compact('menuItem', 'menus'));
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
        ]);

        $menuItem->update($request->all());

        return redirect()->route('menu-items.index')->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return redirect()->route('menu-items.index')->with('success', 'Menu item deleted successfully.');
    }
}
