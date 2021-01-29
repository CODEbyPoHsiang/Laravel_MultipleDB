<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\User2;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        $user2= User2::all();
        return (['db1'=>$user,'db2'=>$user2]);
    }

    public function update(Request $request, $name)
    {
        $user = User::find($name);
        $user2= User2::find($name);

        // 逐欄方式新增
        $user->email = $request->email;
        $user2->note = $request->email;
        $user->save();
        $user2->save();

        //使用ORM方式編輯
        //使用ORM方式編輯，必須兩張表都有欄位才能正確寫入，如果要給值的欄位只有一張表才有，使用QRM方式編輯會報錯
        // $user->update($request->all());
        // $user2->update($request->all());


        return (['db1'=>$user,'db2'=>$user2]);
    }

    public function store(Request $request)
    {
        //使用ORM方式新增
        //使用ORM方式新增，必須兩張表都有欄位才能正確寫入，如果要給值的欄位只有一張表才有，使用QRM方式新增會報錯
        $user= User::create($request->all());
        $user2= User2::create($request->all());
        return (['db1'=>$user,'db2'=>$user2]);
    }
    public function destroy(Request $request, $name)
    {
        $user= User::destroy($name);
        $user2= User2::destroy($name);
        return (['db1'=>"ok",'db2'=>"ok"]);
    }
}