<?php

namespace App\Http\Controllers;

use Storage;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class PostsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(30);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->validate([
            'image' => 'required|file|image|max:4000',
        ]);

        $file = $params['image'];
        
        if ($file) {
            // read data and rotate the image
            $img = Image::make($request->file('image'));
            $name = $file->getClientOriginalName();
            $img->orientate();
            // resize
            $width = 500;
            $img->resize(null, $width, function ($constraint) {
                $constraint->aspectRatio();
            });
            // save to S3!
            $filename = $file->hashName();
            $disk = Storage::disk('s3');
            $disk->put($filename, $img->encode());
    
            // create new record in DB
            $post = new Post();
            $user = User::find(auth()->id());
            $post->user_id = $user->id;
            $post->img_filename = $filename;
            $post->save();

        }            
        return redirect('/posts')->with('status', 'Image Uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($filename)
    {
        $disk = Storage::disk('s3');
        try {
            $contents = $disk->get($filename);
            $mimeType = $disk->mimeType($filename);
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], 404);
        }
        return response($contents)->header('Content-Type', $mimeType);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        // dd($id);
        $filename = $post->img_filename;
        
        // dd($filename);
        $disk = Storage::disk('s3');
        $disk->delete($filename);

        // delete DB record
        $post->delete();
        return redirect('/posts')->with('status', 'Deleted an Image');
    }
}
