<?php

namespace App\Http\Controllers;

use App\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function create()
    {
    	return view('cms.templates.create');
    }

    public function store(Request $request)
    {
        Template::create([
            'name' => $request->name,
            'nb_of_images' => $request->nb_of_images,
            'nb_of_texts' => $request->nb_of_texts
        ]);
        return redirect()->route('cms.templates.index');   
    }

    public function index()
    {
    	$templates = Template::all();
    	return view('cms.templates.index', compact('templates'));
    }

    public function edit($id)
    {
    	$template = Template::findOrFail($id);
    	return view('cms.templates.edit', compact('template'));
    }

    public function update(Request $request, $id)
    {
        $template = Template::findOrFail($id);
        $template->name = $request->name;
        $template->nb_of_images = $request->nb_of_images;
        $template->nb_of_texts = $request->nb_of_texts;
        $template->save();
        return back();
    }
}
