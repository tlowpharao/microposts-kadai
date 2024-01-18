<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;                        // 追加
use App\Models\User;
use App\Models\Micropost;


class UsersController extends Controller
{
    //
    public function index()                                 // 追加       
    {                                                       // 追加
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(5); // 追加

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [                        // 追加
            'users' => $users,                              // 追加
        ]);                                                 // 追加
    }
    public function show($id)                               // 追加
    {                                                       // 追加
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザーの投稿一覧を作成日時の降順で取得
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(3);

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'microposts' => $microposts,
        ]);
        
    }
    
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(3);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }
    
    /**
     * ユーザのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(3);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
    // お気に入りの投稿取得
    public function favorites($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのお気に入り投稿一覧を取得
        $favorites = $user->favorites()->paginate(3);

        // フォロー一覧ビューでそれらを表示
        return view('users.favorites', [
            'user' => $user,
            'favorites' => $favorites,
        ]);
    }
    
}
