<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\selectedItem;
use Nafezly\Payments\Classes\PaymobPayment;

class CheckoutController extends Controller
{
    public function index()
    {
        //show items added in cart stored in session

        $selectedItems = Session::has('selcteditems') ? Session::get('selcteditems') : array();
        $fees = \App\fee::all();
        // dd($fees);
        $zones = \App\zone::all();

        $totalAmount = 0;

        foreach ($selectedItems as $item) {
            $itemPrice = $item->price;
            $quantity = $item->Quantity;
            $totalAmount += $itemPrice * $quantity;
        }

        session(['totalAmount' => $totalAmount]);

        return view('checkout', [
            'items' => $selectedItems ?? 'Doesnot exist',
            'fees' => $fees,
            'zones' => $zones,
            'totalAmount' => $totalAmount
        ]);
    }

    public function makePayment()
    {
        $payment = new PaymobPayment();

        //pay function
        $payment->pay(
            20.0,
            $user_id = 1,
            $user_first_name = 'Saher',
            $user_last_name = 'Seada',
            $user_email = 'saher.seada10@gmail.com',
            $user_phone = '01015003366',
            $source = null
        );
    }
}
