<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
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
        $name = $request->name;
        $layout = File::get($request->layoutFile);

        if(!empty($name) && !empty($layout) && $request->layoutFile->extension() == 'html') {
            return Template::create([
                'name' => $name,
                'layout' => $layout
            ]);
            return redirect()->route('cms.templates.index');
        } else {
            return response(['message' => 'Failed to Upload']);
        }
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
        $template->layout = $request->layout;
        $template->save();
        return back();
    }

    public function destroy(Request $request, $id)
    {
        $isDestroyed = Template::destroy($id);
        if($request->is_ajax === 'true') {
            if($isDestroyed == 1) return $isDestroyed;
            return 0;
        } else if($request->is_ajax === 'false') {
            if($isDestroyed == 1) return redirect()->route('cms.templates.index');
            return back();
        }
    }
}
