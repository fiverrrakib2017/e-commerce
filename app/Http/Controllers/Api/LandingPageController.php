<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Landing_Page;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index(){
        $data=Landing_Page::latest()->get();
        return response()->json(['data'=>$data]);
    }
    public function view($id){
        $data=Landing_Page::find($id);
        if (!$data) {
            return response()->json(['error' => 'Data not found']);
        }
        return response()->json(['data'=>$data]);
    }
    public function viewForDev($id){
        $data=Landing_Page::find($id);
        if (!$data) {
            return response()->json(['error' => 'Data not found']);
        }
        return response()->json(['data'=>$data]);
    }
    public function DevSave(Request $request,$id){
        $data=Landing_Page::find($id);
        if (!$data) {
            return response()->json(['error' => 'Data not found']);
        }
        $data->content = $request->html;
        $data->css = $request->css;
        $data->project_data = $request->projectData;
        $data->save();
        Log::info($request->projectData);
        return response()->json($data);
    }
}
