<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\User;
use App\DataTables\TenantsDataTable;
use View;
use Validator;
use Redirect;
use Storage;
use File;
use Auth;
use Hash;
class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function register(Request $request){
        $validator = Validator::make($request->all(), Tenant::$rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($validator->passes()) {
            $path = Storage::putFileAs('images/tenant', $request->file('imagePath'),$request->file('imagePath')->getClientOriginalName());

            $request->merge(["imagePath"=>$request->file('imagePath')->getClientOriginalName()]);

            $user = new User([
                'name' => $request->input('first_name').' '. $request->last_name,
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
            $user->role = 'tenant';
            $user->save();

            if($file = $request->hasFile('imagePath')) {
                $tenant = new Tenant;
                $tenant->user_id = $user->id;
                $tenant->first_name = $request->first_name;
                $tenant->last_name = $request->last_name; 
                $tenant->address = $request->address;
                $tenant->phone = $request->phone; 
                
                $file = $request->file('imagePath') ;
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path().'/images' ;
                $tenant->imagePath = 'images/'.$fileName;            
                $tenant->save();
                $file->move($destinationPath,$fileName);


                // return Redirect::to('/profie')->with('success','New Customer has been Added!');
                // return redirect()->route('tenant.profile');
                return redirect()->back()->with('success','New Tenant has been registered successfully!');
            } 

        }     
    }

    public function index()
    {
        return View::make('tenant.index');
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
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $tenant = Tenant::find($id);
        // $users = User::with('tenants')->where('id', $tenant->user_id)->get();
        // // dd($users);
        // return view('tenant.edit', compact('tenant', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            'old_password' => 'required',
        ]);

        if (Hash::check($request->old_password, Auth::user()->password)) {
            $tenant = Tenant::find($id);
            $tenant->first_name = $request->first_name;
            $tenant->last_name = $request->last_name;
            $tenant->address = $request->address;
            $tenant->phone = $request->phone;

            if($request->hasFile('imagePath')) {
                $file = $request->file('imagePath') ;
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path().'/images' ;
                $tenant->imagePath = 'images/'.$fileName;            
                $file->move($destinationPath,$fileName);
            } else {
                
            }   

            $user = User::find($tenant->user_id);
            $user->name = $request->first_name . ' ' . $request->last_name;

            //password
            if($request->filled(['new_password'])){
                $this->validate($request, [
                    'new_password' => 'required|min:8',
                    'confirm_password' => 'required|same:new_password'
                ]);
                $user->password = bcrypt($request->input('confirm_password'));
            } 

            //email
            if($request->filled('email')){
                $user->email = $request->email;
            }

            $tenant->update();
            $user->update();

            // if($request->filled(['password', 'email'])){
            //     $user->email = $request->email;
            //     $user->password = bcrypt($request->input('password'));
            //     $user->update();
            // } elseif($request->filled('email')){
            //     $user->email = $request->email;
            //     $user->update();
            // } elseif($request->filled('password')){
            //     $user->password = bcrypt($request->input('password'));
            //     $user->update();
            // } else{
            //     $user->update();  
            // }

            // $request->whenFilled('name', function (string $input) {
            //     // ...
            // });

            
            return redirect()->back()->with('success','Successfully updated your personal information!');
        } else {
            return redirect()->back()->with('warning','Please enter the correct old password to update.');
        }
    }
    
    public function getTenants(TenantsDataTable $dataTable) {
        // $tenants =  Tenant::with(['users'])->get();

        return $dataTable->render('tenant.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($id);
        User::where('id',$tenant->user_id)->forceDelete();
        $tenant->forceDelete();

        return Redirect::route('getTenants')->with('danger','Tenant has been Deleted!');
    }

    public function deactivate($id){
        $tenant = Tenant::findOrFail($id);
        User::where('id',$tenant->user_id)->delete();
        $tenant->delete();
        // dd($customer);
        
        return Redirect::route('getTenants')->with('warning','Tenant has been Deactivated!');
    }

    public function restore($id) {
        $tenant = Tenant::withTrashed()->find($id);
        User::where('id',$tenant->user_id)->restore();
        $tenant->restore(); 

        return Redirect::route('getTenants')->with('success','Customer has been Restored!');
    }

    public function profile()
    {   
        $id = Auth::user()->tenants->id;
        $tenant = Tenant::find($id);
        $users = User::with('tenants')->where('id', $tenant->user_id)->get();
        // dd($tenant);
        return view('tenant.profile', compact('tenant', 'users'));
        // return View::make('tenant.profile');
    }

}
