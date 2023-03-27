<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\BorrowResource;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function store(Request $request) {

        $request->validate([
            'book_id' => 'required|exists:books,id',
            'name' => 'required'
        ]);

        $request['user_id'] = auth()->user()->id;
        $borrow = Borrow::create($request->all());

        return new BorrowResource($borrow->loadMissing(['borrower:id,name']));
    }

    public function delete($id) {
        $borrow = Borrow::findOrFail($id);
        $borrow->delete();

        return new BorrowResource($borrow->loadMissing('borrower:id,name'));
    }
}
