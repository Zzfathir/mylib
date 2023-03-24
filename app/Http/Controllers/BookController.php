<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\DetailBookResource;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index() {
        $books = Book::all();

        return BookResource::collection($books);
    }

    public function show($id) {
        $book = Book::with('pustakawans:id,name','borrows:id,name')->findOrFail($id);
        return new DetailBookResource($book);
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
        ]);

        $cover = null;

        if($request->file) {
            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();

            $cover = $fileName.'.'.$extension;
            Storage::putFileAs('cover', $request->file, $cover);
        }

        $request['cover'] = $cover;
        $request['pustakawan'] = Auth::user()->id;

        $book = Book::create($request->all());
        return new DetailBookResource($book->loadMissing('pustakawans:id,name'));
    }


    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
        ]);

        $cover = null;

        if($request->file) {
            $fileName = $this->generateRandomString();
            $extension = $request->file->extension();

            $cover = $fileName.'.'.$extension;
            Storage::putFileAs('cover', $request->file, $cover);
        }

        $request['cover'] = $cover;


        $book = Book::findOrFail($id);
        $book->update($request->all());

        // return response()->json('sudah diubah');
        return new DetailBookResource($book->loadMissing('pustakawans:id,name'));
    }

    public function delete($id) {
        $post = Book::findOrFail($id);
        $post->delete();

        return response()->json([
            'messege' => 'Buku Sudah Di Hapus'
        ]);
    }

    public function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}
