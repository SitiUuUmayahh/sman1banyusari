<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AbsensiSiswaController extends Controller
{
    public function index(Request $request): View
    {
        $students = Siswa::with('kelas')
            ->when($request->filled('search'), function ($query) use ($request): void {
                $term = trim($request->string('search')->toString());
                $query->where(function ($studentQuery) use ($term): void {
                    $studentQuery->where('nis', 'like', "%{$term}%")
                        ->orWhere('nama', 'like', "%{$term}%");
                });
            })
            ->orderBy('nama')
            ->paginate(15)
            ->withQueryString();

        return view('absensi.admin.siswa.index', compact('students'));
    }

    public function create(): View
    {
        return view('absensi.admin.siswa.form', [
            'student' => new Siswa(['status' => 'aktif']),
            'classes' => Kelas::orderBy('nama_kelas')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['password'] = Hash::make($data['nis']);
        Siswa::create($data);

        return redirect()->route('absensi.admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan. Password otomatis menggunakan NIS.');
    }

    public function edit(Siswa $student): View
    {
        return view('absensi.admin.siswa.form', [
            'student' => $student,
            'classes' => Kelas::orderBy('nama_kelas')->get(),
        ]);
    }

    public function update(Request $request, Siswa $student): RedirectResponse
    {
        $data = $this->validated($request, $student);
        $student->update($data);

        return redirect()->route('absensi.admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $student): RedirectResponse
    {
        $student->delete();

        return redirect()->route('absensi.admin.siswa.index')->with('success', 'Siswa dan riwayat absensinya berhasil dihapus.');
    }

    private function validated(Request $request, ?Siswa $student = null): array
    {
        return $request->validate([
            'nis' => ['required', 'string', 'max:255', 'unique:siswa,nis,'.($student?->id ?? 'NULL')],
            'nama' => ['required', 'string', 'max:255'],
            'kelas_id' => ['required', 'integer', 'exists:kelas,id'],
            'no_wa_ortu' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:aktif,lulus,pindah'],
        ]);
    }
}
