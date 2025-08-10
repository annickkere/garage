@extends('layout')

@section('content')
<h2>Réparations</h2>
<a href="{{ route('reparations.create') }}" class="btn btn-primary mb-3">Ajouter</a>

<table class="table">
    <thead>
        <tr><th>Date</th><th>Objet</th><th>Véhicule</th><th>Techniciens</th><th>Actions</th></tr>
    </thead>
    <tbody>
        @foreach($reparations as $r)
            <tr>
                <td>{{ $r->date }}</td>
                <td>{{ $r->objet_reparation }}</td>
                <td>{{ $r->vehicule->immatriculation }}</td>
                <td>
                    @foreach($r->techniciens as $tech)
                        <span class="badge bg-info">{{ $tech->prenom }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('reparations.edit', $r) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('reparations.destroy', $r) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection