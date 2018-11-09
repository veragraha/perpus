<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Http\Requests\StoreMemberRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;    
use App\Http\Requests\UpdateMemberRequest;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::paginate(3);
        return view('members.index',compact('data'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberRequest $request)
    {
                $password = str_random(6);
        $data = $request->all();
        $data['password'] = bcrypt($password);
        // bypass verifikasi
        $data['is_verified'] = 1;
        $member = User::create($data);
        // set role
        $memberRole = Role::where('name', 'member')->first();
        $member->attachRole($memberRole);
        // kirim email
        Mail::send('auth.emails.invite', compact('member', 'password'), function ($m) use ($member) {
        $m->to($member->email, $member->name)->subject('Anda telah didaftarkan di Larapus!');
        });
        Session::flash("flash_notification", [
        "level" => "success",
        "message" => "Berhasil menyimpan member dengan email " .
        "<strong>" . $data['email'] . "</strong>" .
        " dan password <strong>" . $password . "</strong>."
        ]);
        return redirect()->route('members.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = User::find($id);
        return view('members.show')->with(compact('member'));
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
    public function update(UpdateMemberRequest $request, $id)
    {
                $member = User::find($id);
        $member->update($request->only('name','email'));
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan $member->name"
        ]);
        return redirect()->route('members.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                $member = User::find($id);
        if ($member->hasRole('member')) {
        $member->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Member berhasil dihapus"
        ]);
        }
        return redirect()->route('members.index');
    }

}