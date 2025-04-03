<nav
    {{ $attributes->merge([
        'class' => "navbar" . (isset($fixed) ? ' is-fixed-' . (isset($position) ? $position : 'top') : '')
    ]) }}
    role="{{ $role }}"
    aria-label="{{ $ariaLabel }}"
>
    {{-- TODO : Créer espace admin pour pouvoir ajouter / supprimer des routes --}}
    <div class="navbar-brand">
        <a class="navbar-item" href="{{ route('index') }}">Agence</a>
        <div x-data="darkmodHandler" class="navbar-item">
            <button x-on:click="changeMod($event)" class="switch-light"><i class="fas fa-moon"></i></button>
        </div>

        <button type="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navMenu">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navMenu" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="{{ route('property.index') }}">Nos biens</a>

            @if(Auth::user())
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">Dashboard</a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item" href="{{ route('admin.property.index') }}">Gestion des biens</a>
                        <a class="navbar-item" href="{{ route('admin.option.index') }}">Gestion des options</a>
                    </div>
                </div>
            @endif
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="buttons">
                    <a class="button" href="{{ Auth::user() ? route('auth.logout') : route('auth.login') }}">{{ Auth::user() ? 'Se déconnecter' : 'Se connecter' }}</a>
                </div>
            </div>
        </div>
    </div>
</nav>