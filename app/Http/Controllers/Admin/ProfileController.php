<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;

class ProfileController extends Controller
{
    public function add()
    {
        return view('admin.profile.create');
    }


    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update()
    {
        return redirect('admin/profile/edit');
    }
     public function create(Request $request)
  {
      $this->validate($request, Profile::$rules);//必要なもの値する、$rulesはProfile.phpの10行目から出てきた
      $profile = new Profile;
      $form = $request->all();//項目に全部入力されたらおｋ
      
     unset($form['_token']);
      
      $profile->fill($form);//全部取ってきたものを入れる
 
      $profile->save();//保存
       return redirect('admin/profile/create');
}
}