<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class InvitationController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        // dd($user);

        if (!$user->isSuperAdmin() && !$user->isAdmin()) {
            abort(403, 'You do not have permission to send invitations.');
        }

        $companies = Company::all();

        // dd($companies);

        return view('invitations.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

                 // dd($request->all());

        $request->validate([
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:Admin,Member',
            'company_id' => 'required_if:role,Admin,Member|exists:companies,id'
        ]);


        if ($user->isAdmin()) {

                // dd("Admin company:", $user->company_id);

            if ($request->company_id != $user->company_id) {
                return back()->withErrors([
                    'company_id' => 'Admin can only invite users to their own company.'
                ]);
            }
        }

        $existingInvitation = Invitation::where('email', $request->email)
            ->where('status', 'pending')
            ->where('expires_at', '>', Carbon::now())
            ->first();

    // dd($existingInvitation);

        if ($existingInvitation) {
            return back()->withErrors([
                'email' => 'An active invitation already exists for this email.'
            ]);
        }

        $token = Str::random(60);

                // dd($token);

        $invitation = Invitation::create([
            'email' => $request->email,
            'token' => $token,
            'company_id' => $request->company_id,
            'invited_by' => $user->id,
            'role' => $request->role,
            'expires_at' => Carbon::now()->addDays(7),
            'status' => 'pending'
        ]);

            // dd($invitation);

        return redirect()->route('invitations.index')
            ->with('success', 'Invitation sent successfully!');
    }

    public function index()
    {
        $user = Auth::user();

        // dd($user->role);

        if ($user->isSuperAdmin()) {

            $invitations = Invitation::with(['company', 'inviter'])->get();

        } elseif ($user->isAdmin()) {

            $invitations = Invitation::with(['company', 'inviter'])
                ->where('company_id', $user->company_id)
                ->get();

        } else {

            abort(403);
        }


        return view('invitations.index', compact('invitations'));
    }


}
