<div class="mt-4">
    @if (isset($microposts))
        <ul class="list-none">
            @foreach ($microposts as $micropost)
                <li class="flex items-start gap-x-2 mb-4">
                    {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                    <div class="avatar">
                        <div class="w-12 rounded">
                            <img src="{{ Gravatar::get($micropost->user->email) }}" alt="" />
                        </div>
                    </div>
                    <div>
                        <div>
                            {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                            <a class="link link-hover text-info" href="{{ route('users.show', $micropost->user->id) }}">{{ $micropost->user->name }}</a>
                            <span class="text-muted text-gray-500">posted at {{ $micropost->created_at }}</span>
                        </div>
                        <div>
                            {{-- 投稿内容 --}}
                            <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                        </div>
                        
                        <div class="flex mt-2">
                        {{-- お気に入りボタン --}}
                        <div>
                            @if (Auth::user()->is_liking($micropost->id))
                                <!--お気に入りから削除ボタンのフォーム-->
                                <form method="POST" action="{{ route('favorites.unfavorite', $micropost->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline btn-warning btn-sm normal-case" 
                                        onclick="return confirm('id = {{ $micropost->id }} をお気に入りから削除します。よろしいですか？')">Unfavorite</button>
                                </form>
                            @else
                                    <!--お気に入り追加ボタンのフォーム-->
                                <form method="POST" action="{{ route('favorites.favorite', $micropost->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-outline btn-success btn-sm normal-case">Favorite</button>
                                </form>
                            @endif

                        </div>
                        <!--投稿削除-->
                        <div>
                            @if (Auth::id() == $micropost->user_id)
                                {{-- 投稿削除ボタンのフォーム --}}
                                <form method="POST" action="{{ route('microposts.destroy', $micropost->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm normal-case" 
                                        onclick="return confirm('Delete id = {{ $micropost->id }} ?')">Delete</button>
                                </form>
                            @endif
                        </div>
                        </div>
                        
                        
                    </div>
                </li>
            @endforeach
        </ul>
        {{-- ページネーションのリンク --}}
        {{ $microposts->links() }}
    @endif
</div>