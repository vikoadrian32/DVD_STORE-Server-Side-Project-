<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Stok;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index(){
        $stok = Stok::with('film')->get();
        return view('stok/index',['stoks'=>$stok]);
    }
    public function add(){
        $films = Film::with('genres')->get();
        return view('stok/form',['films'=>$films]);
    }

    public function save(Request $request){
        if (isset($request->id)) {  // use existing
            $stok = Stok::find($request->id);
        } else {
            $stok = new Stok();  // create a new one
        }
        
        $stok->film_id = $request->films;
        $stok->jumlah = $request->quantity;
        $stok->save();
        return redirect('/stok');
    }
    public function update(string $id){
        $stok= DB::table('stoks')->find($id);
        $films = Film::all(['id','title']);
        return view('stok/form',[
            'stoks' => $stok,
            'films'=> $films

        ]);

    }
    public function delete(Request $request) {
        if ($request->method() == "POST") {
            $stok = Stok::find($request->id)->delete();
            return redirect("/stok");
        } else {
            $Stok= DB::table("stoks")->find($request->id);
            return view("stok/delete", ["stok" => $Stok]);
        }
    }

}
