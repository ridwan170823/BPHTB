<?php

namespace App\Http\Controllers;

use App\Models\NotaryProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotaryProfileController extends Controller
{
     public function index(Request $request)
    {
        $profile = NotaryProfile::firstOrNew(['user_id' => Auth::id()]);

        if ($request->wantsJson()) {
            return response()->json($profile);
        }

        return view('notaris.profile.index', compact('profile'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'license_number' => 'required|string',
        ]);

        $profile = NotaryProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            $data
        );

       if ($request->wantsJson()) {
            return response()->json($profile, 201);
        }

        return redirect()->route('notaris.profile.index');
    }

    public function verify(Request $request, NotaryProfile $profile)
    {
        if ($profile->user_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'verification_document' => 'required|file',
        ]);

        $path = $request->file('verification_document')->store('verification_documents', 'public');

        $profile->update([
            'verification_document' => $path,
            'verified_at' => now(),
        ]);

        if ($request->wantsJson()) {
            return response()->json($profile);
        }

        return redirect()->route('notaris.profile.index');
    }
}