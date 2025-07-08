<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class GenreController extends Controller
{
    public function  index(){
        $genres = Genre::all(['id','genre_name'])->sortBy('id');
        return view('genre/genre_index',['genres'=>$genres]);
    }

    public function admin(){
        $films = Film::with('genres')->get();
        return view('admin/index',['films'=>$films]);
    }
    
    public function add(){
        return view('genre/genre_add');
    }
    
    public function save(Request $request) {
        if (isset($request->id)) {  // use existing
           $genre = Genre::find($request->id);
        } else {
           $genre = new Genre();
        }
        $genre->genre_name = $request->genre_name;
        $genre->save();
        return redirect("/genre");
    }

    public function update(string $id){
        $genre = Genre::find($id);
        return view('genre/genre_add',['genre'=>$genre]);
    }

    public function delete(Request $request) {
        if ($request->method() == "POST") {
            $genre = Genre::find($request->id)->delete();
            return redirect("/genre");
        } else {
            $genre = DB::table("genres")->find($request->id);
            return view("genre/genre_delete", ["genre" => $genre]);
        }
    }
}
