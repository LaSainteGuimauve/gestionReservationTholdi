@extends('layouts.default')
@section('title')
<h1> Liste de vos réservations </h1>
@endsection
@section('content')
@if (count($collectionReservationEtLigneDeReservation)>0)
@foreach ($collectionReservationEtLigneDeReservation as 
$reservationCourante)
<div class="col-md-9">
    <div class="card "> 
        <div class="card-header bg-info">
            <h4>
                RESERVATION NUMERO : {{current($reservationCourante)->numeroDeReservation}}
            </h4>
            <h6>
                EFFECTUEE LE : {{ date('d/m/Y', current($reservationCourante)->dateReservation) }}<br>
            </h6>
            @if (current($reservationCourante)->etat=="enCours")
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger float-right" datatoggle="modal" data-target="#a{{current($reservationCourante)->numeroDeReservation}}">
                Confirmer la réservation
            </button>
            <!-- Modal -->
            <div class="modal fade" id="a{{current($reservationCourante)->numeroDeReservation}}" tabindex="-1" role="dialog" arialabelledby="confirmerReservationModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title "
                                id="exampleModalLabel">Confirmation</h5>
                            <button type="button" class="close" datadismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Souhaitez-vous <bold>confirmer</bold> la 
                            réservation N° {{current($reservationCourante)->numeroDeReservation}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <form action="{{ route('ConfirmerReservation') }}" method="post">
                                {{ csrf_field() }}
                                PHILIPPE VIGNARD 14
                                <input type="hidden" name="codeReservation"
                                       value="{{current($reservationCourante)->codeReservation}}">
                                <button class="btn btn-primary" type="submit">Confirmer la réservation</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <h2><span class="badge float-right btn-secondary">Réservation 
                    Confirmée </span></h2>
            @endif
        </div>
        <div class="card-body ">
            <p>
                MISE A DISPOSITION :
                {{ current($reservationCourante)->villeDepart }} le {{ date('d/m/Y', current($reservationCourante)->dateDebutReservation)}}
                <br>
                RESTITUTION :
                {{ current($reservationCourante)->villeArrivee }} le {{ date('d/m/Y', current($reservationCourante)->dateFinReservation) }}
            </p>
            <table class="table table-sm table-striped"> 
                <thead class="thead-dark ">
                    <tr>
                        <th>Type de container</th>
                        <th>Quantité</th>
                    </tr>
                    @foreach ($reservationCourante as $ligneDeReservation)
                    <tr>
                        <td>{{ $ligneDeReservation->libelleTypeContainer}}</td>
                        <td>{{ $ligneDeReservation->qteReserver}}</td>
                    </tr> 
                    @endforeach
            </table>
        </div>
    </div>
    <br>
</div>
@endforeach
@endif
@endsection