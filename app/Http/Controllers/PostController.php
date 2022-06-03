<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $table->unsignedBigInteger('post_user_id');
        // $table->string("post_title");
        // $table->text("post_content");
        // $table->text("post_images");
        // $table->string('post_slug');
        //
        $validate = $request->validate([
            'post_user_id'=>'required',
            'post_title'=>'required', 
            'post_content'=>"required", 
            'post_images'=>"required", 
            'post_slug'=>"required"

        ]);
        $post = new Post; 
        $post->post_title = $request->post_title; 
        $post->post_user_id = $request->post_user_id; 
        $post->post_content = $request->post_content; 
        $post->post_images = $request->post_images; 
        $post->post_slug = $request->post_slug;

        
        
        if ($post->save()) {
           return "post created successfully";
        }else{
            return "Error: Failed to create post";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return $post;
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
        $new_post = Post::find($id); 
        // $post->post_title = $request->post_title;
        
        // $post->save();

        $new_post->update($request->all());
        return $new_post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $post = Post::find($id); 
        if ($post !== NULL) {
            $post->delete();

            return $post;
        }else{
            return "Post does not exist";
        }
        
    }
}