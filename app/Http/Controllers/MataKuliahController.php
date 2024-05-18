<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Http\Requests\StoreMataKuliahRequest;
use App\Http\Requests\UpdateMataKuliahRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MataKuliahController extends Controller
{
    /**
     * Instantiate a new ProductController instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-matakuliah|edit-matakuliah|delete-matakuliah', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-matakuliah', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-matakuliah', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-matakuliah', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('matakuliahs.index', [
            'matakuliahs' => MataKuliah::latest()->paginate(3)
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMataKuliahRequest $request): RedirectResponse
    {
        MataKuliah::create($request->all());
        return redirect()->route('products.index')
            ->withSuccess('New product is added successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(MataKuliah $matakuliah): View
    {
        return view('matakuliahs.show', [
            'matakuliah' => $matakuliah
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKuliah $matakuliah): View
    {
        return view('matakuliahs.edit', [
            'matakuliah' => $matakuliah
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMataKuliahRequest $request, MataKuliah $matakuliah): RedirectResponse
    {

        $matakuliah->update($request->all());
        return redirect()->back()
            ->withSuccess('matakuliah is updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKuliah $matakuliah): RedirectResponse
    {
        $matakuliah->delete();
        return redirect()->route('matakuliahs.index')
            ->withSuccess('matakuliah is deleted successfully.');
    }
}
