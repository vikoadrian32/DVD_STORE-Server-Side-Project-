<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Film;
use Illuminate\Support\Facades\DB;
use App\Models\Genre;
use Attribute;
// use Attribute;

use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index(Request $request){
        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $films = Film::with("attribute")
                ->where('title', 'like', "%$keyword%")
                ->get();
    
            return view('user/home', ['films' => $films]);
        }
    
        // Default: tanpa pencarian
        $films = Film::with("attribute")->get();
        return view('user/home', ['films' => $films]);
    }
    
    public function admin(){
        $films = Film::with('genres',"attribute",'stok')->get();
        return view('admin/index',['films'=>$films]);
    }

    public function add(){
        $genre = Genre::all(['id','genre_name']);
        return view('movie/movie_add',['genres'=>$genre]);
    }
    public function save(Request $request){
        if(isset($request->id)){
            $film = Film::find($request->id);
        }else{
            $film = new Film();
            // $attribute = new Attribute();
        }
        $film->title = $request->title;
        $film->director = $request->director;
        $film->duration = $request->duration;
        $film->release_date = $request->release_date;
        $film->sinopsis = $request->sinopsis;
        $film->save();
        $film->genres()->sync($request->genres,['film_id'=>$film->id]);

        if(isset($request->id)){
            return redirect('/admin');
        }
        return redirect('/movie/add/again');
    }
    public function formAttr(){
        $film = Film::get(['id','title']);
        return view('movie/movie_attribute',["films"=>$film]);
    }
    // public function updateForm(string $id){
    //     $film = Film::with('genres')->find($id);
    //     return view('admin/form_update',["films" => $film]);
    // }
  
    public function attrAdd(Request $request){
        if(isset($request->id)){
            $attribute = Detail::find($request->id);
        }else{
            $attribute = new Detail();
        }
        $attribute->film_id = $request->films;

        if($request->hasFile('video')){
        $video = $request->file('video');
        $filename = time(). '.' . $video->getClientOriginalExtension();
        $destinationPath = public_path('videos');
        $video->move($destinationPath, $filename);
        $attribute->trailer = $filename;
        } 
        if ($request->hasFile('photo')) {
        $photo = $request->file('photo');
        $filename = time(). '.' . $photo->getClientOriginalExtension();
        $destinationPath = public_path('photos');
        $photo->move($destinationPath, $filename);
        $attribute->poster = $filename;
        }
        if ($request->hasFile('thumbnail')) {
        $thumbnail = $request->file('thumbnail');
        $filename = time(). '.' . $thumbnail->getClientOriginalExtension();
        $destinationPath = public_path('thumbnails');
        $thumbnail->move($destinationPath, $filename);
        $attribute->thumbnail = $filename;
        }
        $attribute->save();
        return redirect('/admin');    
    }

    public function update(string $id){
        $film = Film::find($id);
        $genres = Genre::all(['id','genre_name']);
        return view('movie/movie_add',['film'=>$film,'genres'=>$genres]);
    }

    public function show(string $id){
        $film = Film::with(['genres','attribute','stok'])->find($id);
        return view('user/movie_detail',["films"=>$film]);
    }
    
    public function delete(Request $request) {
        if ($request->method() == "POST") {
            $film = Film::find($request->id)->delete();
            return redirect("/admin");
        } else {
            $film= DB::table("films")->find($request->id);
            return view("movie/movie_delete", ["film" => $film]);
        }
    }

    

    
    

}
