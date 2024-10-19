<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class PromoCodeController extends Controller
{
    public function edit()
    {

        $promoCodes = \App\PromoCode::all();

        return view('editpromocode',[
            'promoCodes'=>$promoCodes,
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'percentage' => 'nullable|numeric|min:1|max:100',
            'amount' => 'nullable|numeric|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date', // Ensure end date is after or equal to start date
        ]);
        $promocode = new  \App\PromoCode;

        $promocode->code = $request['name'];
        $promocode->type = $request['type'];
        if ($promocode->type == 'percentage') {
            $promocode->amount = $request['percentage'];
        } else {
            $promocode->amount = $request['amount'];
        }
        $promocode->start_date = $request['start_date'];
        $promocode->end_date = $request['end_date'];
        $promocode->save();
        return redirect()->back();
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'amount' => $request['type'] == 'percentage' ? 'numeric|min:1|max:100' : 'numeric|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date', // Ensure end date is after or equal to start date
        ]);
        $promocode = \App\PromoCode::findorfail($id);
        $promocode->code=$request['name'];
        $promocode->type=$request['type'];
        if ($promocode->type == 'percentage') {
            $promocode->amount = $request['percentage'];
        } else {
            $promocode->amount = $request['amount'];
        }
        $promocode->start_date = $request['start_date'];
        $promocode->end_date = $request['end_date'];
        $promocode->save();
        return redirect('editpromocode');
    }

    public function apply(Request $request)
    {
        $request->validate([
            'promo_code' => 'required',
        ]);

        // Get the promo code entered by the user
        $promoCodeInput = $request->input('promo_code');

        // Check if the promo code exists in the database
        $promoCode = \App\PromoCode::where('code', $promoCodeInput)->first();

        if (!$promoCode) {
            // Promo code does not exist
            return redirect()->back()->with('error', 'Invalid promo code.');
        }

        // Check if the promo code is within the valid date range
        $currentDate = Carbon::now();
        if ($promoCode->start_date > $currentDate || $promoCode->end_date < $currentDate) {
            // Promo code is not valid (either it hasn't started or it's expired)
            return redirect()->back()->with('error', 'Promo code is not valid for the current date.');
        }

        $discount = 0;

        if ($promoCode->type == 'amount') {
            $discount = $promoCode->amount;
        } elseif ($promoCode->type == 'percentage') {
            $discount = $promoCode->amount / 100;
        }

        // Store the new total and the discount in the session
        session(['discount' => $discount, 'promoCodeApplied' => $promoCode->code, 'type' => $promoCode->type]);

        // Promo code is valid, apply it
        return redirect()->back()->with('success', 'Promo code applied successfully!');
    }

    public function destroy($id)
    {
        $promocode = \App\PromoCode::findorfail($id);
        $promocode->delete();
        return redirect('editpromocode');
    }
}
