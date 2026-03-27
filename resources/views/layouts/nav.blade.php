<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
            <a class="navbar-brand d-lg-none strip-right" href="#">
                <h1 class="mb-0 main-title">JAMES MYHILL</h1>
                <h5>Composer</h5>
            </a>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand d-none d-lg-block" href="/#">
            <h1 class="mb-0 main-title">JAMES MYHILL</h1>
            <h5>Composer</h5>
        </a>
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link {{ Request::path() !== 'playlists' ? 'active': '' }}" aria-current="page" href="/#" id="intro">Intro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/#" id="goto-latest">Latest</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/#" id="goto-selected-compositions">Selected Compositions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/#" id="goto-portfolio">Portfolio / Credits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::path() === 'playlists' ? 'active': '' }}" href="/playlists">Curated Playlists</a>
            </li>
        </ul>
        </div>
    </div>
</nav>
