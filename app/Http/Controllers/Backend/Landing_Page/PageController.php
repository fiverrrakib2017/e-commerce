<?php

namespace App\Http\Controllers\Backend\Landing_Page;

use App\Http\Controllers\Controller;
use App\Models\Landing_Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        return view('Backend.Pages.Builder.Show');
    }
    public function get_all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'page_name','page_slug', 'created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];
    
        $object = Landing_Page::when($search, function ($query) use ($search) {
            $query->where('page_name', 'like', "%$search%");
            $query->where('page_slug', 'like', "%$search%");
        })->orderBy($columnsForOrderBy[$orderByColumn], $orderDirectection);
    
        $total = $object->count();
        $data = $object->skip($request->start)->take($request->length)->get();
    
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data,
        ]);
    }
    public function create(){
        return view('Backend.Pages.Builder.Create');
    }
    public function save_page(Request $request){
        $request->validate([
            'content'=>'required|string',
            'page_name'=>'required|string',
            'page_slug'=>'required|string',
            'css' => 'required|string',
        ]);
        $page=new Landing_Page();
        $page->page_name=$request->page_name; 
        $page->page_slug=$request->page_slug; 
        $page->content=$request->content; 
        $page->css=$request->css; 
        $page->save();
        return redirect()->route('admin.landing_page.index')->with('success', 'Page Create Success');

    }
    public function edit($id){
        $data = Landing_Page::findOrFail($id);
        return view('Backend.Pages.Builder.Update',compact('data'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'content' => 'required|string',
            'page_name' => 'required|string',
            'page_slug' => 'required|string',
            'css' => 'required|string',
        ]);
        $page = Landing_Page::findOrFail($id);
        $page->page_name = $request->page_name; 
        $page->content = $request->content; 
        $page->css = $request->css; 
        $page->update();
        return redirect()->route('admin.landing_page.index')->with('success', 'Page updated successfully');
    }
    public function delete(Request $request){
        $object=Landing_Page::find($request->id);
        if (!$object) {
            return response()->json(['error' => 'Data not found']);
        }
         /* Delete the Data*/
         $object->delete();

         return response()->json(['success' => 'Deleted Successfully']); 
    }
    public function view($id){
        $data=Landing_Page::find($id);
        return view('Backend.Pages.Builder.View',compact('data')); 
    }
    
}
