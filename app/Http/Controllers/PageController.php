<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use App\Template;

class PageController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function create()
    {
        $templates = Template::all();
        $pages = Page::all();
        return view('cms.pages.create', compact('templates', 'pages'));
    }

    public function store(Request $request)
    {
        Page::create([
            'template_id' => $request->template_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'title' => $request->title,
            'meta_description' => $request->meta_description,
            'is_visible' => $request->is_visible,
            'parent_id' => $request->parent_id
        ]);
        return redirect()->route('cms.pages.index');
    }

    public function show($slug)
    {

    }

    public function index()
    {
        $pages = Page::all();
    	return view('cms.pages.index', compact('pages'));
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
    	// get the page from database
    	// send the page data to the view
    	return view('cms.pages.edit', compact('page'));
    }

    public function update(Request $request)
    {
        
    }
}