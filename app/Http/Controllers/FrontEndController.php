<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Setting;
use App\Post;
use Newsletter;

class FrontEndController extends Controller
{
    public function index(){

        $categories=Category::take(5)->get();
        $settings=Setting::first();
        $first_post=Post::orderBy('created_at','desc')->first();
        $second_post=Post::orderBy('created_at','desc')->skip(1)->take(1)->get()->first();
        $third_post=Post::orderBy('created_at','desc')->skip(2)->take(1)->get()->first();
        $my_category=Category::findorfail(2);

        return view('index')->with('categories',$categories)
                            ->with('settings',$settings)
                            ->with('first_post',$first_post)
                            ->with('second_post',$second_post)
                            ->with('third_post',$third_post)
                            ->with('my_category',$my_category);
    }

    public function search(){
        $posts=post::where('title','like','%'.request('query').'%')->get();
        return view('result')->with('posts',$posts)
                             ->with('title','Search results:'.request('query'))
                             ->with('settings',Setting::first())
                             ->with('categories',Category::take(5)->get());
                                    
    }
    public function subscribe(){
        $email=request('email');

        Newsletter::subscribe($email);
            
            return redirect()->back();
        }

        public function single_post($slug){
            $post=Post::where('slug',$slug)->first();

            $prev_id=Post::where('id','<',$post->id)->max('id');
            $next_id=Post::where('id','>',$post->id)->min('id');

            return view('single')->with('post',$post)
                                 ->with('next',Post::find($next_id))
                                 ->with('prev',Post::find($prev_id))
                                 ->with('settings',Setting::first())
                                 ->with('categories',Category::take(5)->get());  

        }


        public function single_category(Category $category){

            return view('category')->with('category' ,$category)
                                    ->with('settings',Setting::first())
                                    ->with('categories',Category::take(5)->get());  
        }

    }
