<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AbsensiAuthController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::guard('siswa')->check()) {
            return redirect()->route('absensi.scan');
        }

        if (Auth::guard('guru')->check()) {
            return $this->redirectGuruByRole(Auth::guard('guru')->user()->role);
        }

        return view('absensi.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        Auth::guard('siswa')->logout();
        Auth::guard('guru')->logout();

        if (Auth::guard('siswa')->attempt([
            'nis' => $credentials['username'],
            'password' => $credentials['password'],
        ])) {
            $request->session()->regenerate();

            return redirect()->intended(route('absensi.scan'));
        }

        if (Auth::guard('guru')->attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password'],
        ])) {
            $request->session()->regenerate();

            return $this->redirectGuruByRole(Auth::guard('guru')->user()->role);
        }

        return back()
            ->withErrors(['username' => 'NIS/username atau password tidak sesuai.'])
            ->withInput($request->only('username'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('siswa')->logout();
        Auth::guard('guru')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('absensi.login');
    }

    private function redirectGuruByRole(string $role): RedirectResponse
    {
        return match ($role) {
            'guru_piket' => redirect()->intended(route('absensi.piket')),
            'admin_tu' => redirect()->intended(route('absensi.admin')),
            'kepsek' => redirect()->intended(route('absensi.laporan')),
            default => redirect()->route('absensi.login')
                ->withErrors(['username' => 'Role guru tidak memiliki akses absensi.']),
        };
    }
}
