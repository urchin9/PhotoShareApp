<ul class="nav nav-tabs nav-fill">
    <li class="nav-item">
        <a class="nav-link mypage-navtab {{ Request::is('myphotos') ? 'active' : '' }}" href="/myphotos">MyPhotos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link mypage-navtab {{ Request::is('favorites') ? 'active' : '' }}" href="/favorites">Favorites</a>
    </li>
</ul>