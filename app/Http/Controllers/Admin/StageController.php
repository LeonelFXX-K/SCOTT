<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stage;
use Illuminate\Http\Request;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stages = Stage::all();

        return view("admin.stages.index", compact("stages"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.stages.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
        ], [], [
            'name' => __('stage name'),
            'status' => __('stage status'),
        ]);

        $stage = Stage::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => __('Well done!'),
            'text' => __('New stage created successfully.')
        ]);

        return redirect()->route('admin.stages.show', $stage);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stage $stage)
    {
        return view('admin.stages.show', compact('stage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stage $stage)
    {
        return view('admin.stages.edit', compact('stage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stage $stage)
    {
        $request->validate([
            'name' => 'required|string',
            'status' => 'required|string',
        ], [], [
            'name' => __('stage name'),
            'status' => __('stage status'),
        ]);

        $stage->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => __('Well done!'),
            'text' => __('Stage updated successfully.')
        ]);

        return redirect()->route('admin.stages.show', $stage);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stage $stage)
    {
        $stage->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => __('Well done!'),
            'text' => __('Stage deleted successfully.')
        ]);

        return redirect()->route('admin.stages.index');
    }
}
