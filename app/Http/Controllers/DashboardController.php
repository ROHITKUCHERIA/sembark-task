<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // dd($user);

        if ($user->isSuperAdmin()) {

            $shortUrls = ShortUrl::with(['user', 'company'])->get();

            // dd($shortUrls);

            return view('dashboard.superadmin', compact('shortUrls'));
        }

        if ($user->isAdmin()) {

            $shortUrls = ShortUrl::with('user')
                ->where('company_id', $user->company_id)
                ->get();

            // dd("Admin company:", $user->company_id);

            return view('dashboard.admin', compact('shortUrls'));
        }

        if ($user->isMember()) {

            
            $shortUrls = ShortUrl::with('user')
                ->where('user_id', $user->id)
                ->get();

            // dd("Member ID:", $user->id);

            return view('dashboard.member', compact('shortUrls'));
        }

        // dd("Unauthorized role");

        abort(403, 'Unauthorized access.');
    }
}
