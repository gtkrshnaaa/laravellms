<?php

namespace App\Http\Controllers\PublicPage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicPageLandingPageController extends Controller
{
    /**
     * Menampilkan halaman landing page internal yang modern.
     */
    public function index()
    {
        return view('landingpage');
    }
}
