<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\DetailBookResource;
use App\Models\Book;
use Illuminate\Http\Request;

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


}
