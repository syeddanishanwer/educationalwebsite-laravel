<style>
.active{

background-color: orange;

}

</style>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{Route::is('homepage') ? 'active' : '' }}" aria-current="page" href="{{ route('homepage') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{Route::is('aboutpage') ? 'active' : '' }}" href="{{ route('aboutpage') }}">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  {{Route::is('contactpage') ? 'active' : '' }}" href="{{ route('contactpage') }}">Contact Us</a>
                </li>

            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
