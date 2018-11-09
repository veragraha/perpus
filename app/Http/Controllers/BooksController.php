<?php

namespace App\Http\Controllers;

use App\Book;
use App\Borrowlog;
use Illuminate\Http\Request;    
use App\Exceptions\BookException;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BooksController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = Book::with('author');
        $data= Book::paginate(3);
        return view('books.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $requestData=$request->all();
        // dd($requestData);
        $requestData['cover']=md5(time()) . '.' . $request->file('cover')->getClientOriginalExtension();
        $book = Book::create($requestData);
        // isi field cover jika ada cover yang diupload
        // dd($book);

        if ($request->hasFile('cover')) {
        // Mengambil file yang diupload

        $uploaded_cover = $request->file('cover');
        // mengambil extension file
        $extension = $uploaded_cover->getClientOriginalExtension();

        // membuat nama file random berikut extension
        $filename = md5(time()) . '.' . $extension;

        // menyimpan cover ke folder public/img
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        $uploaded_cover->move($destinationPath, $filename);
        // mengisi field cover di book dengan filename yang baru dibuat
        $book->cover = $filename;
        $book->save();
        }

        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan $book->title"

        ]);

        return redirect()->route('books.index');

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
        $book = Book::find($id);
        return view('books.edit')->with(compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookRequest $request, $id)
    {
                $this->validate($request, [
        'title' => 'required|unique:books,title,' . $id,
        'author_id' => 'required|exists:authors,id',
        'amount' => 'required|numeric',
        'cover' => 'image|max:2048'
        ]);
        $book = Book::find($id);
        if(!$book->update($request->all())) return redirect()->back();
        if ($request->hasFile('cover')) {

     // menambil cover yang diupload berikut ekstensinya
         $filename = null;
        $uploaded_cover = $request->file('cover');
        $extension = $uploaded_cover->getClientOriginalExtension();

     // membuat nama file random dengan extension
        $filename = md5(time()) . '.' . $extension;
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';

      // memindahkan file ke folder public/img
        $uploaded_cover->move($destinationPath, $filename);

      // hapus cover lama, jika ada
        if ($book->cover) {
        $old_cover = $book->cover;
        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
        . DIRECTORY_SEPARATOR . $book->cover;
        try {
        File::delete($filepath);
        } catch (FileNotFoundException $e) {
      // File sudah dihapus/tidak ada
        }
        }

     // ganti field cover dengan cover yang baru
        $book->cover = $filename;
        $book->save();
        }
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan $book->title"
        ]);
        return redirect()->route('books.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $cover = $book->cover;
        if(!$book->delete()) return redirect()->back();
    // hapus cover lama, jika ada
        if ($cover) {
        $old_cover = $book->cover;
        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
        . DIRECTORY_SEPARATOR . $book->cover;
        try {
        File::delete($filepath);
        } catch (FileNotFoundException $e) {
    // File sudah dihapus/tidak ada
}
}
    Session::flash("flash_notification", [
    "level"=>"success",
    "message"=>"Buku berhasil dihapus"
    ]);
    return redirect()->route('books.index');
    }
    public function borrow($id)
    {
        try {
        $book = Book::findOrFail($id);
        Auth::user()->borrow($book);
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil meminjam $book->title"
    ]);
    } catch (BookException $e) {
        Session::flash("flash_notification", [
            "level"=>"danger",
            "message"=> $e->getMessage()
    ]);
    }
        return redirect('/');
    }
    public function returnBack($book_id)
{
    $borrowLog = BorrowLog::where('user_id', Auth::user()->id)
    ->where('book_id', $book_id)
    ->where('is_returned', 0)
    ->first();
    if ($borrowLog) {
    $borrowLog->is_returned = true;
    $borrowLog->save();
    Session::flash("flash_notification", [
    "level" => "success",
    "message" => "Berhasil mengembalikan " . $borrowLog->book->title
    ]);
}
return redirect('/home');
}


}
