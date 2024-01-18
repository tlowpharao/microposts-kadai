@if (Auth::user()->is_liking($favorite->id))
    <!--お気に入りから削除ボタンのフォーム-->
    <form method="POST" action="{{ route('favorites.unfavorite', $favorite->id) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-outline btn-warning btn-sm normal-case" 
            onclick="return confirm('id = {{ $favorite->id }} をお気に入りから削除します。よろしいですか？')">Unfavorite</button>
    </form>
@else
        !--お気に入り追加ボタンのフォーム-->
        form method="POST" action="{{ route('favorites.favorite', $favorite->id) }}">
        @csrf
        <button type="submit" class="btn btn-success btn-sm normal-case">Favorite</button>
    </form>
@endif
