<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\MessageException;
use App\Http\Controllers\Controller;
use App\Http\Message\MessageResponse;
use App\Meta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $metas = Meta::with(['producto'])->orderBy('id', 'desc')->get();
            return response(['data' => $metas, 'message' => MessageResponse::GET_OK]);
        } catch (\Throwable $th) {
            return response(['message' => MessageException::DB_GETDATA, 'error' => $th], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
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
    public function store(Request $request)
    {
        try {
            $meta = Meta::where([['mes', $request->mes], ['year', $request->year], ['producto_id', $request->producto_id]])->first();
            if ($meta) return response(['message' => MessageException::DB_EXIST], Response::HTTP_BAD_REQUEST);
            $meta = Meta::create($request->all());
            return response(['data' => $meta, 'message' => MessageResponse::SAVE_OK]);
        } catch (\Throwable $th) {
            return response(['message' => MessageException::DB_SAVEDATA, 'error' => $th], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
            $res = Meta::findOrFail($id)->delete();
            return response(['data' => $res, 'message' => MessageResponse::DELETE_OK]);
        } catch (\Throwable $th) {
            return response(['message' => MessageException::DB_DELETEDATA, 'error' => $th], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
