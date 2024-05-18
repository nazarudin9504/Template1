<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-mahasiswa|edit-mahasiswa|delete-mahasiswa', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-mahasiswa', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-mahasiswa', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete-mahasiswa', ['only' => ['destroy']]);
    }
    public function index(): View
    {
        return view('mahasiswas.index', [
            'mahasiswas' => User::latest('id')->paginate(3)
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('mahasiswas.create', [
            'roles' => Role::pluck('name')->all()
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMahasiswaRequest $request): RedirectResponse
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);
        $mahasiswa = User::create($input);
        $mahasiswa->assignRole($request->roles);
        return redirect()->route('mahasiswas.index')
            ->withSuccess('New user is added successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(User $mahasiswa): View
    {
        return view('mahasiswas.show', [
            'mahasiswa' => $mahasiswa
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $mahasiswa): View
    {
        // Check Only Super Admin can update his own Profile
        if ($mahasiswa->hasRole('Super Admin')) {
            if ($mahasiswa->id != auth()->user()->id) {
                abort(403, 'USER DOES NOT HAVE THE RIGHT PERMISSIONS');
            }
        }
        return view('mahasiswas.edit', [
            'mahasiswa' => $mahasiswa,
            'roles' => Role::pluck('name')->all(),
            'userRoles' => $mahasiswa->roles->pluck('name')->all()
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMahasiswaRequest $request, User $mahasiswa): RedirectResponse
    {
        $input = $request->all();
        if (!empty($request->password)) {
            $input['password'] = Hash::make($request->password);
        } else {
            $input = $request->except('password');
        }
        $mahasiswa->update($input);
        $mahasiswa->syncRoles($request->roles);
        return redirect()->back()
            ->withSuccess('User is updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $mahasiswa): RedirectResponse
    {
        // About if mahasiswa is Super Admin or mahasiswa ID belongs to Auth mahasiswa
        if ($mahasiswa->hasRole('Super Admin') || $mahasiswa->id == auth()->user()->id) {
            abort(403, 'mahasiswa DOES NOT HAVE THE RIGHT PERMISSIONS');
        }
        $mahasiswa->syncRoles([]);
        $mahasiswa->delete();
        return redirect()->route('mahasiswas.index')
            ->withSuccess('User is deleted successfully.');
    }
}
