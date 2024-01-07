<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Helpers\ImageUpload;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Blog_Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    public function index(){
        $category=Blog_Category::latest()->get();
        return view('Backend.Pages.Blog.index',compact('category'));
    }
    public function create(){
        $category=Blog_Category::latest()->get();
         return view('Backend.Pages.Blog.create',compact('category'));
    }
    public function get_all_data(Request $request){
        $search=$request->search['value'];
        $columnsForOrderBy=['id','category_id','title','image','status'];
        $orderByColumn=$request->order[0]['column'];
        $orderDirectection=$request->order[0]['dir'];

        $run_query = Blog::with('category:id,name')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subquery) use ($search) {
                    // Search based on the title in the blog table
                    $subquery->whereHas('category', function ($subquery) use ($search) {
                        $subquery->where('name', 'like', "%$search%");
                    });
                    // Or search based on the cateogry name in the category table
                    $subquery->orWhere('title', 'like', "%$search%");
                });
            })
            ->orderBy($columnsForOrderBy[$orderByColumn], $orderDirectection);

        $total=$run_query->count();
        $item=$run_query->skip($request->start)->take($request->length)->get();
        return response()->json([
    		'draw'=>$request->draw,
    		'recordsTotal'=>$total,
    		'recordsFiltered'=>$total,
    		'data' => $item
    	]);
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'slug' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'required|string',
             'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:0,1',
        ]);
        // Create a new Blog instance
        $blog = new Blog();
        $blog->category_id  = $request->category_id ;
        $blog->title  = $request->title ;
        $blog->slug  = $request->slug ;
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;
        /*
        here is my custom method which upload image file and database table save this image path 
        ImageUpload::upload($request, $fieldName, $object, $property, $folder_path)*/

        if ($request->hasFile('image')) {
            ImageUpload::upload($request, 'image', $blog, 'image','Backend/images/blog');
        }
        $blog->status = $request->status;
        $blog->save();
        return redirect()->route('admin.blog.index')->with('success', 'Blog Add Successfully');
    }
    public function edit($id){
        $blog =Blog::find($id);
        $category=Blog_Category::latest()->get();
        return view('Backend.Pages.Blog.Update',compact('blog','category'));
    }
    public function update(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required',
            'slug' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'required|string',
            'status' => 'required|in:0,1',
        ]);
        $blog =Blog::find($request->id);
        $blog->category_id  = $request->category_id ;
        $blog->title  = $request->title ;
        $blog->slug  = $request->slug ;
        $blog->short_description = $request->short_description;
        $blog->description = $request->description;
        /*
        here is my custom method which upload image file and database table save this image path 
        ImageUpload::upload($request, $fieldName, $object, $property, $folder_path)*/

        if ($request->hasFile('image')) {
            ImageUpload::upload($request, 'image', $blog, 'image','Backend/images/blog');
        }
        $blog->status = $request->status;
        $blog->save();
        return redirect()->route('admin.blog.index')->with('success', 'Blog Update Successfully');
    }
    public function delete(Request $request){
      
        $object = Blog::findOrFail($request->id);

        // Delete the blog image
        if ($object->image!=NULL) {
            File::delete(public_path('Backend/images/blog/' . $object->image));
        }
       

        // Delete the blog from the database
        $object->delete();
        return response()->json(['success'=>'Delete Successfull']);
    }
    
}
