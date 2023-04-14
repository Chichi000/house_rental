<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;

class PDFController extends Controller
{
    public function generatePDF(Request $request,$id)
    {
        $orders = DB::table('orderinfo')
        ->select('orderinfo.*','orderinfo.total_days as TotalDays','orderinfo.start_date as CheckIn','orderinfo.end_date as CheckOut','orderinfo.total_amount as Total','orderinfo.status as Status', 'properties.rent as Rent','properties.id as property_id', 'properties.description as Description','properties.imagePath as property_image', 'properties.address as Address','properties.area as Area', 'properties.city as City', 'properties.state as State', 'tenants.last_name as lname', 'tenants.first_name as fname', 'users.email as EmailAddress' , 'tenants.imagePath')
        ->join('orderline', 'orderline.orderinfo_id', '=', 'orderinfo.id')
        ->join('tenants','tenants.id','=','orderinfo.tenant_id')
        ->join('properties','properties.id','=','orderline.property_id')
        ->join('users', 'users.id', '=' ,'tenants.user_id')
        ->where('orderinfo.id', '=', $id)
        ->first();
        $pdf = PDF::loadView('mailer.receipt',compact('orders') );
        return $pdf->stream('receipt.pdf');

    }
}