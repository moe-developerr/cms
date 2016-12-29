<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Carbon\Carbon;
use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $imageName = $this->uniqueName($image);
        $resizedImages = $this->resize($image, $imageName, $request->dimensions);
        // return $this->insertToDatabase($resizedImages, $imageName);
    }

    public function index()
    {
    	$images = Image::all();
    	return view('cms.images.index', compact('images'));
    }

    public function edit($id)
    {
        $image = Image::findOrFail($id);
    	return view('cms.images.edit', compact('image'));
    }

    public function update(Request $request)
    {
        
    }

    public function destroy(Request $request, $id)
    {
        if($request->is_ajax == 1) {
            $images = Image::where([
                ['id', '>=', $id],
                ['id', '<=', ($id+3)]
            ])->get();
            $src = $images->first()->src;
            foreach ($images as $image) {
                $destroyedRow = $image->delete();
                if(empty($destroyedRow)) {
                    return 0;
                }
            }
            File::delete([
                public_path("uploads\images\default\\$src"),
                public_path("uploads\images\small\\$src"),
                public_path("uploads\images\medium\\$src"),
                public_path("uploads\images\large\\$src")
            ]);
            return 1;
        }
        else {
            $image = Image::findOrFail($id);
            $destroyedRows = $image->delete();
            if(empty($destroyedRows)) {
                return 0;
            }
            unlink(public_path("uploads\images\\$image->category\\$image->src"));
            return redirect()->route('cms.images.index');
        }
    }

    private function resize($image, $imageName, $dimensions)
    {
        $manager = new ImageManager();
        return $manager->make($image)->resize(
            $dimensions['w'],
            $dimensions['h'],
            function ($constraint) { $constraint->aspectRatio(); }
        )->save(public_path("uploads\images\\$imageName"));
    }

    private function insertToDatabase($resizedImage, $imageName)
    {
        $default = Image::create([
            'filename' => $imageName,
            'url' => public_path('uploads\images'),
            'dimensions' => $resizedImage->width.'x'.$resizedImage->height 
        ]);
        return $default;
    }

    private function uniqueName($image)
    {
        $imageName = $image->getClientOriginalName();
        if(!File::exists(public_path("uploads\images\\$imageName"))) return $imageName;
        return Carbon::now()->timestamp.'_'.$imageName;
    }

}
