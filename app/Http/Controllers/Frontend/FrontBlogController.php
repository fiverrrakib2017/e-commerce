<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Blog_Category;
use Illuminate\Http\Request;

class FrontBlogController extends Controller
{
    public function show_blog_page(){
        $blog_category = Blog_Category::latest()->get();
        $data = Blog::latest()->paginate(6); 
        return view('Frontend.Pages.Blog.Blog', compact('blog_category', 'data'));
    }
    public function category_blog($id){
        $blog_category = Blog_Category::latest()->get();
         $data = Blog::where('category_id',$id)->latest()->paginate(6); 
        return view('Frontend.Pages.Blog.Category', compact('blog_category', 'data'));
    }
    
    public function single_blog_page($id){
      $blog=  Blog::find($id);
      return view('Frontend.Pages.Blog.Single_Page',compact('blog'));
    }
}
