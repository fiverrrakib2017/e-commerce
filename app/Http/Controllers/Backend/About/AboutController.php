<?php

namespace App\Http\Controllers\Backend\About;

use App\Helpers\ImageUpload;
use App\Http\Controllers\Controller;
use App\Models\About_Section;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        return view('Backend.Pages.About.About');
    }
    public function get_all_data(Request $request){
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'title','description','photo','status', 'created_at'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];
    
        $object = About_Section::when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%$search%");
            $query->where('description', 'like', "%$search%");
        })->orderBy($columnsForOrderBy[$orderByColumn], $orderDirectection);
    
        $total = $object->count();
        $item = $object->skip($request->start)->take($request->length)->get();
    
        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $item,
        ]);
    }
    public function store(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
        ]);
       
        // Create a new country instance
        $object = new About_Section();
        $object->title = $request->title;
        $object->description = $request->description;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $originalName = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $uniqueFilename = md5(uniqid() . $originalName) . '.' . $extension;
            
            // Move the file to the destination
            $image->move(public_path('Backend/images/about'), $uniqueFilename);

            // Save the unique filename to the object
            $object->photo = url('Backend/images/about/' .$uniqueFilename);
        }else{
            $object->photo=' ';
        }
       
        $object->status = $request->status;
        $object->save();

        return response()->json(['success' => 'Added Successfully']);
    }
    public function edit($id){
        $data = About_Section::find($id);
        if (!$data) {
            return response()->json(['error' => 'not found']);
        }
        return response()->json(['success'=>true,'data' => $data]); 
    }
    public function update(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
        ]);
        $object= About_Section::find($request->id);
        $object->title = $request->title;
        $object->description = $request->description;
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $originalName = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $uniqueFilename = md5(uniqid() . $originalName) . '.' . $extension;
            
            // Move the file to the destination
            $image->move(public_path('Backend/images/about'), $uniqueFilename);

            // Save the unique filename to the object
            $object->photo = url('Backend/images/about/' .$uniqueFilename);
        }
        $object->status = $request->status;
        $object->update();

        return response()->json(['success' => 'Update Successfully']);
    }
    public function delete(Request $request){
        $object = About_Section::find($request->id);

        if (!$object) {
            return response()->json(['error' => 'Not found']);
        }
        // Delete the data
        $object->delete();

        return response()->json(['success' => 'Deleted successfully']); 
    }
}
