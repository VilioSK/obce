<header class="row">
    <div class="col mb-7">
        <img src="{{ asset('logo.jpg') }}" alt="tag">
    </div>
    <div class="col mb-3 text-end">
        <a class="" href="#">
            Kontakty a čísla na oddelenia
        </a>
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                EN
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">SK</a>
                <a class="dropdown-item" href="#">DE</a>
            </div>
        </div>
    </div>
    <div class="col mb-2">
        <form class="d-flex">
            <div class="input-group">
                <input class="form-control" type="search" placeholder="Vyhľadať" aria-label="Search" aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>                                    
            </div>
            <button class="btn btn-success" type="submit">Prihlásenie</button>
        </form>         
    </div>
</header>