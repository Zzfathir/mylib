<?php

namespace App\Http\Middleware;

use App\Models\Book;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Pustakawan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $UserNow = Auth::user();
        $book = Book::findOrFail($request->id);

        if($book->pustakawan != $UserNow->id) {
            return response()->json([
                'messege' => 'harus pustakawan'
            ], 404);
        }


        return $next($request);
    }
}
