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
// use \PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
// use Barryvdh\DomPDF\Facade as PDF;
// use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\Mail;



class OrderController extends Controller
{
    public function showAll(Request $request)
    {
        //retrieve all orders by admin and passed to vieworders
        $status = $request->input('status');
        if ($status != null) {
            $orders = \App\order::when($status, function ($query, $status) {
                return $query->where('status', $status);
            })->orderBy('created_at', 'desc')->get();
        } else {
            $orders = \App\order::orderBy('id', 'DESC')->get();
        }
        return view('vieworders', [
            'orders' => $orders
        ]);

    }
    public function show()
    {
        //retrieve client last order and passed to lastorder view

        $order = \Auth::user()->orders()->orderBy('created_at', 'desc')->get();
        return view('lastorder', [
            'orders' => $order,
        ]);

    }
    public function create(Request $request)
    {
        /* create new record in orders table and add items in cart array stored in session
           to item_order table after click on checkout */

        $request->validate([
            'address' => ['required', 'string', 'max:64000'],
            'city' => ['required']
        ]);
        $fee = \App\fee::findorfail($request['governorate']);
        $selcteditems = Session::has('selcteditems') ? Session::get('selcteditems') : array();
        $order = new \App\order;
        $order->user_id = auth()->id();
        $order->first_name = $request['first_name'];
        $order->last_name = $request['last_name'];
        $order->email = $request['email'];
        $order->phone = $request['phone'];
        $order->address = $request['address'] . " - " . $request['city'] . " - " . $fee['name'];
        $order->status = 'Placed';
        $order->save();
        $totalprice = 0;
        $totalcost = 0;

        foreach ($selcteditems as $selecteditem) {
            $item = \App\item::find($selecteditem->item->id);
            $size = $selecteditem->size;
            $priceVariations = json_decode($item->priceVariations);
            $styles = json_decode($item->styles);
            if (count($priceVariations) > 0) {
                $styleIndex = array_search($selecteditem->style, $styles);
                foreach ($priceVariations as $priceVariation) {
                    if ($priceVariation->style == $styleIndex && $priceVariation->size === $size) {
                        $priceVariation->quantity -= $selecteditem->Quantity;
                        break;
                    }
                }
                $item->priceVariations = json_encode($priceVariations);
            } else {
                $item->quantity -= $selecteditem->Quantity;
            }
            $item->save();

            $totalprice += $selecteditem->Quantity * $selecteditem->price;
            $totalcost += $selecteditem->Quantity * $selecteditem->item->cost;

            DB::table('item_order')->insert(
                [
                    'item_id' => $selecteditem->item->id,
                    'order_id' => $order->id,
                    'quantity' => $selecteditem->Quantity,
                    'size' => $selecteditem->size,
                    'style' => $selecteditem->style,
                    'style_ar' => $selecteditem->style_ar,
                    'color' => $selecteditem->color,
                    'color_ar' => $selecteditem->color_ar,
                    'note' => $selecteditem->note,
                    'price' => $selecteditem->price
                ]
            );

        }
        $order->total_price = $totalprice + $fee['value'];
        $order->total_cost = $totalcost;


        $order->save();
        Session::put('number_of_items', 0);
        Session::put('selcteditems', array());

        $details = [
            'title' => 'Spot Fabrics Order Confirmed',
            'order' => $order ,
        ];
        $file = 'emails.send_order_to_admin';
        \Mail::to($order->email)->send(new SendMail($details, $file));

        return redirect('myorders');
    }

    public function reject($id)
    {
        //update order status to 0 and send message to the client

        $order = \App\order::findorfail($id);
        $order->status = 0;
        $order->save();
        $message = MessageController::createmessage('Something wrong in your order', '0', $order->user->id);
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

    public function generatePDF($id)
    {
        // Fetch order details using the provided ID
        $order = \App\Order::find($id);

        // Ensure the order exists
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }

        // Load a Blade view and pass the order data to it
        $pdf = PDF::loadView('orderpdf', compact('order'));

        // Return the PDF as a download or inline view
        return $pdf->stream('order_' . $id . '.pdf');
    }

    public function report(Request $request)
    {
        /* show in report view sold items , total price and total cost
            calculate them from orders table , item_order table and items table
        */
        if (count($request->all())) {
            $startDate = date('Y-m-d', strtotime($request->from));
            $endDate = date('Y-m-d', strtotime($request->to));

        } else {
            $startDate = date('Y-m-01');
            $endDate = date('Y-m-30');

        }
        $orders = \App\order::where('status', '=', '1')
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->get();
        $sold_items = array();
        $totalprice = 0;
        $totalcost = 0;
        $totaldelivery = 0;

        foreach ($orders as $order) {

            foreach ($order->items()->get() as $item) {

                $found = false;

                foreach ($sold_items as $sold_item) {
                    if ($sold_item->item->id == $item->id) {
                        $sold_item->Quantity += $item->pivot->quantity;
                        $found = true;
                    }
                }
                if ($found == false) {
                    $x = new selectedItem($item->id);
                    $x->Quantity = $item->pivot->quantity;
                    array_push($sold_items, $x);

                }

                $totalcost += $item->cost * $item->pivot->quantity;

            }
            $totalprice += $order->total_price - 10;
            $totaldelivery += 10;

        }
        return view('report', [
            'from' => $startDate,
            'to' => $endDate,
            'items' => $sold_items,
            'totalprice' => $totalprice,
            'totalcost' => $totalcost,
            'totaldelivery' => $totaldelivery
        ]);

    }
    public function changeStatus($id, $status)
    {
        $order = \App\order::find($id);
        $order->status = $status;
        $order->save();
        return redirect()->back();
    }
    public function downloadreport()
    {
        $pdf = PDF::loadView('reportPDF');

        return $pdf->download('disney.pdf');
        // return redirect()->back();
    }
    public function accept($id)
    {
        //update order status to 1 and send message to the client

        $order = \App\order::findorfail($id);
        $order->status = 1;
        $order->save();
        $message = MessageController::createmessage('Your order accepted', '0', $order->user->id);
        return redirect()->back();

    }
    public function invoice($id)
    {
        $order = \App\order::findorfail($id);
        $view = \View::make('invoice', compact('order'));
        $html = $view->render();

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf::SetFont('dejavusans', '', 18);

        $pdf::SetTitle('Invoice');
        $pdf::AddPage();
        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output($order->user->phone . '.pdf', 'D');


        // parent::__construct( $orientation, $unit, $format, true, 'UTF-8', false );


        # Set the page margins: 72pt on each side, 36pt on top/bottom.
        //     $pdf::SetMargins( 71, 36, 72, true );
        //     $pdf::SetAutoPageBreak( true, 36 );

        //     # Set document meta-information
        //     $pdf::SetCreator( PDF_CREATOR );
        //     $pdf::SetAuthor( 'Chris Herborth (chrish@pobox.com)' );
        //     //$pdf::SetTitle( 'Invoice for ' . $pdf::invoiceData['user'] );
        //     $pdf::SetSubject( "A simple invoice example for 'Creating PDFs on
        // the fly with TCPDF' on IBM's developerWorks" );
        //     $pdf::SetKeywords( 'PHP, sample, invoice, PDF, TCPDF' );

        //     //set image scale factor
        //     $pdf::setImageScale(PDF_IMAGE_SCALE_RATIO);

        //     //set some language-dependent strings
        //     global $l;
        //     $pdf::setLanguageArray($l);

        //     $pdf::AddPage();
        // $pdf::SetFont( 'aealarabiya', '', 11 );
        // $pdf::SetY( 144, true );

        // # Table parameters
        // #
        // # Column size, wide (description) column, table indent, row height.
        // $col = 72;
        // $wideCol = 3 * $col;
        // $indent = ( $pdf::getPageWidth() - 2 * 72 - $wideCol - 3 * $col ) / 2;
        // $line = 18;

        // # Table header
        // $pdf::SetFont( '', 'b' );
        // $pdf::Cell( $indent );
        // $pdf::Cell( $wideCol, $line, 'Item', 1, 0, 'L' );
        // $pdf::Cell( $col, $line, 'Quantity', 1, 0, 'R' );
        // $pdf::Cell( $col, $line, 'Price', 1, 0, 'R' );
        // $pdf::Cell( $col, $line, 'Cost', 1, 0, 'R' );
        // $pdf::Ln();

        // # Table content rows
        // $pdf::SetFont( '', '' );
        // foreach( $order->items as $item ) {
        //     $pdf::Cell( $indent );
        //     $pdf::Cell( $wideCol, $line, $item->name, 1, 0, 'L' );
        //     $pdf::Cell( $col, $line, $item->pivot->quantity, 1, 0, 'R' );
        //     $pdf::Cell( $col, $line, $item->price, 1, 0, 'R' );
        //     $pdf::Cell( $col, $line, $item->price, 1, 0, 'R' );
        //     $pdf::Ln();
        // }

        // # Table Total row
        // $pdf::SetFont( '', 'b' );
        // $pdf::Cell( $indent );
        // $pdf::Cell( $wideCol + $col * 2, $line, 'Total:', 1, 0, 'R' );
        // $pdf::SetFont( '', '' );
        // $pdf::Cell( $col, $line,$order->total_price, 1, 0, 'R' );

        // $pdf::Output($order->user->phone.'.pdf','D');

    }




}
