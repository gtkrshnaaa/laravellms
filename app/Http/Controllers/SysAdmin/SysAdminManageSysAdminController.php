<?php

namespace App\Http\Controllers\SysAdmin;

use App\Http\Controllers\Controller;
use App\Models\SysAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SysAdminManageSysAdminController extends Controller
{
    // Hanya superadmin yang boleh akses controller ini
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth('sysadmin')->user()->level !== 'superadmin') {
                abort(403, 'Hanya superadmin yang boleh mengakses halaman ini.');
            }
            return $next($request);
        });
    }

    // Menampilkan daftar sysadmin biasa
    public function index()
    {
        $sysadmins = SysAdmin::all(); // ambil semua sysadmin termasuk superadmin
        return view('sysadmin.dashboard.sysadmin_management.index', compact('sysadmins'));
    }
    

    // Menampilkan form tambah sysadmin
    public function create()
    {
        return view('sysadmin.dashboard.sysadmin_management.create');
    }

    // Simpan data sysadmin baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:sysadmins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        SysAdmin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'sysadmin',
        ]);

        return redirect()->route('sysadmin.manage_sysadmin.index')->with('success', 'System Admin berhasil ditambahkan.');
    }

// Hapus pengecekan ini dari method edit
public function edit(SysAdmin $sysadmin)
{
    // if ($admin->level === 'superadmin') {
    //     abort(403, 'Tidak bisa mengedit superadmin.');
    // }

    return view('sysadmin.dashboard.sysadmin_management.edit', compact('sysadmin'));
}

// Hapus juga dari method update
public function update(Request $request, SysAdmin $sysadmin)
{
    // if ($admin->level === 'superadmin') {
    //     abort(403, 'Tidak bisa mengubah superadmin.');
    // }

    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:sysadmins,email,' . $sysadmin->id,
        'password' => 'nullable|min:6|confirmed',
    ]);

    $sysadmin->name = $request->name;
    $sysadmin->email = $request->email;

    if ($request->filled('password')) {
        $sysadmin->password = Hash::make($request->password);
    }

    $sysadmin->save();

    return redirect()->route('sysadmin.manage_sysadmin.index')->with('success', 'System Admin berhasil diperbarui.');
}


    // Hapus admin
    public function destroy(SysAdmin $sysadmin)
    {
        if ($sysadmin->level === 'superadmin') {
            abort(403, 'Tidak bisa menghapus superadmin.');
        }

        $sysadmin->delete();

        return redirect()->route('sysadmin.manage_sysadmin.index')->with('success', 'System Admin berhasil dihapus.');
    }
}
