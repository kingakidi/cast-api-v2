<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;


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
        
        
        // $validate = $request->validate([
            // 'post_user_id'=>'required',
            // 'post_title'=>'required', 
            // 'post_content'=>"required", 
            // 'post_slug'=>"required"

        // ]);

       $validator = Validator::make($request->all(), ['post_user_id'=>'required',
       'title'=>'required', 
       'content'=>"required", 
       'slug'=>"required"]);

        if ($request->images === "undefined" OR $request->images === NULL) {
            $imagePath = "";
        }else{
            
            $file= $request->file('images');
            $filename= strtolower(date('YmdHi_').$file->getClientOriginalName());
            $file-> move(public_path('public/Image'), $filename); 
            $imagePath= $filename;
        }

        if ($validator->fails()) {
        
            $errorMessage =  $validator->errors();

            $data = ["statusMessage" => "Failed to create post ", $errorMessage];
            return response( $data, 200);

          
        }

        $post = new Post;
        $post->title = $request->title; 
        $post->post_user_id = $request->post_user_id;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->slug = $request->slug; 
        $post->images = $imagePath;
    
        if ($post->save()) {
            return $post;
        }else{
            return response()->json(['message'=> "Error passing your form"], 404);
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