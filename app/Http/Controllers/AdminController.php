<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Landlord;
use App\Models\Verification;
use Illuminate\Http\Request;
use DB;
use Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }

    public function indexVerification(){
        $verifications =  DB::table('verifications')
        ->select('verifications.*', 'landlords.first_name', 'landlords.last_name', 'landlords.id as landlord_id', 'landlords.imagePath', 'users.email')
        ->join('landlords', 'landlords.id', '=', 'verifications.landlord_id')
        // ->join('admins','admins.id','=','verifications.admin_id')
        ->join('users','users.id','=','landlords.user_id')
        ->orderBy('id')
        // ->get();
        ->paginate(5);

        // dd($verifications);
        return view('admin.verification', compact('verifications'));
    }

    public function editStatus(Request $request, $id){

        $verifications = Verification::findOrFail($id);
        $landlord = Landlord::find($verifications->landlord_id);
        
        if($request->status == 'Accepted'){
            $verifications->admin_id = Auth::user()->admins->id;
            $verifications->status = $request->status; 
            $landlord->is_upgraded = 1; 
            $verifications->update();
            $landlord->update();
        } 
        elseif($request->status == 'Denied'){
            $verifications->admin_id = Auth::user()->admins->id;
            $verifications->status = $request->status;
            $verifications->update();
        }

        return redirect()->back()->with('success', 'Status updated successfully');
    }
}
