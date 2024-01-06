<?php

namespace App\Http\Controllers\Backend\Shop;

use App\Helpers\ImageUpload;
use App\Http\Controllers\Controller;
use App\Models\Pickup_point;
use App\Models\Seller;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function index()
    {
        $data = Shop::with('seller')->latest()->get();
        return view('Backend.Pages.Shop.index', compact('data'));
    }
    public function create()
    {
        $seller = Seller::latest()->get();
        $pickup_point = Pickup_point::latest()->get();
        return view('Backend.Pages.Shop.Create', compact('seller', 'pickup_point'));
    }
    public function store(Request $request)
    {
        // Validate the form data
        $ruls = [
            'fullname' => 'required|string|max:255',
            'seller_id' => 'required',
            'logo' => 'required',
            'slider' => 'required',
            'top_banner' => 'required',
            'pickup_point_id' => 'required',
            'shipping_cost' => 'required',
        ];
        $validator = Validator::make($request->all(), $ruls);
        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->all())->withInput();
        }

        $object = new Shop();
        $object->name = $request->fullname;
        $object->seller_id = $request->seller_id;

        ImageUpload::handleFileUpload($request, 'logo', $object, 'logo');
        ImageUpload::handleFileUpload($request, 'slider', $object, 'slider');
        ImageUpload::handleFileUpload($request, 'top_banner', $object, 'top_banner');
        ImageUpload::handleFileUpload($request, 'banner_full_width', $object, 'banner_full_width_1');
        ImageUpload::handleFileUpload($request, 'banner_full_width2', $object, 'banner_full_width_2');
        ImageUpload::handleFileUpload($request, 'banner_half_width', $object, 'banner_half_width');

        $object->product_upload_limit = $request->product_upload_limit;
        $object->verification_status = $request->verification_status;
        $object->verification_info = $request->verification_info;
        $object->cash_on_delivery_status = $request->cash_on_delivery_status;

        $object->admin_to_pay = $request->admin_to_pay;
        $object->facebook = $request->facebook;
        $object->instagram = $request->instagram;
        $object->google = $request->google;
        $object->twitter = $request->twitter;
        $object->youtube = $request->youtube;
        $object->slug = $request->slug;
        $object->meta_title = $request->meta_title;
        $object->meta_description = $request->meta_description;

        $object->pickup_point_id = $request->pickup_point_id;
        $object->shipping_cost = $request->shipping_cost;
        $object->delivery_pickup_latitude = $request->delivery_pickup_latitude;
        $object->delivery_pickup_longitude = $request->delivery_pickup_longitude;

        $object->save();
        return redirect()->route('admin.shop.index')->with('success', 'Shop Add Successfully');
    }
    public function delete(Request $request)
    {
        $object = Shop::find($request->id);
        $object->delete();
        return response()->json(['success' => 'Delete Successful']);
    }
    public function edit($id)
    {
        $shop = Shop::find($id);
        $seller = Seller::latest()->get();
        $pickup_point = Pickup_point::latest()->get();
        return view('Backend.Pages.Shop.Update', compact('seller', 'pickup_point', 'shop'));
    }
    public function update(Request $request)
    {
        // Validate the form data
        $rules = [
            'fullname' => 'required|string|max:255',
            'seller_id' => 'required',
            'logo' => 'nullable',
            'slider' => 'nullable',
            'top_banner' => 'nullable',
            'pickup_point_id' => 'required',
            'shipping_cost' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->with('errors', $validator->errors()->all())->withInput();
        }

        $object = Shop::findOrFail($request->id);
        $object->name = $request->fullname;
        $object->seller_id = $request->seller_id;

        // Handle file uploads (if provided)
        if ($request->hasFile('logo')) {
            ImageUpload::handleFileUpload($request, 'logo', $object, 'logo');
        }

        if ($request->hasFile('slider')) {
            ImageUpload::handleFileUpload($request, 'slider', $object, 'slider');
        }

        if ($request->hasFile('top_banner')) {
            ImageUpload::handleFileUpload($request, 'top_banner', $object, 'top_banner');
        }

        if ($request->hasFile('banner_full_width_1')) {
            ImageUpload::handleFileUpload($request, 'banner_full_width_1', $object, 'banner_full_width_1');
        }

        if ($request->hasFile('banner_full_width_2')) {
            ImageUpload::handleFileUpload($request, 'banner_full_width_2', $object, 'banner_full_width_2');
        }

        if ($request->hasFile('banner_half_width')) {
            ImageUpload::handleFileUpload($request, 'banner_half_width', $object, 'banner_half_width');
        }

        $object->product_upload_limit = $request->product_upload_limit;
        $object->verification_status = $request->verification_status;
        $object->verification_info = $request->verification_info;
        $object->cash_on_delivery_status = $request->cash_on_delivery_status;

        $object->admin_to_pay = $request->admin_to_pay;
        $object->facebook = $request->facebook;
        $object->instagram = $request->instagram;
        $object->google = $request->google;
        $object->twitter = $request->twitter;
        $object->youtube = $request->youtube;
        $object->slug = $request->slug;
        $object->meta_title = $request->meta_title;
        $object->meta_description = $request->meta_description;

        $object->pickup_point_id = $request->pickup_point_id;
        $object->shipping_cost = $request->shipping_cost;
        $object->delivery_pickup_latitude = $request->delivery_pickup_latitude;
        $object->delivery_pickup_longitude = $request->delivery_pickup_longitude;

        $object->save();

        return redirect()->route('admin.shop.index')->with('success', 'Shop updated successfully');
    }

}
