<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function changeStatus($id, $value)
    {

        if ($value == 2) {
            $items = Order::find($id)->Request()->get();;
            foreach ($items as $item) {
                $history = [
                    'user_id' => $item->user_id,
                    'product_id' => $item->product_id,
                    'status' => 1,
                    'started' => date("Y-m-d"),
                    'expiry' => $item->expiry,
                ];
                History::create($history);

            }
            Order::find($id)->update(["status" => $value]);
            return redirect()->back()->with($value, "success");
        } else {
            Order::find($id)->update(["status" => $value]);
        }
        return redirect()->back()->with($value, "success");
    }
}
