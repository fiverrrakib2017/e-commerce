<?php

namespace App\Http\Controllers\Backend\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
class SellerController extends Controller
{
    public function create(){
        return view('Backend.Pages.Seller.Create');
    }
    public function get_all_data(Request $request){
        $search=$request->search['value'];
        $columnsForOrderBy=['id','fullname','email_address','profile_image','phone_number','emergency_contract','city','state'];
        $orderByColumn=$request->order[0]['column'];
        $orderDirectection=$request->order[0]['dir'];

        $coupon=Seller::when($search,function($query)use($search){
            $query->where('fullname','like',"%$search%");
        })->orderBy($columnsForOrderBy[$orderByColumn],$orderDirectection);
        $total=$coupon->count();
        $item=$coupon->skip($request->start)->take($request->length)->get();
        return response()->json([
    		'draw'=>$request->draw,
    		'recordsTotal'=>$total,
    		'recordsFiltered'=>$total,
    		'data' => $item
    	]);
    }
    public function store(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'fullname' => 'required|string',
        'email_address' => 'required|email',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        'phone_number' => 'nullable|string',
        'e_contract' => 'nullable|string',
        'city' => 'nullable|string',
        'state' => 'nullable|string',
        'address' => 'nullable|string',
        'date_of_birth' => 'nullable|date',
        'gender' => 'nullable|in:1,0', 
        'marital_status' => 'nullable|in:1,2,3', 
        'verification_status' => 'nullable|in:1,2', 
        'verification_info' => 'nullable|string',
        'opening_balance' => 'nullable|numeric',
        'bank_name' => 'nullable|string',
        'bank_account_name' => 'nullable|string',
        'bank_acc_no' => 'nullable|string',
        'bank_routing_no' => 'nullable|numeric',
        'bank_payment_status' => 'nullable|in:1,2', 
    ]);

    // Handle profile image upload
    if ($request->hasFile('profile_image')) {
        $imagePath = $request->file('profile_image')->store('profile_images', 'public');
        $validatedData['profile_image'] = $imagePath;
    }
    // Handle file upload
    if ($request->hasFile('profile_image')) {
        $image = $request->file('profile_image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('Backend/images/seller'), $imageName);
    }else{
        $imageName =NULL;
    }

    // Create a new seller
    $object = new Seller();
    $object->fullname=$request->fullname;
    $object->profile_image=$imageName;
    $object->email_address=$request->email_address;
    $object->phone_number=$request->phone_number;
    $object->emergency_contract=$request->e_contract;
    $object->city=$request->city;
    $object->state=$request->state;
    $object->address=$request->address;
    $object->dob=$request->date_of_birth;
    $object->gender=$request->gender;
    $object->marital_status=$request->marital_status;
    $object->verification_status=$request->verification_status;
    $object->verification_info=$request->verification_info;
    $object->opening_balance=$request->opening_balance;
    $object->bank_name=$request->bank_name;
    $object->bank_acc_name=$request->bank_account_name;
    $object->bank_acc_no=$request->bank_acc_no;
    $object->bank_routing_no=$request->bank_routing_no;
    $object->bank_payment_status=$request->bank_payment_status;
    // Save to the database table 
    $object->save();

    // Redirect to the index page or show success message
    return redirect()->route('admin.seller.index')->with('success', 'Seller added successfully');
}

    public function index(){
        return view('Backend.Pages.Seller.index');
    }
}
