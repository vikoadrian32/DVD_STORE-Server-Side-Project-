<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Stok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function orderTicket(Request $request){
       $stok = Stok::where('film_id', $request->film_id)->first();

       if (!$stok || $stok->jumlah < $request->quantity) {
        return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }
        $stok->jumlah -= $request->quantity;
        $stok->save();
      
       $order =  new Order();
       $order->film_id = $request->film_id;
       $order->account_id = Auth::guard('accounts')->id();
       $order->quantity = $request->quantity;
       $order->total_price = $request->total_price;
       $order->tanggal_nonton = $request->selected_date;
       $order->save();

       
       return redirect()->back()->with('success', 'Tiket berhasil dipesan!');
    }


    public function getTicket(){
        $userId = Auth::guard('accounts')->id(); // atau auth()->user()->id
        $order = Order::with(['film.genres', 'film.attribute'])
                       ->where('account_id', $userId)
                       ->get();
        return view('user/ticketView',['orders'=>$order]);
    }

}
