<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::orderBy('order')->get();

        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'role' => 'required|string',
            'order' => 'nullable|integer',
        ]);
    

    /**
     * Display the specified resource.
     */
    Menu::create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'role' => 'required|string',
            'order' => 'nullable|integer',
        ]);

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus');
    }
}
