<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
Use App\Http\Requests;
Use Laratrust\LaratrustFacade 
as Laratrust;

class GuestController extends Controller
{
   	 public function index(Request $request)
	{
		$books = Book::with('author');
		$data = Book::paginate(3);
		return view('guest.index',compact('data'));
	}
}