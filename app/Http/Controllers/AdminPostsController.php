<?php

namespace App\Http\Controllers;

use App\Post;
use App\Photo;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostsRequest;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        
        $user = Auth::User();
        $input = $request->all();

        if($file = $request->file('photo')){

            $name = time().$file->getClientOriginalName();
            $file->move('images', $name); //move photo

            $photo = Photo::create(['file' => $name]); //create photo
            $input['photo_id'] = $photo->id; //assign photo id to user data
        }

        $user->posts()->create($input);

        return redirect('/admin/posts')->with('status', 'Post created successful.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.posts.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::pluck('name', 'id')->all();

        return view('admin.posts.edit', compact('post', 'categories'));
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

        $post = Post::findOrFail($id);
        $input = $request->all();

        if($file = $request->file('photo')){

            $name = time().$file->getClientOriginalName();
            $file->move('images', $name); //move photo

            $photo = Photo::create(['file' => $name]); //create photo
            $input['photo_id'] = $photo->id; //assign photo id to user data

            //remove old image
            $old_photo = Photo::find($post->photo_id);
            if($old_photo){
                unlink(public_path().$post->photo->file);
                $old_photo->delete();
            }
        }

        $post->update($input);

        return redirect('/admin/posts')->with('status', 'User update successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $post = Post::findOrFail($id);

        //remove old image
        $old_photo = Photo::find($post->photo_id);
        if($old_photo){
            unlink(public_path().$post->photo->file);
            $old_photo->delete();
        }

        $post->delete();

        return redirect('/admin/posts')->with('status', 'Post deleted successful.');
    }
}
