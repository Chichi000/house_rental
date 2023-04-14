<?php

namespace App\Http\Controllers;

use App\Models\Landlord;
use App\Models\User;
use App\Models\Property;
use App\Models\Verification;
use Illuminate\Http\Request;
use App\DataTables\LandlordsDataTable;
use View;
use Validator;
use Redirect;
use Storage;
use File;
use Auth;
use Hash;
use DB;

class LandlordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request){
        $validator = Validator::make($request->all(), Landlord::$rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($validator->passes()) {
            $path = Storage::putFileAs('images/landlord', $request->file('imagePath'),$request->file('imagePath')->getClientOriginalName());

            $request->merge(["imagePath"=>$request->file('imagePath')->getClientOriginalName()]);

            $user = new User([
                'name' => $request->input('first_name').' '. $request->last_name,
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
            $user->role = 'landlord';
            $user->save();

            if($file = $request->hasFile('imagePath')) {
                $advisor = new Landlord;
                $advisor->user_id = $user->id;
                $advisor->first_name = $request->first_name;
                $advisor->last_name = $request->last_name; 
                $advisor->address = $request->address;
                $advisor->phone = $request->phone; 
                
                $file = $request->file('imagePath') ;
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path().'/images' ;
                $advisor->imagePath = 'images/'.$fileName;            
                $advisor->save();
                $file->move($destinationPath,$fileName);

                // return Redirect::to('/profie')->with('success','New Customer has been Added!');
                // return redirect()->route('tenant.profile');
                return redirect()->back();
            } 

        }     
    }
    public function getLandlords(LandlordsDataTable $dataTable) {
        $landlords = Landlord::with('properties', 'users')->get();
        // $landlords = Landlord::with('properties', 'users')->orderBy('id','DESC');

        return $dataTable->render('landlord.index',compact('landlords'));
    }

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
     * @param  \App\Models\Landlord  $landlord
     * @return \Illuminate\Http\Response
     */
    public function show(Landlord $landlord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Landlord  $landlord
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Landlord  $landlord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        // dd($id);
        // $this->validate($request, ['old_password' => 'required']);

        // if (!Hash::check($request->old_password, Auth::user()->password)) {
        //     return redirect()->back()->with('warning', 'Please enter the correct old password to update.');
        // }
    
        // $landlord = Landlord::findOrFail($id);
        // $landlord->fill($request->only(['first_name', 'last_name', 'address', 'phone']));
    
        // if ($request->hasFile('imagePath')) {
        //     $file = $request->file('imagePath');
        //     $fileName = $file->getClientOriginalName();
        //     $destinationPath = public_path().'/images';
        //     $landlord->imagePath = 'images/'.$fileName;
        //     $file->move($destinationPath, $fileName);
        // }
    
        // $user = User::findOrFail($landlord->user_id);
        // $user->name = $request->first_name . ' ' . $request->last_name;
    
        // if ($request->filled(['new_password'])) {
        //     $this->validate($request, [
        //         'new_password' => 'required|min:8',
        //         'confirm_password' => 'required|same:new_password'
        //     ]);
    
        //     $user->password = bcrypt($request->input('confirm_password'));
        // }
    
        // if ($request->filled('email')) {
        //     $user->email = $request->email;
        // }
    
        // $landlord->save();
        // $user->save();
    
        // return redirect()->back()->with('success', 'Successfully updated your personal information!');

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'nullable|min:8|confirmed',
            'email' => 'nullable|email',
            'imagePath' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (Hash::check($request->old_password, Auth::user()->password)) {
            $landlord = Landlord::find($id);
            $landlord->first_name = $request->first_name;
            $landlord->last_name = $request->last_name;
            $landlord->address = $request->address;
            $landlord->phone = $request->phone;

            if($request->hasFile('imagePath')) {
                $file = $request->file('imagePath') ;
                $fileName = $file->getClientOriginalName();
                $destinationPath = public_path().'/images' ;
                $landlord->imagePath = 'images/'.$fileName;            
                $file->move($destinationPath,$fileName);
            } else {
                
            }   

            $user = User::find($landlord->user_id);
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

            //update
            $landlord->update();
            $user->update();

            return redirect()->back()->with('success','Successfully updated your personal information!');
        } else {
            return redirect()->back()->with('warning','Please enter the correct old password to update.');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Landlord  $landlord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $landlord = Landlord::findOrFail($id);
        $Landlord = Landlord::find($id);
        User::where('id',$Landlord->user_id)->forceDelete();
        Property::where('landlord_id',$Landlord->id);
        $Landlord->forceDelete();

        return Redirect::route('getLandlords')->with('danger','Landlord has been Deleted!');
    }

    public function deactivate($id){
        $Landlord = Landlord::find($id);
        Property::where('landlord_id',$Landlord->id)->delete();
        User::where('id',$Landlord->user_id)->delete();
        $Landlord->delete();
        
        return Redirect::route('getLandlords')->with('warning','Landlord has been Deactivated!');
    }

    public function restore($id) {
        $landlord = Landlord::withTrashed()->find($id);
        User::where('id',$landlord->user_id)->restore();
        Property::where('landlord_id',$landlord->id)->restore();
        $landlord->restore(); 
        return Redirect::route('getLandlords')->with('success','Landlord has been Restored!');
    }

    public function profile()
    {   
        $id = Auth::user()->landlords->id;
        $landlord = Landlord::with('properties')->find($id);
        $users = User::with('landlords')->where('id', $landlord->user_id)->get();
        // dd($users);

        $messages = DB::table('conversations')
        ->select('messages.*', 'tenants.first_name', 'tenants.last_name', 'tenants.imagePath')
        ->join('messages', 'messages.conversation_id', '=', 'conversations.id')
        // ->join('users', 'users.id', '=', 'conversations.user_1')
        ->join('users', 'users.id', '=', 'conversations.user_2')
        ->join('tenants', 'tenants.user_id', '=', 'conversations.user_1')
        // ->join('landlords', 'landlords.user_id', '=', 'users.id')
        ->where('users.id', '=', Auth::user()->id)
        ->groupBy('messages.conversation_id')
        ->orderBy('messages.message_send_at', 'DESC')
        ->get();
        // dd($messages);

        return view('landlord.profile', compact('landlord', 'users', 'messages'));
    }

    public function myProperties(){
        $id = Auth::user()->landlords->id;
        $landlord = Landlord::with('properties')->find($id);
        $users = User::with('tenants')->where('id', $landlord->user_id)->get();
        // dd($landlord);
        return view('property.show', compact('landlord', 'users'));
    }

    public function upgraded(Request $request, $id)
    {
       $upgrade = Landlord::withTrashed()->find($id);
       $upgrade->is_upgraded = 1;
       $upgrade->update();

       return Redirect::route('getLandlords')->with('success','Landlord has been Verified!');
    }


    //for verification account
    public function verification(Request $request){
        $request->validate([
            'contact_no' => 'required',
            'reference_number' => 'required',
        ]);

        $verification = new Verification;
        $verification->contact_no = $request->contact_no;
        $verification->reference_number = $request->reference_number;
        $verification->landlord_id = Auth::user()->landlords->id;
        $verification->save();

        return redirect()->back()->with('success', 'Verification sent, please wait for the admin to check the form.');
    }
}