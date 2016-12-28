<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Carbon\Carbon;
use App\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    private $image = [
        'dimensions' => [
            'small' => [
                'w' => 250
            ],
            'medium' => [
                'w' => 500
            ],
            'large' => [
                'w' => 1000
            ]
        ]
    ];

    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function create()
    {
    	return view('cms.images.create');
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $imageName = $this->uniqueName($image);
        $this->resize($image, $imageName);
        return $this->insertToDatabase($imageName);
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

    private function resize($image, $imageName)
    {
        $manager = new ImageManager();
        $manager->make($image)->save(
            public_path("uploads\images\default\\$imageName")
        );
        $manager->make($image)->resize(
            $this->image['dimensions']['small']['w'],
            null,
            function ($constraint) { $constraint->aspectRatio(); }
        )->save(public_path("uploads\images\small\\$imageName"));
        $manager->make($image)->resize(
            $this->image['dimensions']['medium']['w'],
            null,
            function ($constraint) { $constraint->aspectRatio(); }
        )->save(public_path("uploads\images\medium\\$imageName"));
        $manager->make($image)->resize(
            $this->image['dimensions']['large']['w'],
            null,
            function ($constraint) { $constraint->aspectRatio(); }
        )->save(public_path("uploads\images\large\\$imageName"));
    }

    private function insertToDatabase($imageName)
    {
        $default = Image::create([
            'src' => $imageName,
            'path' => public_path('uploads\images\default'),
            'category' => 'default'
        ]);
        Image::create([
            'src' => $imageName,
            'path' => public_path('uploads\images\small'),
            'category' => 'small'
        ]);
        Image::create([
            'src' => $imageName,
            'path' => public_path('uploads\images\medium'),
            'category' => 'medium'
        ]);
        Image::create([
            'src' => $imageName,
            'path' => public_path('uploads\images\large'),
            'category' => 'large'
        ]);
        return $default;
    }

    private function uniqueName($image)
    {
        $now = Carbon::now();
        $imageName = $now->year.'_'.$now->month.'_'.$now->day.'_'.$now->timestamp.'_'.$image->getClientOriginalName();
        
        if(File::exists(public_path("uploads\images\default\\$imageName"))) {
            $imageName = substr(sha1(mt_rand()), 0, 5) . '_' . $imageName;
        }

        return $imageName;
    }

}
