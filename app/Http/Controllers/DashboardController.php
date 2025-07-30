<?php

namespace App\Http\Controllers;

use App\Http\Requests\DashboardUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\AttackLog;

class DashboardController extends Controller
{
    /**
     * Display the user's profile form.
     */
     public function index(): View
    {
        $stats = AttackLog::query()
            ->selectRaw("count(*) as total_attacks")
            ->selectRaw("count(case when status = 'Blocked' then 1 end) as blocked_attacks")
            ->selectRaw("count(case when type = 'TCP Flood' then 1 end) as tcp_attacks")
            ->selectRaw("count(case when severity = 'Critical' then 1 end) as critical_attacks")
            ->first();

        return view('dashboard', ['stats' => $stats]);
    }

    
    public function edit(Request $request): View
    {
        return view('dashboard.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(DashboardUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
