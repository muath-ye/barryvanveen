<header>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('home') }}">
                    @if($is_admin)
                        Beheeromgeving
                    @else
                        Barry van Veen
                    @endif</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                @if($is_admin)
                    {{ $AdminNav->asUl( ['class' => 'nav navbar-nav'] ) }}
                    <p class="navbar-text navbar-right">Ingelogd als {{ $current_user->full_name }}. <a href="{{ route('admin.logout') }}">Uitloggen</a>.</p>
                @else
                    {{ $MainNav->asUl( ['class' => 'nav navbar-nav'] ) }}
                @endif
            </div>

        </div>
    </nav>
</header>