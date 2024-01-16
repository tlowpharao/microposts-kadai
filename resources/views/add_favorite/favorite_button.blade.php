@if (Auth::id() != $user->id)
    @if (Auth::user()->is_liking($microposts->id))
        <!--お気に入りから削除ボタンのフォーム-->
        <form method="POST" action="{{ route('favorites.unfavorite', $microposts->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error btn-block normal-case" 
                onclick="return confirm('id = {{ $microposts->id }} をお気に入りから削除します。よろしいですか？')">Unfavorite</button>
        </form>
    @else
        <!--お気に入り追加ボタンのフォーム-->
        <form method="POST" action="{{ route('favorites.favorite', $microposts->id) }}">
            @csrf
            <button type="submit" class="btn btn-primary btn-block normal-case">Favorite</button>
        </form>
    @endif
@endif


