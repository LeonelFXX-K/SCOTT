<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();

        $hourlyReports = Report::where('type', 'Hourly')->where('reported_by', $userId)->get();
        $momentaryReports = Report::where('type', 'Momentary')->where('reported_by', $userId)->get();
        $functionReports = Report::where('type', 'Functions')->where('reported_by', $userId)->get();

        return view('history.index', compact('hourlyReports', 'momentaryReports', 'functionReports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
