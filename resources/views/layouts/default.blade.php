 
<!doctype html>
<html lang="fr">
    <head>

        <title>THOLDI</title>
        <!-- Bootstrap core CSS & JS -->

        <!--javascript before bootstrap-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

        <link href="{!! asset('bootstrap4.3/css/bootstrap.min.css') !!}" rel="stylesheet">
        <script src="{!! asset('bootstrap4.3/js/bootstrap.min.js') !!}" ></script>
        <script src="{!! asset('bootstrap4.3/js/bootstrap.bundle.min.js') !!}" ></script>



        <!-- Custom JS -->
        <script src="js/customTholdi.js"></script>


        <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    </head>
    <body> 
        <br>
        <div class="row justify-content-md-center">
            <div class="col-lg-3">
                <img src="{{ asset('images/logo_tholdi.png')}}" class="img-fluid rounded-pill border border-success " alt="Responsive image">
            </div>
        </div>
        <br>
        <nav class="navbar navbar-expand-lg  navbar-dark bg-dark ">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li>

                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route("PageAccueil") }}">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    @if (session()->exists('connected'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Réservation
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route("ConsultationReservations")}}">Consulter vos réservations </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route("SaisirReservation")}}">Effectuer une réservation</a>
                            <a class="dropdown-item" href="">Annuler une réservation</a>


                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Devis
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('ConsulterDevis')}}">Consulter vos Devis</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Supprimer un devis</a>



                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Tableau de Bord
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="">Nombre de réservations (par mois)</a>
                            <a class="dropdown-item" href="">Répartition géographique (par lieu de mise à disposition)</a>
                        </div>

                    </li>
                    @endif
                    <!--                    <li class="nav-item">
                                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                                        </li>-->
                </ul>

                @if (!session()->exists('connected'))
                <form action="{{route('AuthentificationCompteUtilisateur')}}" method="post" class="form-inline my-2 my-lg-0">
                    {{ csrf_field() }}                                       
                    <input class="form-control mr-sm-2" type="text" name="identifiant" id="identifiant" placeholder="Identifiant" aria-label="Identifiant">
                    <input type="password" class="form-control mr-sm-2" name="motDePasse" id="motDePasse" placeholder="Mot de Passe" aria-label="Mot de Passe">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Connexion</button>
                </form>
                @else
                <div>


                    <a href="">
                        <img src="{{ asset('images/logo_personne.jpeg')}} " style="height: 60px" class="img-fluid rounded-pill border border-success " alt="Responsive image" data-toggle="tooltip" data-placement="bottom" title="Déconnection">
                    </a>


                </div>
                @endif
            </div>
        </nav>

        <br>
        <div class="container ">

            <h1 class="display-4">@yield("title")</h1>
            <p class="lead"> 
                @yield("content")
            </p>
        </div>








    </body>
</html>