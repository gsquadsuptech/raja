<li style="padding-top: 20px">
<h3 class="heading_a uk-margin-bottom">Liste des consultations</h3>
<table id="dt_colVis" class="uk-table" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>Actions</th>
        {{--<th>Medecin consultant</th>--}}
        <th>Date</th>
        <th>Statut</th>
    </tr>
    </thead>

    <tbody>
    @if(isset($liste_consultations))
    @foreach($liste_consultations as $consultation)
        <tr>
            <td>
                {!! Html::decode(link_to_route('consultations.edit','<i class="md-icon material-icons">&#xE254;</i>',$consultation)) !!}
                <a href="{{ route('consultations.destroy', [$consultation]) }}" class="destroy-btn"
                   data-remote="true" data-method="delete" data-confirm="Êtes-vous sûr de vouloir supprimer cet enregistrement ?">
                    <i class="md-icon material-icons">&#xE872;</i>
                </a>
            </td>
{{--            <td>{{ $consultation->nom_medecin }}</td>--}}
            <td>{{ $consultation->date_consultation }}</td>
            <td>{{ $consultation->nom_statut }}</td>
        </tr>
    @endforeach
    @endif
    </tbody>
</table>
</li>