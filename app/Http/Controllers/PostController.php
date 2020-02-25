<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Category;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();

        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories',Category::all())
                                   ->with('tags',Tag::all());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //form-validation
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'featured_img'=>'required|image'
            
        ]);

        //store into db
       $featured = $request->featured_img;
       $featured_new_name = time().$featured->getClientOriginalName();
       //$featured->move('uploads\posts',$featured_new_name);
       Storage::disk('public')->put($featured_new_name,file_get_contents($featured));


       //Mass Assignment
        $post=Post::create([
            'title'=>$request->title,
            'slug'=>str_slug($request->title),
            'content'=>$request->content,
            'featured_image'=>asset('storage/'.$featured_new_name),
            'category_id'=>$request->category_id
        ]);
        $post->tags()->attach($request->tags);

        Session::flash('success','Post Created Successfully');

        //return redirect
        return redirect()->route('post.index');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show')->with('post',$post);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //form-validation
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required',
            'featured_img'=>'nullable|image'
        ]);

        //update
        if($request->hasFile('featured_img')){
          $featured = $request->featured_img;
          $featured_new_name = time().$featured->getClientOriginalName();
          Storage::disk('public')->put($featured_new_name,file_get_contents($featured));
          $post->featured_image=asset('storage/'.$featured_new_name);

        }



        $post->title=$request->title;
        $post->content=$request->content;
        $post->save();

        Session::flash('success','Post Update Successfully');


         //return redirect
         return redirect()->route('post.index');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        Session::flash('success','Post Trashed Successfully');
        return redirect()->route('post.index');
    }

    public function trashed(){
        $posts=Post::onlyTrashed()->get();
        return view('posts.trashed')->with('posts',$posts);
    }

    public function restore($id){
        $post=Post::withTrashed()->where('id',$id)->first();
        $post->restore();
        Session::flash('success','Post Restored Successfully');

        return redirect()->route('post.index');
        
    }

    public function kill($id){
        $post=Post::withTrashed()->where('id',$id)->first();
        $post->forceDelete();
        Session::flash('success','Post Deleted Successfully');

        return redirect()->route('post.index');
        
    }


}
