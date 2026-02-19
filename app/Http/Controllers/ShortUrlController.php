<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ShortUrlController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        // dd($user->role);

        if (!$user->canCreateShortUrls()) {
            abort(403, 'You do not have permission to create short URLs.');
        }

        return view('short-urls.create');
    }


    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user->canCreateShortUrls()) {
            abort(403, 'You do not have permission to create short URLs.');
        }

        $request->validate([
            'original_url' => 'required|url'
        ]);

        // dd($request->original_url);

        do {
            $shortCode = Str::random(6);

            // dd($shortCode);

        } while (ShortUrl::where('short_code', $shortCode)->exists());

        $shortUrl = ShortUrl::create([
            'original_url' => $request->original_url,
            'short_code' => $shortCode,
            'user_id' => $user->id,
            'company_id' => $user->company_id,
            'clicks' => 0
        ]);

        
        // dd($shortUrl->toArray());

        return redirect()->route('dashboard')
            ->with(
                'success',
                'Short URL created successfully! Your short URL is: ' . url('/s/' . $shortCode)
            );
    }


    public function redirect($code)
    {
        $shortUrl = ShortUrl::where('short_code', $code)->firstOrFail();

        // dd($shortUrl);

        $shortUrl->increment('clicks');

        return redirect()->away($shortUrl->original_url);
    }
}
