@extends('layouts.app')

@section('content')
    <div class="sm:grid sm:grid-cols-3 sm:gap-10">
        <aside class="mt-4">
            {{-- ユーザ情報 --}}
            @include('users.card')
        </aside>
        <div class="sm:col-span-2 mt-4">
            {{-- タブ --}}
            @include('users.navtabs')
            <div class="mt-4">
                @if (isset($favorites))
                    <ul class="list-none">
                        @foreach ($favorites as $favorite)
                            <li class="flex items-start gap-x-2 mb-4">
                                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                                <div class="avatar">
                                    <div class="w-12 rounded">
                                        <img src="{{ Gravatar::get($favorite->user->email) }}" alt="" />
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                                        <a class="link link-hover text-info" href="{{ route('users.show', $favorite->user->id) }}">{{ $favorite->user->name }}</a>
                                        <span class="text-muted text-gray-500">posted at {{ $favorite->created_at }}</span>
                                    </div>
                                    <div>
                                        {{-- 投稿内容 --}}
                                        <p class="mb-0">{!! nl2br(e($favorite->content)) !!}</p>
                                    </div>
                                    <!--ボタン類-->
                                    <div class="flex mt-2">
                                        {{-- お気に入りボタン --}}
                                        @include('add_favorite.favorite_button')
                                        <div>
                                            @if (Auth::id() == $favorite->user_id)
                                                {{-- 投稿削除ボタンのフォーム --}}
                                                <form method="POST" action="{{ route('microposts.destroy', $favorite->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-error btn-sm normal-case" 
                                                        onclick="return confirm('Delete id = {{ $favorite->id }} の投稿を削除しますか?')">Delete</button>
                                            　　</form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    {{-- ページネーションのリンク --}}
                    {{ $favorites->links() }}
                @endif
            </div>
        </div>
    </div>
@endsection