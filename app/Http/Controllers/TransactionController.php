<?php

namespace App\Http\Controllers;

use App\Mail\ExampleMail;
use App\Models\Order;
use App\Models\Property;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Mail;
use Redirect;
use View;

class TransactionController extends Controller
{

    //show the page of transaction process
    public function show($id)
    {
        $property = Property::with('landlords')->where('id', $id)->get();

        return view('property.transaction', compact('property'));
    }

    //tenant request to landlord to rent the property
    public function requestProperty(Request $request)
    {
        if (Auth::check()) {
            $id = $request->property_id;
            $property = Property::findOrFail($id);
            try {
                DB::beginTransaction();
                $order = new Order();
                $order->tenant_id = Auth::user()->tenants->id;
                $order->total_days = $request->total_days;
                $order->payment_method = $request->paymentRadio;
                $order->total_amount = $order->total_days * $property->rent;
                $order->save();

                $order->properties()->attach($property->id);
            } catch (\Exception$e) {
                dd($e);
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }

            DB::commit();
            return redirect()->back()->with('success', 'Request has been sent to Landlord!');
        } else {
            return redirect()->back()->with('warning', 'Please login first!');
        }
    }

    //get the index of transaction
    public function getTransaction()
    {

        $AuthId = Auth::user()->landlords->id;
        $orderinfo = DB::table('orderinfo')
            ->select('orderinfo.*', 'properties.id as property_id', 'properties.imagePath as property_image', 'properties.address', 'properties.city', 'properties.state', 'tenants.last_name', 'tenants.first_name', 'users.email', 'tenants.imagePath')
            ->join('orderline', 'orderline.orderinfo_id', '=', 'orderinfo.id')
            ->join('tenants', 'tenants.id', '=', 'orderinfo.tenant_id')
            ->join('properties', 'properties.id', '=', 'orderline.property_id')
            ->join('users', 'users.id', '=', 'tenants.user_id')
            ->join('landlords', 'landlords.id', '=', 'properties.landlord_id')
            ->where('landlords.id', '=', $AuthId)
            ->orderBy('id')
            ->paginate(10);

        return view('transaction.index', compact('orderinfo'));
    }

    //edit the status of orderinfo that requested by tenant
    //landlord will accept or canceled the request
    public function editStatus(Request $request, $id)
    {

        // $orders = DB::table('orderinfo')
        // ->select('orderinfo.*','orderinfo.status as Status', 'properties.id as property_id', 'properties.imagePath as property_image', 'properties.address as Address', 'properties.city as City', 'properties.state', 'tenants.last_name as lname', 'tenants.first_name as fname', 'users.email as EmailAddress' , 'tenants.imagePath')
        // ->join('orderline', 'orderline.orderinfo_id', '=', 'orderinfo.id')
        // ->join('tenants','tenants.id','=','orderinfo.tenant_id')
        // ->join('properties','properties.id','=','orderline.property_id')
        // ->join('users', 'users.id', '=' ,'tenants.user_id')
        // ->where('orderinfo.id', '=', $id)
        // ->get();

        // Mail::to($data[0]->email_add)->send(new EmailNotification($data, $employee ));

        $orderinfo = Order::findOrFail($id);

        //if landlord accept the request
        if ($request->status == 'Accepted') {
            // $orders->EmailAddress= $request->EmailAddress;
            $orderinfo->start_date = Carbon::now();
            $orderinfo->end_date = Carbon::now()->addDays($orderinfo->total_days);
            $orderinfo->status = $request->status;
            $orderinfo->update();
            $orders = DB::table('orderinfo')
                ->select('orderinfo.*', 'orderinfo.total_days as TotalDays', 'orderinfo.start_date as CheckIn', 'orderinfo.end_date as CheckOut', 'orderinfo.total_amount as Total', 'orderinfo.status as Status', 'properties.rent as Rent', 'properties.id as property_id', 'properties.imagePath as property_image', 'properties.address as Address', 'properties.area as Area', 'properties.city as City', 'properties.state as State', 'tenants.last_name as lname', 'tenants.first_name as fname', 'users.email as EmailAddress', 'tenants.imagePath')
                ->join('orderline', 'orderline.orderinfo_id', '=', 'orderinfo.id')
                ->join('tenants', 'tenants.id', '=', 'orderinfo.tenant_id')
                ->join('properties', 'properties.id', '=', 'orderline.property_id')
                ->join('users', 'users.id', '=', 'tenants.user_id')
                ->where('orderinfo.id', '=', $id)
                ->get();
                
            Mail::to($orders[0]->EmailAddress)->send(new ExampleMail($orders));
        }
        //if landlord canceled the request
        elseif ($request->status == 'Canceled') {
            $orderinfo->status = $request->status;
            $orderinfo->update();
            $orders = DB::table('orderinfo')
                ->select('orderinfo.*', 'orderinfo.status as Status', 'properties.id as property_id', 'properties.imagePath as property_image', 'properties.address as Address', 'properties.city as City', 'properties.state', 'tenants.last_name as lname', 'tenants.first_name as fname', 'users.email as EmailAddress', 'tenants.imagePath')
                ->join('orderline', 'orderline.orderinfo_id', '=', 'orderinfo.id')
                ->join('tenants', 'tenants.id', '=', 'orderinfo.tenant_id')
                ->join('properties', 'properties.id', '=', 'orderline.property_id')
                ->join('users', 'users.id', '=', 'tenants.user_id')
                ->where('orderinfo.id', '=', $id)
                ->get();
            Mail::to($orders[0]->EmailAddress)->send(new ExampleMail($orders));
        }

        return redirect()->back()->with('success', 'Transaction receipt sent to tenant email!');
    }
}
