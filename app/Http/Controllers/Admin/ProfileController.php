<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
      $cond_name = $request->cond_name;
      if ($cond_name != '') {
          // 検索されたら検索結果を取得する
          $posts = Profile::where('name', $cond_name)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
    }
  
    public function add()
    {
        return view('admin.profile.create');
    }


    public function edit(Request $request)
    {
        //dd($request);
        $profile = Profile::find($request->id);
        if (empty($profile)) {
        abort(404);    
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }

    public function update(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $profile = Profile::find($request->id);
        $profile_form = $request->all();
        
        unset($profile_form['_token']);
        
        $profile->fill($profile_form)->save();
        
        $profile_history = new ProfileHistory();
        $profile_history->profile_id = $profile->id;
        $profile_history->edited_at = Carbon::now();//carbon::now()は現在時刻
        $profile_history->save();
        return redirect('admin/profile');
    }
    
    
     public function create(Request $request)
     {
      $this->validate($request, Profile::$rules);//必要なもの値する、$rulesはProfile.phpの10行目から出てきた
      $profile = new Profile;
      $form = $request->all();//項目に全部入力されたらおｋ
      
     unset($form['_token']);
      
      $profile->fill($form);//全部取ってきたものを入れる
 
      $profile->save();//保存
       return redirect('admin/profile');
    }

    public function delete(Request $request)
    {
      // 該当するNews Modelを取得
      $profile = Profile::find($request->id);
      // 削除す      $news->delete();
      return redirect('admin/profile');
    }
}
