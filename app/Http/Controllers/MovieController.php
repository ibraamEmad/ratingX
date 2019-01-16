<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\movie;
use App\User;
use Illuminate\Http\Request;
use Google\Cloud\Speech\SpeechClient;

class MovieController extends Controller
{
    var $output;
    public function __construct()
    {
       $this->middleware('auth');
    //   $this->middleware('SystemAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // shell_exec("python ../face-detection/code.py");
        
      //echo getcwd();
        $movies= movie::all();


        return view('movies.index')-> with('movies',$movies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    
        ]);

        $movie=new movie;

        $movie ->name=$request->input('name');
        $movie ->description=$request->input('description');
        $movie ->genre=$request->input('genre');
        $movie ->releaseDate=$request->input('releaseDate');
        $logo = $request->file('image');
        $input['imagename'] = time().'.'.$logo->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $logo->move($destinationPath, $input['imagename']);
        $imagePath=$input['imagename'];
        $movie ->image=$imagePath;
        $movie->save();
        return redirect('/movie');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(movie $movie)
    {
        //
    }


    public function count(){
        $movies= movie::all();
        $noOfMovies=count($movies);
        return response()->json($noOfMovies);
    }


    public function rate( movie $movie, $rate)
    {

        $user = \Auth::user();
        $id = \Auth::user()->id;
        $movies=$user->movies;
       

         $rating2=$rate;
         $rating=floatval($rating2);
       //  return response()->json($rating2);

        // $x=in_array($movie,$user->movies);
         $unique_objects = array();

// $data represents your object collection
    foreach ($movies as $moviel) {
      if (!in_array($moviel->name, $unique_objects)) {
            $unique_objects[$moviel->id] = $moviel->name;
        }
    }
    //return response()->json(in_array($movie->name,$unique_objects));

        if(in_array($movie->name,$unique_objects)){
            return response()->json("you have already rated this movie");
        }
       
        else{

            $newRating=(($movie->rate*$movie->numberOfRating)+$rating)/($movie->numberOfRating+1);
           // return response()->json((($movie->rate*$movie->numberOfRating)+$rating)/($movie->numberOfRating+1));

            $movie->rate=$newRating;
            $movie->numberOfRating=$movie->numberOfRating+1;
            $movie->users()->attach([$id]);
            $movie->save();
        }
     
        
    }

    public function search($search)
    {
      //  $search=$request->input('search');
      $movies= movie::all();
      $results= movie::where('name', 'LIKE', '%'. $search .'%')->get();
         $noOfMovies=count($movies);
        return response()->json([ $results,$noOfMovies]
        );
    //    return view('restaurants.index')-> with('restaurants',$results);
    }

    public function toText(){
        $speech = new SpeechClient([
            'languageCode' => 'en-US'
        ]);
        
        // Recognize the speech in an audio file.
        $results = $speech->recognize(
            fopen(__DIR__ . '/audio_sample.flac', 'r')
        );
        
        foreach ($results as $result) {
            echo $result->topAlternative()['transcript'] . "\n";
        }
    }

}
