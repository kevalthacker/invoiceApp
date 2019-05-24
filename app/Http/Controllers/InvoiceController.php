<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Invoice;
use App\InvoiceItems;
use Auth;
use JWTAuth;
use App\User;

class InvoiceController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id = null)
    {
        //return AddressController::all();
	   return Invoice::where('user_id', Auth::id())->get();
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
       
	   $this->validate($request, [
            'invoice_no' => 'required|alpha_dash|unique:invoices',
            'creater_detail' => 'required',
            'invoice_date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d',
            'discount' => 'required|numeric|min:0',
            'products.*.item_name' => 'required|max:255',
            'products.*.price' => 'required|numeric|min:1',
            'products.*.qty' => 'required|integer|min:1'
        ]);

        $items = collect($request->items)->transform(function($item) {
            $item['total'] = $item['qty'] * $item['price'];
            return new InvoiceItems($item);
        });

        if($items->isEmpty()) {
            return response()
            ->json([
                'products_empty' => ['One or more Items is required.']
            ], 422);
        }
		
        $data = $request->except('items');
		$data['user_id']=  Auth::id();	
        $data['sub_total'] = $items->sum('total');
        $data['grand_total'] = $data['sub_total'] - $data['discount'];
        $invoice = Invoice::create($data);
        $invoice->items()->saveMany($items);
        return response()
            ->json([
                'created' => true
         ]);  
		
    }
	
	public function show($id)
    {
        $invoice = Invoice::with('items')->findOrFail($id);
        return $invoice;
    }
	
	public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);
	   $this->validate($request, [
            'invoice_no' => 'required|alpha_dash|unique:invoices,invoice_no,'.$id.',id',
            'creater_detail' => 'required',
            'invoice_date' => 'required|date_format:Y-m-d',
            'due_date' => 'required|date_format:Y-m-d',
            'discount' => 'required|numeric|min:0',
            'items.*.item_name' => 'required|max:255',
            'items.*.price' => 'required|numeric|min:1',
            'items.*.qty' => 'required|integer|min:1'
        ]);

        $items = collect($request->items)->transform(function($item) {
            $item['total'] = $item['qty'] * $item['price'];
            return new InvoiceItems($item);
        });

        if($items->isEmpty()) {
            return response()
            ->json([
                'products_empty' => ['One or more Items is required.']
            ], 422);
        }
		
        $data = $request->except('items');
        $data['sub_total'] = $items->sum('total');
        $data['grand_total'] = $data['sub_total'] - $data['discount'];
        $invoice->update($data);
        InvoiceItems::where('invoice_id', $invoice->id)->delete();
        $invoice->items()->saveMany($items);
        return response()
            ->json([
                'updated' => true
		    ]);
    }
	
    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
		InvoiceItems::where('invoice_id', $invoice->id)->delete();
        $invoice->delete();
        return '';
    }	

}
