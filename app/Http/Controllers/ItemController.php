<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;


class ItemController extends Controller
{

    protected $items_per_page = 16;
    public function validation($request)
    {
        //validate data passed from add item view or edit item view

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'img' => ['required']
        ]);

    }
    public function product($category_name)
    {
        //show items has product with num choosen
        $ids = request()->input('num');

        if (Auth::user() && auth()->user()->type == 1) {
            $items = \App\item::orderBy('id', 'DESC')
                ->whereIn('category_id', $ids)
                ->paginate($this->items_per_page);
        } else {
            $items = \App\item::where('hide', '=', NULL)
                ->orderBy('id', 'DESC')
                ->whereIn('category_id', $ids)
                ->paginate($this->items_per_page);

        }
        return view('shop')->with(compact('items'));

    }
    public function welcome()
    {
        if (Auth::user() && auth()->user()->type == 1) {
            $newArrivals = \App\item::orderBy('id', 'DESC')->take(4)->get();
            $items = \App\item::orderBy('id', 'DESC')->get()->slice(4, 8);
            $donation = \App\item::where('description', 'like', '%Donation%')
                ->orderBy('id', 'DESC')->get();
        } else {
            $newArrivals = \App\item::where('hide', '=', NULL)->orderBy('id', 'DESC')->take(4)->get();
            $items = \App\item::where('hide', '=', NULL)->orderBy('id', 'DESC')->get()->slice(4, 8);
            $donation = \App\item::where('hide', '=', NULL)
                ->where('description', 'like', '%Donation%')
                ->orderBy('id', 'DESC')->get();
        }
        $home_images = \App\home_image::orderBy('id', 'DESC')->get();
        $parentCategories = \App\category::where('is_child', false)->get();
        return view('welcome', [
            'newArrivals' => $newArrivals,
            'items' => $items,
            'donation' => $donation,
            'home_images' => $home_images,
            'parent_categories' => $parentCategories
        ]);


    }
    public function shop()
    {

        if (Auth::user() && auth()->user()->type == 1) {
            $items = \App\item::orderBy('id', 'DESC')->paginate($this->items_per_page);
        } else {
            $items = \App\item::where('hide', '=', NULL)->orderBy('id', 'DESC')->paginate($this->items_per_page);

        }
        return view('shop', [
            'items' => $items
        ]);


    }


    public function create()
    {
        //retieve all categories and passed to add item view

        $categories = \App\category::where('is_child', true)->get();

        return view('additem', [
            'categories' => $categories
        ]);

    }


    public function store(Request $request)
    {
        //create new item in items table and create images in images table

        $this->validation($request);
        $item = new \App\item;

        // Loop over the description input, add to array, and convert to JSON
        $descriptionArray = [];
        foreach ($request->input('description') as $descriptionLine) {
            if ($descriptionLine != null && $descriptionLine != '') {
                $descriptionArray[] = $descriptionLine;
            }
        }
        $descriptionJson = json_encode($descriptionArray);

        $descriptionArrayArabic = [];
        foreach ($request->input('description_ar') as $descriptionLine) {
            if ($descriptionLine != null && $descriptionLine != '') {
                $descriptionArrayArabic[] = $descriptionLine;
            }
        }
        $descriptionJsonArabic = json_encode($descriptionArrayArabic);

        $colors = $request->input('color');
        $colorNames = $request->input('color-name');
        $colorNamesArabic = $request->input('color-name-ar');

        $colorData = [];

        for ($i = 0; $i < count($colors); $i++) {
            if (!empty($colors[$i]) && !empty($colorNames[$i]) && !empty($colorNamesArabic[$i])) {
                $colorData[] = [
                    'hex' => $colors[$i],
                    'name' => $colorNames[$i],
                    'name_ar' => $colorNamesArabic[$i]
                ];
            }
        }
        $colorsJson = json_encode($colorData);

        $styleArray = [];
        foreach ($request->input('style') as $styleLine) {
            if ($styleLine != null && $styleLine != '') {
                $styleArray[] = $styleLine;
            }
        }
        $styleJson = json_encode($styleArray);

        $styleArrayArabic = [];
        foreach ($request->input('style_ar') as $styleLine) {
            if ($styleLine != null && $styleLine != '') {
                $styleArrayArabic[] = $styleLine;
            }
        }
        $styleJsonArabic = json_encode($styleArrayArabic);

        $sizeArray = [];
        foreach ($request->input('size') as $sizeLine) {
            if ($sizeLine != null && $sizeLine != '') {
                $sizeArray[] = $sizeLine;
            }
        }
        $sizeJson = json_encode($sizeArray);

        $productPrices = [];
        $prices = $request->input('prices');
        $costs = $request->input('costs');
        $quantities = $request->input('quantities');
        $afterSalePrices = $request->input('after_sale_prices');
        if (count($sizeArray) > 0 && count($styleArray) > 0) {
            // dd($prices, $costs, $quantities, $afterSalePrices);
            foreach ($styleArray as $styleIndex => $style) {
                foreach ($sizeArray as $size) {
                    if (isset($prices[$style][$size]) && isset($costs[$style][$size]) && isset($quantities[$style][$size]) && isset($afterSalePrices[$style][$size])) {
                        $productPrices[] = [
                            'style' => $styleIndex,
                            'size' => $size,
                            'price' => $prices[$style][$size],
                            'cost' => $costs[$style][$size],
                            'quantity' => $quantities[$style][$size],
                            'after_sale_price' => $afterSalePrices[$style][$size]
                        ];
                    }
                }
            }
        } else if (count($sizeArray) == 0 && count($styleArray) > 0) {
            foreach ($styleArray as $styleIndex => $style) {
                if (isset($prices[$style]["none"]) && isset($costs[$style]["none"]) && isset($quantities[$style]["none"]) && isset($afterSalePrices[$style]["none"])) {
                    $productPrices[] = [
                        'style' => $styleIndex,
                        'size' => 'none',
                        'price' => $prices[$style]["none"],
                        'cost' => $costs[$style]["none"],
                        'quantity' => $quantities[$style]["none"],
                        'after_sale_price' => $afterSalePrices[$style]["none"]
                    ];
                }
            }
        } else if (count($styleArray) == 0 && count($sizeArray) > 0) {
            foreach ($sizeArray as $size) {
                if (isset($prices["none"][$size]) && isset($costs["none"][$size]) && isset($quantities["none"][$size]) && isset($afterSalePrices["none"][$size])) {
                    $productPrices[] = [
                        'style' => 'none',
                        'size' => $size,
                        'price' => $prices["none"][$size],
                        'cost' => $costs["none"][$size],
                        'quantity' => $quantities["none"][$size],
                        'after_sale_price' => $afterSalePrices["none"][$size]
                    ];
                }
            }
        }
        if (count($productPrices) > 0) {
            $pricesOnly = array_column($productPrices, 'price');
            $lowestPrice = min($pricesOnly);
        }
        // dd($productPrices);
        $productPricesJson = json_encode($productPrices);

        $careInstructionsArray = [];
        foreach ($request->input('care_instructions') as $instructionLine) {
            if ($instructionLine != '' && $instructionLine != null) {
                $careInstructionsArray[] = $instructionLine;
            }
        }
        $careInstructionsJson = json_encode($careInstructionsArray);

        $careInstructionsArrayArabic = [];
        foreach ($request->input('care_instructions_ar') as $instructionLine) {
            if ($instructionLine != '' && $instructionLine != null) {
                $careInstructionsArrayArabic[] = $instructionLine;
            }
        }
        $careInstructionsJsonArabic = json_encode($careInstructionsArrayArabic);

        $item->name = $request['name'];
        $item->name_ar = $request['name_ar'];
        $item->description = $descriptionJson;
        $item->description_ar = $descriptionJsonArabic;
        $item->quantity = $request['quantity'];
        $item->price = count($productPrices) > 0 ? $lowestPrice : $request['price'];
        $item->cost = $request['cost'];
        $item->category_id = $request['category'];
        $item->care_instructions = $careInstructionsJson;
        $item->care_instructions_ar = $careInstructionsJsonArabic;
        $item->return_policy = $request['refund_policy'];
        $item->return_policy_ar = $request['refund_policy_ar'];
        $item->colors = $colorsJson;
        $item->styles = $styleJson;
        $item->styles_ar = $styleJsonArabic;
        $item->sizes = $sizeJson;
        $item->priceVariations = $productPricesJson;
        $item->keywords = $request['keywords'];
        $item->save();

        $item_id = $item->id;

        $files = $request->file('img');
        $imageColors = $request['image_dropdown'];
        foreach ($files as $index => $file) {
            $name = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
            $file->move("images", $name);
            $image = new \App\image;

            $image->name = $name;
            $image->item_id = $item_id;
            $image->color_hex = $imageColors[$index];

            $image->save();
        }
        return redirect('home');
    }


    public function show($id)
    {
        //retrieve show single item by id

        $item = \App\item::findorfail($id);

        return view('item', [
            'item' => $item,
        ]);

    }


    public function edit($id)
    {
        //retieve all categories and item data to pass to edit item view

        $item = \App\item::findorfail($id);
        $categories = \App\category::all();
        return view('edititem', [
            'item' => $item,
            'categories' => $categories
        ]);

    }


    public function update(Request $request, $id)
    {
        //update item with new data passed

        $this->validation($request);
        $item = \App\item::find($id);
        $item->name = $request['name'];
        $item->description = $request['description'];
        $item->quantity = $request['quantity'];
        $item->price = $request['price'];
        $item->cost = $request['cost'];
        $item->category_id = $request['category'];
        $item->barcode = $request['barcode'];
        // $item->product = $request['product'];
        $item->save();
        $item_id = $item->id;
        if ($files = $request->file('img')) {
            foreach ($files as $file) {
                $name = rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
                $file->move("images", $name);
                $image = new \App\image;
                $image->name = $name;
                $image->item_id = $item_id;
                $image->save();
            }
        }

        return redirect('home');
    }


    public function destroy($id)
    {
        //delete item with passed item

        $item = \App\item::findorfail($id);
        $item->delete();
        return redirect()->back();

    }
    public function deleteImage($id)
    {
        //delete image from images table with passed id

        $image = \App\image::find($id);
        DB::table('images')->where('id', '=', $id)->delete();
        echo $image->name;
        if (\File::exists(public_path('images/' . $image->name))) {

            \File::delete(public_path('images/' . $image->name));

        } else {

            echo 'File does not exists.';

        }

        return redirect()->back();

    }

    function search(Request $request)
    {
        //search for item in items table by item name

        if ($request->ajax()) {
            $query = $request['query'];

            $output = '';

            if ($query != '') {

                if (Auth::user() && auth()->user()->type == 1) {
                    if (app()->getLocale() == 'ar') {
                        $items = \App\item::where('name_ar', 'like', '%' . $query . '%')->orWhere('keywords', 'like', '%' . $query . '%')
                        ->orWhereHas('category', function ($q) use ($query) {
                            $q->where('name', 'like', '%' . $query . '%');
                        })->orderBy('id', 'DESC')->get();
                    } else {
                        $items = \App\item::where('name', 'like', '%' . $query . '%')->orWhere('keywords', 'like', '%' . $query . '%')
                        ->orWhereHas('category', function ($q) use ($query) {
                            $q->where('name', 'like', '%' . $query . '%');
                        })->orderBy('id', 'DESC')->get();
                    }
                } else {
                    if (app()->getLocale() == 'ar') {
                        $items = \App\item::where('hide', '=', NULL)->where('name_ar', 'like', '%' . $query . '%')->orWhere('keywords', 'like', '%' . $query . '%')
                        ->orWhereHas('category', function ($q) use ($query) {
                            $q->where('name', 'like', '%' . $query . '%');
                        })->orderBy('id', 'DESC')->get();
                    } else {
                        $items = \App\item::where('hide', '=', NULL)->where('name', 'like', '%' . $query . '%')->orWhere('keywords', 'like', '%' . $query . '%')
                        ->orWhereHas('category', function ($q) use ($query) {
                            $q->where('name', 'like', '%' . $query . '%');
                        })->orderBy('id', 'DESC')->get();
                    }
                }

                $total_row = $items->count();
                if ($total_row > 0) {
                    foreach ($items as $item) {
                        // $output .= '<a href="' . route("item.show", ["id" => $item->id]) . '"><p>' . $item->name . '</p></a>';
                        if (app()->getLocale() == 'ar') {
                            $output .= '<a href="' . route("item.show", ["id" => $item->id]) . '"><p>' . $item->name_ar . '</p></a>';
                        } else {
                            $output .= '<a href="' . route("item.show", ["id" => $item->id]) . '"><p>' . $item->name . '</p></a>';
                        }
                    }
                } else {
                    if (app()->getLocale() == 'ar') {
                        $output .= '<p>لا يوجد منتجات</p>';
                    } else {
                        $output .= '<p>Sorry, nothing found</p>';
                    }
                }
            }
            return response()->json(['result' => $output]);

        }
    }
    public function hide($id)
    {
        $item = \App\item::findorfail($id);
        if ($item->hide != 1) {
            $item->hide = 1;
        } else {
            $item->hide = NULL;
        }
        $item->save();
        return redirect()->back();

    }
}

