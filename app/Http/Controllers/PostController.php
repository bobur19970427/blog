<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category_id = $request->query('category');
        $posts = Post::all();
        if ($category_id)
        {
            $posts = Post::all()->where('category_id',$category_id);
        }
        $categories = Category::all();



        return view('home', ['posts'=> $posts, 'categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
//        dd($categories);

        return view('add-post', compact('categories', $categories));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                    'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
                ]);
        $extension = $request->file('image')->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $request->file('image')->move(public_path('images/posts'), $filename);

        $post = new Post();
        $post->title = $request->get('title');
        $post->content = $request->get('body');
        $post->slug = Str::lower($request->get('title'));
        $post->category_id = $request->get('category') ?? null;
        $post->image = ('/images/posts/'.$filename) ?? null;
        $post->author_id = $request->user()->id;
        $post->save();
        return back()->with('post_create','Post crete successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id',$id)->first();
        return view('post-detail', compact('post',$post));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::where('id',$id)->first();

        return view('edit-post', ['categories'=> $categories,'post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::where('id', $id)->first();
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:11048',
        ]);
        $extension = $request->file('image')->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $request->file('image')->move(public_path('images/posts'), $filename);

        $post->title = $request->get('title', $post->title);
        $post->content = $request->get('body',$post->content);
        $post->slug = Str::lower($request->get('title',$post->slug));
        $post->category_id = $request->get('category', $post->category_id) ?? null;
        $post->image = ('/images/posts/'.$filename) ?? $post->image;
        $post->save();
        return back()->with('post_update','Post update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return back()->with('delete_post', 'Post Delete Successfully! Which id='.$id);
    }
}
