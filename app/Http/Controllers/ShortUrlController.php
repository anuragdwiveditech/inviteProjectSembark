<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;


class ShortUrlController extends Controller
{
public function index()
{
    $user = Auth::user();

    if ($user->role === 'SuperAdmin') {
        // Load all companies with users and their short URLs
        $companies = Company::with('users.shortUrls')->get();
        return view('short_urls.index', compact('companies'));
    }

    if ($user->role === 'Admin') {
        // Get all short URLs created by users of the same company
        $urls = ShortUrl::whereHas('user', function ($query) use ($user) {
            $query->where('company_id', $user->company_id);
        })->with('user')->get();

        return view('short_urls.index', compact('urls'));
    }

    // Member → only their own short URLs
    $urls = $user->shortUrls()->with('user')->get();
    return view('short_urls.index', compact('urls'));
}


    public function store(Request $request) {
        $request->validate(['original_url' => 'required|url']);
        $user = Auth::user();
        if ($user->role === 'SuperAdmin') abort(403);
        ShortUrl::create([
            'user_id' => $user->id,
            'original_url' => $request->original_url,
            'short_code' => Str::random(6),
        ]);
        return redirect()->back()->with('success', 'Short URL created!');
    }

    public function resolve($shortCode) {
        $url = ShortUrl::where('short_code', $shortCode)->firstOrFail();
        return redirect($url->original_url);
    }
}
