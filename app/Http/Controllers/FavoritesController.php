<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Micropost;

class FavoritesController extends Controller
{
    //
    public function store($id)
    {
        // 認証済みユーザ（閲覧者）が、 idのポストをお気に入りする
        \Auth::user()->favorite($id);
        // 前のURLへリダイレクトさせる
        return back();
    }
    
    public function destroy($id)
    {
        // 認証済みユーザ（閲覧者）が、 idのポストをお気に入りから削除
        \Auth::user()->unfavorite($id);
        // 前のURLへリダイレクトさせる
        return back();
    }
}
