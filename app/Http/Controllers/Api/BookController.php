<?php

namespace App\Http\Controllers\Api;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Book::orderBy('title', 'asc')->get();
        return response()->json([
            'status'=>true,
            'message'=>'Data ditemukan',
            'data'=>$data
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataBuku = new Book;

        $rules = [
            'title' => 'required',
            'author' => 'required',
            'publication_date' => 'required|date'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status'=>false,
                'massage'=>'Gagal memasukkan data',
                'data'=>$validator->errors()
            ]);
        }

        $dataBuku->title = $request->title;
        $dataBuku->author = $request->author;
        $dataBuku->publication_date = $request->publication_date;

        $post = $dataBuku->save();

        return response()->json([
            'status'=> true,
            'message' => 'Sukses memasukam data'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Book::find($id);
        if ($data) {
            return response()->json([
                'status'=>true,
                'message'=>'Data Ditemukan',
                'data'=>$data,
            ],200);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => $data
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataBuku = Book::find($id);

        if (empty($dataBuku)) {
            return response()->json([
                'status' => false,
                'message'=> 'Data tidak ditemukan',
            ], 404);
        }

        $rules = [
            'title' => 'required',
            'author' => 'required',
            'publication_date' => 'required|date'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response()->json([
                'status'=>false,
                'massage'=>'Gagal update data',
                'data'=>$validator->errors()
            ]);
        }

        $dataBuku->title = $request->title;
        $dataBuku->author = $request->author;
        $dataBuku->publication_date = $request->publication_date;

        $post = $dataBuku->save();

        return response()->json([
            'status'=> true,
            'message' => 'Sukses update data'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataBuku = Book::find($id);

        if (empty($dataBuku)) {
            return response()->json([
                'status' => false,
                'message'=> 'Data tidak ditemukan',
            ], 404);
        }

        $post = $dataBuku->delete();

        return response()->json([
            'status'=> true,
            'message' => 'Sukses delete data'
        ]);
    }
}
