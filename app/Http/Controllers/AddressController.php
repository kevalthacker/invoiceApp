<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use Auth;
use JWTAuth;
use App\User;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id = null)
    {
        //return AddressController::all();
	   return Address::where('user_id', Auth::id())->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
     
        $address = Address::create([
                'user_id' => Auth::id(),
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'company_website' => $request->company_website,
                'company_city' => $request->company_city,
                'company_state' => $request->company_state,																
                'company_postcode' => $request->company_postcode,
                'company_country' => $request->company_country				
            ]);

         return $address;
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return Address::findOrFail($id);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$address = Address::findOrFail($id);
		return Address::where('id', $id)->update([
                'user_id' => Auth::id(),
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'company_website' => $request->company_website,
                'company_city' => $request->company_city,
                'company_state' => $request->company_state,																
                'company_postcode' => $request->company_postcode,
                'company_country' => $request->company_country				
            ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return '';
    }
}