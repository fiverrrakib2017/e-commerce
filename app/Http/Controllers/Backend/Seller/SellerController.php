<?php

namespace App\Http\Controllers\Backend\Seller;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use App\Models\Seller_withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SellerController extends Controller
{
    public function create()
    {
        return view('Backend.Pages.Seller.Create');
    }
    public function get_all_data(Request $request)
    {
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'fullname', 'email_address', 'profile_image', 'phone_number', 'emergency_contract', 'city', 'state'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirectection = $request->order[0]['dir'];

        $coupon = Seller::when($search, function ($query) use ($search) {
            $query->where('fullname', 'like', "%$search%");
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
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
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

        // Handle file upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('Backend/images/seller'), $imageName);
        } else {
            $imageName = null;
        }

        // Create a new seller
        $object = new Seller();
        $object->fullname = $request->fullname;
        $object->profile_image = $imageName;
        $object->email_address = $request->email_address;
        $object->phone_number = $request->phone_number;
        $object->emergency_contract = $request->e_contract;
        $object->city = $request->city;
        $object->state = $request->state;
        $object->address = $request->address;
        $object->dob = $request->date_of_birth;
        $object->gender = $request->gender;
        $object->marital_status = $request->marital_status;
        $object->verification_status = $request->verification_status;
        $object->verification_info = $request->verification_info;
        $object->opening_balance = $request->opening_balance;
        $object->bank_name = $request->bank_name;
        $object->bank_acc_name = $request->bank_account_name;
        $object->bank_acc_no = $request->bank_acc_no;
        $object->bank_routing_no = $request->bank_routing_no;
        $object->bank_payment_status = $request->bank_payment_status;
        // Save to the database table
        $object->save();

        // Redirect to the index page or show success message
        return redirect()->route('admin.seller.index')->with('success', 'Seller added successfully');
    }

    public function index()
    {
        return view('Backend.Pages.Seller.index');
    }
    public function delete(Request $request)
    {
        $object = Seller::find($request->id);

        if (empty($object)) {
            return response()->json(['error' => 'Seller not found.'], 404);
        }

        /* Seller Image Find And Delete it From Local Machine */
        if (!empty($object->profile_image)) {
            $imagePath = public_path('Backend/images/seller/' . $object->profile_image);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        /* Seller Delete it From Database Table */
        $object->delete();

        return response()->json(['success' => 'Seller deleted successfully.']);
    }
    public function edit($id)
    {
        $data = Seller::find($id);
        return view('Backend.Pages.Seller.Update', compact('data'));
    }
    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
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

        // Find the seller

        $object = Seller::findOrFail($id);

        $object->fullname = $request->fullname;

        // Handle profile image update
        if ($request->hasFile('profile_image')) {

            // Delete previous image
            if (!empty($object->profile_image)) {
                $imagePath = public_path('Backend/images/seller/' . $object->profile_image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $imageName = time() . '.' . $request->file('profile_image')->getClientOriginalExtension();
            $request->file('profile_image')->move(public_path('Backend/images/seller/'), $imageName);

            $object->profile_image = $imageName;
        }

        $object->email_address = $request->email_address;
        $object->phone_number = $request->phone_number;
        $object->emergency_contract = $request->e_contract;
        $object->city = $request->city;
        $object->state = $request->state;
        $object->address = $request->address;
        $object->dob = $request->date_of_birth;
        $object->gender = $request->gender;
        $object->marital_status = $request->marital_status;
        $object->verification_status = $request->verification_status;
        $object->verification_info = $request->verification_info;
        $object->opening_balance = $request->opening_balance;
        $object->bank_name = $request->bank_name;
        $object->bank_acc_name = $request->bank_account_name;
        $object->bank_acc_no = $request->bank_acc_no;
        $object->bank_routing_no = $request->bank_routing_no;
        $object->bank_payment_status = $request->bank_payment_status;
        // Save to the database table
        $object->update();

        // Redirect back or to a specific route
        return redirect()->route('admin.seller.index')->with('success', 'Seller updated successfully.');
    }
    public function seller_withdraw_index()
    {
        $seller=Seller::latest()->get();
        return view('Backend.Pages.Seller.Withdraw.index',compact('seller'));
    }

    public function get_all_withdraw_data(Request $request)
    {
        $search = $request->search['value'];
        $columnsForOrderBy = ['id', 'seller_id', 'amount', 'withdraw_date', 'status'];
        $orderByColumn = $request->order[0]['column'];
        $orderDirection = $request->order[0]['dir'];

        $coupon = Seller_withdraw::with('seller:id,fullname,phone_number')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subquery) use ($search) {
                    // Search based on the seller's fullname in the Seller table
                    $subquery->whereHas('seller', function ($subquery) use ($search) {
                        $subquery->where('fullname', 'like', "%$search%");
                    });

                    // Or search based on the seller's phone number in the Seller table
                    $subquery->orWhereHas('seller', function ($subquery) use ($search) {
                        $subquery->where('phone_number', 'like', "%$search%");
                    });

                    // Or search based on the amount in the Seller_withdraw table
                    $subquery->orWhere('amount', 'like', "%$search%");
                });
            })
            ->orderBy($columnsForOrderBy[$orderByColumn], $orderDirection);

        $total = $coupon->count();
        $item = $coupon->skip($request->start)->take($request->length)->get();

        $data = [];

        foreach ($item as $item) {
            $data[] = [
                'id' => $item->id,
                'seller_name' => $item->seller ? $item->seller->fullname . ' (' . $item->seller->phone_number . ')' : 'N/A',
                'amount' => $item->amount,
                'withdraw_date' => $item->withdraw_date,
                'status' => $item->status,
                'created_at' => $item->created_at,
            ];
        }

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data,
        ]);
    }

    public function get_all_withdraw_seller_name($id)
    {
        $seller = Seller::find($id);
        // Return the seller name as JSON response
        return response()->json($seller->fullname);
    }
    public function seller_withdraw_edit($id){
       $data= Seller_withdraw::with('seller')->find($id);
       $seller=Seller::latest()->get();
       //return response()->json(['success'=>true, 'data'=>$data]);
       return view('Backend.Pages.Seller.Withdraw.Update', compact('data','seller'));
    }
    public function seller_withdraw_update(Request $request){
       
        // Validate the form data
        $request->validate([
            'seller_id' => 'required',
            'amount' => 'required',
            'withdraw_date' => 'required',
            'status' => 'required',
        ]);
        $object = Seller_withdraw::findOrFail($request->id);
        $object->seller_id=$request->seller_id;
        $object->amount=$request->amount;
        $object->withdraw_date=$request->withdraw_date;
        $object->status=$request->status;
        $object->update();
        return redirect()->route('admin.seller.withdraw.index')->with(['success'=>'Update successfully']);
    }
    public function seller_withdraw_add(Request $request){
        // Validate the form data
        $request->validate([
            'seller_id' => 'required',
            'amount' => 'required',
            'withdraw_date' => 'required',
            'status' => 'required',
        ]);
        $object =new Seller_withdraw();
        $object->seller_id=$request->seller_id;
        $object->amount=$request->amount;
        $object->withdraw_date=$request->withdraw_date;
        $object->status=$request->status;
        $object->save();
        return response()->json(['success'=>'Added Successful']);
    }
    public function seller_withdraw_delete(Request $request){
        $object=Seller_withdraw::find($request->id);
        $object->delete();
        return response()->json(['success'=>'Delete Successful']);
    }

}
