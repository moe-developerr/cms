<?php

namespace App\Http\Controllers;

use App\Page;
use App\Template;
use App\Image;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth', [
            'except' => 'show'
        ]);
    }

    public function create()
    {
        $templates = Template::all();
        $pages = Page::all();
        return view('cms.pages.create', compact('templates', 'pages'));
    }

    public function store(Request $request)
    {
        $isAjax = $request->is_ajax === 'true' ? true : false;
        if($isAjax) {

        }
        else {
            Page::create([
                'template_id' => $request->template_id,
                'name' => $request->name,
                'slug' => $request->slug,
                'title' => $request->title,
                'meta_description' => $request->meta_description,
                'is_visible' => $request->is_visible,
                'parent_id' => $request->parent_id,
                'content' => json_encode($request->content)
            ]);
            return redirect()->route('cms.pages.index');
        }
    }

    public function show($slug)
    {
        return $slug;
    }

    public function index()
    {
        $pages = Page::all();
    	return view('cms.pages.index', compact('pages'));
    }

    public function edit($id)
    {
        $myPage = Page::findOrFail($id);
        $templates = Template::all();
        $pages = Page::all();
    	return view('cms.pages.edit', compact('myPage', 'templates', 'pages'));
    }

    public function update(Request $request)
    {
        
    }
}
