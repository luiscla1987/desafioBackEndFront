<?php

namespace App\Http\Controllers\Api;

use App\Models\Movie;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequest;
use App\Http\Resources\MovieCollection;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function __construct(Movie $movie)
    {
        $this->movie = $movie;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $movies = $this->movie;

        if ($request->has('conditions')) {

            $expressions = explode(';', $request->get('conditions'));

            foreach ($expressions as $e) {
                $exp = explode(':', $e);
                $movies = $movies->where($exp[0], $exp[1], $exp[2]);
            }
        }

        if ($request->has('fields')) {
            $fields = $request->get('fields');
            $movies = $movies->selectRaw($fields);
        }



        return new MovieCollection($movies->paginate(9), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        $data = $request->all();
        $movie = $this->movie->create($data);
        return response()->json($movie);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = $this->movie->find($id);
        return response()->json($movie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
        $movie = $this->movie->find($data['id']);
        $movie->update($data);
        return response()->json($movie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = $this->movie->find($id);
        $movie->delete();

        return response()->json(['data' => ['msg' => 'Deleted successfully']]);
    }
}
