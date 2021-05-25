<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class PageController extends Controller
{
    public function view($locale = null, $page = null) {

        // define default locale
        if(!$locale) $locale = Config::get('app.locale');

        // define default page ( = home )
        if(!$page) {
            $pageContent = PageContent::where('page_id', 1)->where('language', $locale)->first();
        } else {
            $pageContent = PageContent::where('language', $locale)->where('slug', $page)->first();
        }

        // page not found
        if(!$pageContent) abort(404);

        return view('page', [
            'locale' => $locale,
            'content' => $pageContent,
            'pages' => PageContent::where('language', $locale)->get()
        ]);
    }
}
