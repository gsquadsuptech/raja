@extends('layouts.app')

@section('after_scripts')
    <!-- page specific plugins -->
    <!-- d3 -->
    <script src="{{ asset('/dist/bower_components/d3/d3.min.js') }}"></script>
    <!-- metrics graphics (charts) -->
    <script src="{{ asset('/dist/bower_components/metrics-graphics/dist/metricsgraphics.min.js') }}"></script>
    <!-- chartist (charts) -->
    <script src="{{ asset('/dist/bower_components/chartist/dist/chartist.min.js') }}"></script>
    <!-- peity (small charts) -->
    <script src="{{ asset('/dist/bower_components/peity/jquery.peity.min.js') }}"></script>
    <!-- easy-pie-chart (circular statistics) -->
    <script src="{{ asset('/dist/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js') }}"></script>
    <!-- countUp -->
    <script src="{{ asset('/dist/bower_components/countUp.js/dist/countUp.min.js') }}"></script>

    <!--  dashbord functions -->
    <script src="{{ asset('/dist/assets/js/pages/dashboard.js') }}"></script>
@endsection

@section('content')

        <!-- statistics (small charts) -->
    {{--<div class="uk-grid uk-grid-width-large-1-4 uk-grid-width-medium-1-2 uk-grid-medium uk-sortable sortable-handler hierarchical_show" data-uk-sortable data-uk-grid-margin>--}}
        {{--<div>--}}
            {{--<div class="md-card">--}}
                {{--<div class="md-card-content">--}}
                    {{--<span class="uk-text-muted uk-text-small">Nombre de clients </span>--}}
                    {{--<h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>{{ $nb_clients }}</noscript></span></h2>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div>--}}
            {{--<div class="md-card">--}}
                {{--<div class="md-card-content">--}}
                    {{--<span class="uk-text-muted uk-text-small">Clients présents Dans la salle</span>--}}
                    {{--<h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>{{ $nb_presents }}</noscript></span></h2>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div>--}}
            {{--<div class="md-card">--}}
                {{--<div class="md-card-content">--}}
                    {{--<span class="uk-text-muted uk-text-small">Encaissements des prospects du mois</span>--}}
                    {{--<h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>{{ $paiements_prospects }}</noscript></span> F CFA</h2>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div>--}}
            {{--<div class="md-card">--}}
                {{--<div class="md-card-content">--}}
                    {{--<span class="uk-text-muted uk-text-small">Encaissements des clients du mois</span>--}}
                    {{--<h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>{{ $paiements_abonnements }}</noscript></span> F CFA</h2>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div>--}}
            {{--<div class="md-card">--}}
                {{--<div class="md-card-content">--}}
                    {{--<div class="uk-float-right uk-margin-top uk-margin-small-right"><span class="peity_orders peity_data">72/100</span></div>--}}
                    {{--<span class="uk-text-muted uk-text-small">Taux de conversion des prospects</span>--}}
                    {{--<h2 class="uk-margin-remove"><span class="countUpMe">0<noscript>13</noscript></span>%</h2>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <!-- large chart -->
    {{--<div class="uk-grid">--}}
        {{--<div class="uk-width-1-1">--}}
            {{--<div class="md-card">--}}
                {{--<div class="md-card-toolbar">--}}
                    {{--<div class="md-card-toolbar-actions">--}}
                        {{--<i class="md-icon material-icons md-card-fullscreen-activate">&#xE5D0;</i>--}}
                        {{--<i class="md-icon material-icons">&#xE5D5;</i>--}}
                        {{--<div class="md-card-dropdown" data-uk-dropdown="{pos:'bottom-right'}">--}}
                            {{--<i class="md-icon material-icons">&#xE5D4;</i>--}}
                            {{--<div class="uk-dropdown uk-dropdown-small">--}}
                                {{--<ul class="uk-nav">--}}
                                    {{--<li><a href="#">Action 1</a></li>--}}
                                    {{--<li><a href="#">Action 2</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<h3 class="md-card-toolbar-heading-text">--}}
                        {{--Fréquentations de la salle--}}
                    {{--</h3>--}}
                {{--</div>--}}
                {{--<div class="md-card-content">--}}
                    {{--<div class="mGraph-wrapper">--}}
                        {{--<div id="mGraph_sale" class="mGraph" data-uk-check-display></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <!-- tasks -->
    {{--<div class="uk-grid" data-uk-grid-margin data-uk-grid-match="{target:'.md-card-content'}">--}}
        {{--<div class="uk-width-medium-1-1">--}}
            {{--<div class="md-card">--}}
                {{--<div class="md-card-content">--}}
                    {{--<h3 class="heading_a uk-margin-bottom">Abonnements expirants dans les {{ parametre('delai_rappel') }} prochains jours</h3>--}}
                    {{--<div class="uk-overflow-container">--}}
                        {{--<table class="uk-table">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th class="uk-text-nowrap">Clients</th>--}}
                                {{--<th class="uk-text-nowrap">Date d'expiration</th>--}}
                                {{--<th class="uk-text-nowrap">Échéance</th>--}}
                                {{--<th class="uk-text-nowrap">Date du dernier rappel</th>--}}
                                {{--<th class="uk-text-nowrap uk-text-right">Actions</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--@foreach($abonnements as $abonnement)--}}
                            {{--<tr class="uk-table-middle">--}}
                                {{--<td class="uk-width-3-10 uk-text-nowrap">--}}
                                    {{--<a href="{{ route('clients.show', $abonnement->client->id) }}">--}}
                                        {{--{{ $abonnement->client->afficher_client }}--}}
                                    {{--</a>--}}
                                {{--</td>--}}
                                {{--<td class="uk-width-2-10 uk-text-muted uk-text-small">{{ $abonnement->date_fin }}</td>--}}
                                {{--<td class="uk-width-3-10">--}}
                                    {{--<div class="uk-progress uk-progress-mini uk-progress-success uk-margin-remove">--}}
                                        {{--<div class="uk-progress-bar" style="width: {{ $diff = ((Carbon\Carbon::parse($date_jour)->diffInDays(\Carbon\Carbon::createFromFormat('d/m/Y', $abonnement->date_fin)) * 10) - 100) * -1 }}%;"></div>--}}
                                    {{--</div>--}}
                                {{--</td>--}}
                                {{--<td class="uk-width-2-10 uk-text-muted uk-text-small">--}}
                                    {{--Aucun--}}
                                {{--</td>--}}
                                {{--<td class="uk-width-2-10 uk-text-nowrap uk-text-right">--}}
                                    {{--{!! Html::decode(link_to_route('envoi_rappel', '<i class="uk-icon-send-o"></i> Envoyer un rappel', [$abonnement->id], ['class'=>'md-btn md-btn-warning md-btn-mini md-btn-wave-light md-btn-icon waves-effect waves-button waves-light'])) !!}--}}
                                    {{--<button type="submit" class="">--}}
                                        {{--<i class="uk-icon-send-o"></i>--}}
                                        {{--Envoyer un rappel--}}
                                    {{--</button>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--@endforeach--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <!-- tasks -->
    {{--<div class="uk-grid" data-uk-grid-margin data-uk-grid-match="{target:'.md-card-content'}">--}}
        {{--<div class="uk-width-medium-1-1">--}}
            {{--<div class="md-card">--}}
                {{--<div class="md-card-content">--}}
                    {{--<h3 class="heading_a uk-margin-bottom">Abonnements ayant expirés</h3>--}}
                    {{--<div class="uk-overflow-container">--}}
                        {{--<table class="uk-table">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th class="uk-text-nowrap">Clients</th>--}}
                                {{--<th class="uk-text-nowrap">Date de l'expiration</th>--}}
                                {{--<th class="uk-text-nowrap">Date du dernier rappel</th>--}}
                                {{--<th class="uk-text-nowrap uk-text-right">Actions</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--@foreach($abonnements_expires as $abonnements_expire)--}}
                            {{--<tr class="uk-table-middle">--}}
                                {{--<td class="uk-width-3-10 uk-text-nowrap">--}}
                                    {{--<a href="{{ route('clients.show', $abonnements_expire->client->id) }}">--}}
                                        {{--{{ $abonnements_expire->client->afficher_client }}--}}
                                    {{--</a>--}}
                                {{--</td>--}}
                                {{--<td class="uk-width-2-10 uk-text-muted uk-text-small">{{ $abonnements_expire->date_fin }}</td>--}}
                                {{--<td class="uk-width-2-10 uk-text-muted uk-text-small">--}}
                                    {{--Aucun--}}
                                {{--</td>--}}
                                {{--<td class="uk-width-2-10 uk-text-nowrap uk-text-right">--}}
                                    {{--{!! Html::decode(link_to_route('envoi_rappel', '<i class="uk-icon-send-o"></i> Envoyer un rappel', [$abonnements_expire->id], ['class'=>'md-btn md-btn-warning md-btn-mini md-btn-wave-light md-btn-icon waves-effect waves-button waves-light'])) !!}--}}
                                    {{--<button type="submit" class="">--}}
                                        {{--<i class="uk-icon-send-o"></i>--}}
                                        {{--Envoyer un rappel--}}
                                    {{--</button>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--@endforeach--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <!-- info cards -->
    {{--<h2 class="heading_a uk-margin-bottom">Clients récents</h2>--}}
    {{--<div class="uk-grid uk-grid-medium uk-grid-width-medium-1-2 uk-grid-width-large-1-3" data-uk-grid-margin data-uk-grid-match="{target:'.md-card-content'}">--}}
        {{--@foreach($clients_recents as $client)--}}
        {{--<div>--}}
            {{--<div class="md-card">--}}
                {{--<div class="md-bg-light-blue-600" style="background-color: {{ parametre('couleur_sidebar') }} !important;">--}}
                    {{--<div class="md-card-head-menu" data-uk-dropdown="{pos:'bottom-right'}">--}}
                        {{--<i class="md-icon material-icons md-icon-light">&#xE5D4;</i>--}}
                        {{--<div class="uk-dropdown uk-dropdown-small">--}}
                            {{--<ul class="uk-nav">--}}
                                {{--<li><a href="{{ route('clients.show', $client->id) }}">Profil</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="uk-text-center">--}}
                        {{--<img class="md-card-head-avatar" src="{{ $client->afficher_photo }}" alt=""/>--}}
                    {{--</div>--}}
                    {{--<h3 class="md-card-head-text uk-text-center md-color-white">--}}
                        {{--{{ $client->full_name }}--}}
                    {{--</h3>--}}
                {{--</div>--}}
                {{--<div class="md-card-content">--}}
                    {{--<ul class="md-list md-list-addon">--}}
                        {{--@if($client->email)--}}
                        {{--<li>--}}
                            {{--<div class="md-list-addon-element">--}}
                                {{--<i class="md-list-addon-icon material-icons">&#xE158;</i>--}}
                            {{--</div>--}}
                            {{--<div class="md-list-content">--}}
                                {{--<span class="md-list-heading">{{ $client->email }}</span>--}}
                                {{--<span class="uk-text-small uk-text-muted">Email</span>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                        {{--@endif--}}
                        {{--<li>--}}
                            {{--<div class="md-list-addon-element">--}}
                                {{--<i class="md-list-addon-icon material-icons">&#xE0CD;</i>--}}
                            {{--</div>--}}
                            {{--<div class="md-list-content">--}}
                                {{--<span class="md-list-heading">{{ $client->telephone1 }}</span>--}}
                                {{--<span class="uk-text-small uk-text-muted">Téléphone</span>--}}
                            {{--</div>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--@endforeach--}}
    {{--</div>--}}

@endsection
