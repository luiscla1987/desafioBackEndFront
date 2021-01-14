<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StarRequest;
use App\Models\Star;

class StarController extends Controller
{
    private $star;

    public function __construct(Star $star)
    {
        $this->star = $star;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $star = $this->star->paginate('4');

        return response()->json($star, 200);
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
    public function store(StarRequest $request)
    {
        $data = $request->all();
        try {
            $star = $this->star->create($data);

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
            $star = $this->star->findOrFail($id);

            return response()->json(
                [
                    'data' => $star
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, StarRequest $request)
    {
        $data = $request->all();
        try {
            $star = $this->star->findOrFail($id);
            $star->update($data);

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
            $star = $this->star->findOrFail($id);
            $star->delete();

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
