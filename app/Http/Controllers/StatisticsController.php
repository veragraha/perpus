<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Borrowlog;
Use App\Book;

class StatisticsController extends Controller
{
    public function index(Request $Request){
    	$statistics = Borrowlog::with('book');
    	$statistics = Borrowlog::with('user');
    	$data = Borrowlog::paginate(3);
    	return view('statistics.index',compact('data'));
    }
}
