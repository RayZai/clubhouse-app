<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        
        $memberList = Member::all();

        return view('home', [ "members" => $memberList]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('member.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        unset($data['_token']);
        $validator=Validator::make($data,[
            'name'=>'required',
            'email'=>'required|email|unique:members,email',
            'phoneNumber'=>'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Member::create($data);

        return redirect()->route('index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
        return view('member.edit',['member'=>$member]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
        $data = $request->all();
        unset($data['_token']);
        $validator=Validator::make($data,[
            'name'=>'required',
            'email'=>'required|email|unique:members,email,'.$member->id,
            'phoneNumber'=>'required'
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($data as $k => $v) {
            if (!is_null($v)) {
                $member[$k] = $v;
            }
        }

        $member->save();

        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deactivate(Member $member)
    {
        //
        if($member->active){
            $member->active = 0;
            $member->dateDeactivated = Carbon::now();
            $member->save();
        }else{
            $member->active = 1;
            $member->dateDeactivated = NULL;
            $member->save();
        }

        return redirect()->back();
    }
}
