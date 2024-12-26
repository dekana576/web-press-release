<?php

namespace App\Http\Controllers;

use App\Models\PressRelease;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PressReleaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard');
    }
    public function pressIndex()
    {
        return view('press_release');
    }

    public function getPress(Request $request)
{
    $press = PressRelease::query();

    // Filter berdasarkan bulan
    if ($request->has('month') && !empty($request->month)) {
        $press->whereMonth('created_at', $request->month);
    }

    // Filter berdasarkan pencarian global
    if ($request->has('search') && !empty($request->search['value'])) {
        $searchValue = $request->search['value'];
        $press->where(function($query) use ($searchValue) {
            $query->where('press_name', 'like', "%{$searchValue}%")
                  ->orWhere('description', 'like', "%{$searchValue}%");
        });
    }

    return DataTables::of($press)
        ->addColumn('action', function ($row) {
            $viewButton = '<a href="/press/' . $row->id . '/view" class="btn btn-sm btn-primary">View</a>';
            $editButton = '<a href="/press/' . $row->id . '/edit" class="btn btn-sm btn-warning">Edit</a>';
            return $viewButton . ' ' . $editButton;
        })
        ->rawColumns(['action'])
        ->make(true);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('data.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        PressRelease::create([
            'press_name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Data added successfully!');
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
