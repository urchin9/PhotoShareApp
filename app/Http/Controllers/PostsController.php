<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disk = Storage::disk('s3');
        $files = $disk->files('/');
        // dd($files);
        return view('posts.index', ['files' => $files]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $fileContents = file_get_contents($file->getRealPath());

        $disk = Storage::disk('s3');
        $disk->put($file->hashName(), $fileContents);

        return redirect('/posts');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($filename)
    {
        $disk = Storage::disk('s3');
        $disk->delete($filename);
        return redirect('/');
    }
}
