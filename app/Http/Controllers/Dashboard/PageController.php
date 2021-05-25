<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index() {

        $pages = Page::all();

        return view('dashboard.pages.index', [
            'pages' => $pages
        ]);
    }

    public function edit(Page $page) {

        return view('dashboard.pages.edit', [
            'page' => $page
        ]);
    }

    public function postEdit(Page $page, Request $r) {

        $page->title = $r->title;
        $page->slug = Str::slug($r->title);
        $page->save();

        return redirect()->back();
    }

    public function editContent(Page $page, $language) {
        $content = $page->content()->where('language', $language)->first();

        return view('dashboard.pages.editContent', [
            'page' => $page,
            'content' => $content,
            'activeLocale' => $language
        ]);
    }

    public function postEditContent(Page $page, $language, Request $request) {
        $content = $page->content()->where('language', $language)->first();

        $content->title = $request->title;
        $content->content = $request->content;
        $content->slug = Str::slug($request->title);
        $content->save();

        return redirect()->back();

        // return view('dashboard.pages.editContent', [
        //     'page' => $page,
        //     'content' => $content,
        //     'activeLocale' => $language
        // ]);
    }
}
