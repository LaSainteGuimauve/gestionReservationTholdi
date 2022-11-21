@extends('layouts.default')
@section('title')
<h1> DEVIS </h1>
@endsection
@section('content')
@if (!$collectionDevis->isEmpty())
@foreach($collectionDevis as $reservation)
<div class="col-md-9">
    <div class="card "> 
        <div class="card-header bg-info">
            <h4>
                DEVIS DU {{$reservation->getDevis()->getDateDevis()}} <br>
                RESERVATION NUMERO : <i>{{$reservation->getNumeroDeReservation()}}</i>
            </h4>
            <h6>
                EFFECTUEE LE : {{ $reservation->getDateReservation() }}<br>
            </h6>
            @if ($reservation->getDevis()->getValider()==0)
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger float-right" datatoggle="modal" data-target="#a{{$reservation->getDevis()->getCodeDevis()}}">
                Valider le DEVIS
            </button>
            <!-- Modal -->
            <div class="modal fade" id="a{{$reservation->getDevis()->getCodeDevis()}}" tabindex="-1" role="dialog" arialabelledby="confirmerReservationModalLabel" aria-hidden="true">
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
                            Souhaitez-vous <bold>valider</bold> le devis 
                            relatif à la réservation N° {{$reservation->getNumeroDeReservation()}}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">Annuler</button>
                            <form action="" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="codeDevis"
                                       value="{{$reservation->getDevis()->getCodeDevis()}}">
                                <button class="btn btn-primary"
                                        type="submit">Valider le DEVIS</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <h2><span class="badge float-right btn-secondary">DEVIS 
                    VALIDé</span></h2>
            @endif
        </div>
        <div class="card-body ">
            <p>

                Montant total du devis : {{$reservation->getDevis()->getMontantDevis()}}

                Nombre total de container : {{$reservation->getDevis()->getNbContainers()}}
            </p>
            <table class="table table-sm table-striped"> 
                <thead class="thead-dark ">
                    <tr>
                        <th>Type de container</th>
                        <th>Quantité</th>
                    </tr>
                    <?php
                    foreach ($reservation->getReservers() as $ligneDeReservation):
                        $typeContainer = $ligneDeReservation->getTypecontainer();
                        ?>
                        <tr>
                            <td>
                                {{ $typeContainer->getlibelletypecontainer() }}
                            </td>
                            <td>
                                {{ $ligneDeReservation->getqtereserver() }}
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </table>
        </div>
    </div>
    <br>
    <br>
</div>
@endforeach
@else
<p class=""> 
    Vous n'avez pas de devis en cours
</p>
@endif
@endsection