@extends('layouts.default')

@section('title')

<h1> Réservation (étape 2) </h1>

@endsection

@section('content')

<form action="{{route("AjouterLigneReservation")}}" method="post">
    {{ csrf_field() }}
    <div class="row justify-content-around">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    Sélection d'une quantité de container
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="container">Liste des containers</label>
                        <select class="custom-select" id="container" name="container">
                            @foreach($typeContainer as $unTypeContainer)
                            <option value="{{ $unTypeContainer["numTypeContainer"] }}">
                            {{ $unTypeContainer["libelleTypeContainer"] }}
                            </option>
                            @endforeach
                        </select> 

                    </div>

                    <div class="form-group">
                        <label class="control-label" for="quantite">Quantité</label>
                        <input type="number"  id="quantite" name="quantite" class="form-control" placeholder="Saisir la quantité">
                    </div>  
                    <br>
                    <div class="form-group float-right">
                        <button type="submit" id="buttonAddContainer" name="buttonAddContainer" class="btn btn-primary btn-lg">Ajouter container</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    Lignes de réservation
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-light">
                            
                            <tr>
                                <th scope="col">Type container</th>
                                <th scope="col">Quantité</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            @foreach($typeContainer as $unTypeDeContainer)
                            @if(array_key_exists("qteReserver",$unTypeDeContainer))
                            <tr>

                                <td>{{ $unTypeDeContainer['libelleTypeContainer'] }}</td>
                                <td>{{ $unTypeDeContainer['qteReserver'] }}</td>
                                
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>

    </div>
</form> 
<br><br>


<div class="row">
    <div class="col-lg-8">

    </div>
    <div class="col-lg-4">
        <form action="{{ route("FinaliserLaReservation") }}" method="post" >
            {{ csrf_field() }}
            <button type="submit" id="buttonAddReservation" name="buttonAddReservation" class="btn btn-primary btn-lg">
                Valider la demande de réservation
            </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </form>

    </div>
</div>






@endsection

