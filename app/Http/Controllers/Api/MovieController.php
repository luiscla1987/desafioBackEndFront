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
        try {
            $movie = $this->movie->create($data);

            /* if (isset($data['stars']) && count($data['stars'])) {
                $movie->stars()->sync($data['stars']);
            } */

            return response()->json([
                'data' => [
                    'msg' => 'Succesfully Data Saved'
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $movie = $this->movie->findOrFail($id);

            return response()->json(
                [
                    'data' => $movie
                ]
            );
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        };
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
    public function update($id, MovieRequest $request)
    {
        $data = $request->all();
        try {
            $movie = $this->movie->findOrFail($id);
            $movie->update($data);

            /* if (isset($data['stars']) && count($data['stars'])) {
                $movie->stars()->sync($data['stars']);
            } */

            return response()->json([
                'data' => [
                    'msg' => 'Succesfully Data Updated'
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $movie = $this->movie->findOrFail($id);
            $movie->delete();

            return response()->json([
                'data' => [
                    'msg' => 'Succesfully Data Deleted'
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        };
    }
}
