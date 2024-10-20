<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\selectedItem;

class CartController extends Controller
{
    public function showCart()
    {
        //show items added in cart stored in session

        $selcteditems = Session::has('selcteditems') ? Session::get('selcteditems') : array();
        // dd($selcteditems);
        $fees = \App\fee::all();
        $zones = \App\zone::all();

        return view('cart', [
            'items' => $selcteditems ?? 'Doesnot exist',
            'fees' => $fees,
            'zones' => $zones
        ]);
    }
    public function removeItem($id)
    {
        //remove item from cart array stored in session

        $selcteditems = Session::get('selcteditems');

        for ($i = 0; $i < sizeof($selcteditems); $i++) {
            if ($selcteditems[$i]->item->id == $id) {
                unset($selcteditems[$i]);
                $selcteditems = array_values($selcteditems);
                Session::put('selcteditems', $selcteditems);
                $number_of_items = count($selcteditems);
                Session::put('number_of_items', $number_of_items);

            }
        }
        return redirect('cart');

    }
    public function AddToCart(Request $request)
    {
        /*
            add item in cart array in not exist or increment quantity existing item in cart array
            and increment number of items in cart
        */
        $id = $request['name'];
        $size = $request['size'];
        $quantity = $request['quantity'];
        $note = $request['note'];
        $style = $request['style'];
        $style_ar = $request['style_ar'];
        $color = $request['color'];
        $color_ar = $request['color_ar'];
        $selcteditems = Session::has('selcteditems') ? Session::get('selcteditems') : array();
        $found = false;
        $item = \App\item::findorfail($id);
        $productPrices = json_decode($item->priceVariations);
        // \Log::info($productPrices);
        $styles = json_decode($item->styles);
        $price = $item->price;
        $availableQuantity = $item->quantity;
        // \Log::info($styles);

        foreach ($productPrices as $productPrice) {
            if ($styles[$productPrice->style] == $style && $productPrice->size == $size) {
                $price = $productPrice->price;
                $availableQuantity = $productPrice->quantity;
                break;
            }
        }
        if ($availableQuantity < $quantity) {
            $message = __('messages.not_enough_items');
            return response()->json(['message' => $message]);
        }
        foreach ($selcteditems as $selcteditem) {
            if ($selcteditem->item->id == $id && $selcteditem->size == $size && $selcteditem->note == $note && $selcteditem->style == $style && $selcteditem->color == $color) {
                $found = true;
                if ($availableQuantity < $selcteditem->Quantity + $quantity) {
                    $message = __('messages.not_enough_items');
                    return response()->json(['message' => $message]);
                } else {
                    $selcteditem->Quantity += $quantity;
                    $found = true;
                }
            }
        }
        if ($found == false) {
            $item = new selectedItem($id);
            $item->Quantity = $quantity;
            $item->size = $size;
            $item->note = $note;
            $item->style = $style;
            $item->style_ar = $style_ar;
            $item->color = $color;
            $item->color_ar = $color_ar;
            $item->price = $price;
            array_push($selcteditems, $item);
            // \Log::info($item->price);
            // dd($item);
        }

        $number_of_items = count($selcteditems);
        Session::put('number_of_items', $number_of_items);
        Session::put('selcteditems', $selcteditems);

        return response()->json(['countCart' => $number_of_items]);
    }

    public function decrementItem(Request $request)
    {
        /*
           dencrement quantity existing item in cart array
            and dencrement number of items in cart
        */
        $id = $request['id'];
        $selcteditems = Session::get('selcteditems');
        $totalprice = 0;

        for ($i = 0; $i < sizeof($selcteditems); $i++) {
            if ($selcteditems[$i]->id == $id) {
                $selcteditems[$i]->Quantity -= 1;
                $quantity = $selcteditems[$i]->Quantity;
                $item_total_price = $quantity * $selcteditems[$i]->price;
                Session::put('selcteditems', $selcteditems);

            }
            $totalprice += $selcteditems[$i]->Quantity * $selcteditems[$i]->price;

        }
        return response()->json([
            'quantity' => $quantity,
            'item_total_price' => $item_total_price,
            'totalprice' => $totalprice
        ]);
    }
    public function incrementItem(Request $request)
    {
        /*
          increment quantity existing item in cart array
           and increment number of items in cart
       */
        $id = $request['id'];
        $selcteditems = Session::get('selcteditems');
        $totalprice = 0;
        $item = \App\item::findorfail($id);
        $availableQuantity = $item->quantity;
        $styles = json_decode($item->styles);
        $sizes = json_decode($item->sizes);
        $productPrices = json_decode($item->priceVariations);

        for ($i = 0; $i < sizeof($selcteditems); $i++) {
            if ($selcteditems[$i]->id == $id) {
                foreach ($productPrices as $productPrice) {
                    if ($styles[$productPrice->style] == $selcteditems[$i]->style && $productPrice->size == $selcteditems[$i]->size) {
                        $availableQuantity = $productPrice->quantity;
                        break;
                    }
                }
                if ($availableQuantity < $selcteditems[$i]->Quantity + 1) {
                    $message = __('messages.not_enough_items');
                    return response()->json(['message' => $message]);
                }
                $selcteditems[$i]->Quantity += 1;
                $quantity = $selcteditems[$i]->Quantity;
                $item_total_price = $quantity * $selcteditems[$i]->price;
                Session::put('selcteditems', $selcteditems);
            }
            $totalprice += $selcteditems[$i]->Quantity * $selcteditems[$i]->price;

        }
        return response()->json([
            'quantity' => $quantity,
            'item_total_price' => $item_total_price,
            'totalprice' => $totalprice
        ]);

    }

}
