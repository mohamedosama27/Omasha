<?php

namespace App\Http\Controllers;
use \App\Mail\SendMail;
use Illuminate\Http\Request;
use App\Event\CreateOrder;
use App\Http\Controllers\MessageController;
use Nexmo\Laravel\Facade\Nexmo;
use App\Http\Controllers\Auth;
use Session;
use DB;
use App\selectedItem;
use PDF;


class OrderController extends Controller
{
    public function showAll()
    {
        //retrieve all orders by admin and passed to vieworders

        $orders = \App\order::orderBy('id', 'DESC')->get();
        $items=DB::table('item_order')->get();
        return view('vieworders',[
            'orders'=>$orders,
            'items'=>$items,

        ]);
       
    }
    public function show()
    {
        //retrieve client last order and passed to lastorder view

        $order = \Auth::user()->orders()->get()->last();
        return view('lastorder',[
            'order'=>$order,
        ]);
        
    }
    public function create(Request $request)
    {
        /* create new record in orders table and add items in cart array stored in session
           to item_order table after click on checkout */
        $selcteditems = Session::has('selcteditems') ? Session::get('selcteditems') : array();
        $order = new  \App\order;
        $order->user_id = auth()->id();
        $order->address=$request['address'];
        $order->save();
        $totalprice=0;
        $totalcost=0;

        foreach($selcteditems as $selecteditem)
        {
            $item = \App\item::find($selecteditem->item->id);
            $item->quantity-=$selecteditem->Quantity;
            $item->save();

            $totalprice+=$selecteditem->Quantity*$selecteditem->item->price;
            $totalcost+=$selecteditem->Quantity*$selecteditem->item->cost;

            DB::table('item_order')->insert(
                ['item_id' => $selecteditem->item->id,
                 'order_id' => $order->id,
                'quantity' =>$selecteditem->Quantity]
            );
       
        }
        $order->total_price=$totalprice+10;
        $order->total_cost=$totalcost;

        
        $order->save();
        Session::put('number_of_items',0 );
        Session::put('selcteditems',array());
        
        // $details = [
        //     'title' => 'You have new order',
        //     'order' => $order ,
        // ];
        // Nexmo::message()->send([
        //     'to'   => '+201118221684',
        //     'from' => '+201118221684',
        //     'text' => 'You submit new order  http://aqueous-dawn-37150.herokuapp.com/chat/'.auth()->id()." .",
        // ]);
        \Mail::to('mohamed1705725@miuegypt.edu.eg')->send(new SendMail($details));

             return redirect('lastorder');
    }
    public function accept($id)
    {
        //update order status to 1 and send message to the client

        $order = \App\order::findorfail($id);
        $order->status=1;
        $order->save();
        $message=MessageController::createmessage('Your order accepted','0',$order->user->id);
        return redirect('vieworders');
    }
    public function reject($id)
    {
        //update order status to 0 and send message to the client

        $order = \App\order::findorfail($id);
        $order->status=0;
        $order->save();
        $message=MessageController::createmessage('Something wrong in your order','0',$order->user->id);
        return redirect('vieworders');
    }
    public function destroy($id)
    {
        //delete order from orders table and records in item_order table when this id equal to order_id

        $order = \App\order::findorfail($id);
        $order->delete();
        DB::table('item_order')->where('order_id', '=', $id)->delete();
        return redirect('vieworders');

    }
    public function report(Request $request)
    {
        /* show in report view sold items , total price and total cost
            calculate them from orders table , item_order table and items table
        */
        if (count($request->all())) {
            $startDate = date('Y-m-d', strtotime($request->from));
            $endDate = date('Y-m-d', strtotime($request->to));

        }
        else
        {
            $startDate = date('Y-m-01');
            $endDate = date('Y-m-30');
           
        }
        $orders = \App\order::where('status','=','1')
                                ->whereDate('created_at', '>=', $startDate)
                                ->whereDate('created_at', '<=', $endDate)
                                ->get();
            $sold_items = array();
            $totalprice=0;
            $totalcost=0;

            foreach($orders as $order)
            {

                foreach($order->items()->get() as $item)
                {
     
                    $found=false;

                    foreach($sold_items as $sold_item)
                    {
                        if($sold_item->item->id == $item->id)
                        {
                            $sold_item->Quantity += $item->pivot->quantity;
                            $found = true;
                        }
                    }
                    if($found==false)
                    {   
                         $x = new selectedItem($item->id);
                        $x->Quantity=$item->pivot->quantity;
                        array_push($sold_items,$x);

                    }
                    
                    $totalcost+=$item->cost*$item->pivot->quantity;

                }
                $totalprice+=$order->total_price;
            }
            return view('report',[
                'from' => $startDate,
                'to' => $endDate,
                'items' => $sold_items,
                'totalprice' => $totalprice,
                'totalcost' => $totalcost

            ]);
        
    }
    public function downloadreport()
    {
        $pdf = PDF::loadView('reportPDF');
        
        return $pdf->download('disney.pdf');
        return redirect()->back();
    }

 
}
