<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog_Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
       $data= Blog_Category::latest()->get();
       return view('Backend.Pages.Blog.category');
    }
    public function get_all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'name', 'created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];
    
        $coupon = Blog_Category::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })->orderBy($columnsForOrderBy[$orderByColumn], $orderDirectection);
    
        $total = $coupon->count();
        $item = $coupon->skip($request->start)->take($request->length)->get();
    
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $item,
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'category_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);
        
        // Create a new Category instance
        $category = new Blog_Category();
        $category->name = $request->category_name;
        $category->status = $request->status;
        $category->save();

        return response()->json(['success' => 'Category added Successfully']);
    }
    public function edit($id){
        $category = Blog_Category::find($id);

        return response()->json(['success'=>true,'data' => $category]); 
    }
    public function delete(Request $request){
        $category = Blog_Category::find($request->id);

        if (!$category) {
            return response()->json(['error' => 'Category not found']);
        }
        // Delete the category
        $category->delete();

        return response()->json(['success' => 'Category deleted successfully']); 
    }
    public function update(Request $request){
        $request->validate([
            'category_name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
        ]);
        
        // Create a new Category instance
        $category =Blog_Category::find($request->id);
        $category->name = $request->category_name;
        $category->status = $request->status;
        $category->update();

        return response()->json(['success' => 'Category Update Successfully']);
    }
    
}
