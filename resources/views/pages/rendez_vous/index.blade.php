@extends('layouts.app')

@section('before_styles')

    <link rel="stylesheet" href="{{ asset('dist/bower_components/fullcalendar/dist/fullcalendar.min.css') }}">
    <style>
        #calendar_selectable>.fc-toolbar.fc-header-toolbar>.fc-left>h2{
            text-transform: capitalize !important;
        }
        .fc-content{
            font-size: 12px !important;
        }
        .uk-modal-content.uk-margin-top{
            display: none !important;
        }
        .uk-modal-footer{
            display: none !important;
        }
        .fc-unthemed .fc-listMonth-button:after {
            content: '\e8ef';
        }
    </style>

@endsection

@section('after_scripts')

    <script src="{{ asset('dist/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('dist/bower_components/fullcalendar/dist/locale/fr.js') }}"></script>
    <script>
        var $calendar_selectable = $('#calendar_selectable'),
                calendarColorsWrapper = $('<div id="calendar_colors_wrapper"></div>');

        var calendarColorPicker = altair_helpers.color_picker(calendarColorsWrapper).prop('outerHTML');

        if($calendar_selectable.length) {
            $calendar_selectable.fullCalendar({
                defaultView: 'listMonth',
                header: {
                    left: 'title today',
                    center: '',
                    right: 'month,agendaWeek,agendaDay,listMonth prev,next'
                },
                buttonIcons: {
                    prev: 'md-left-single-arrow',
                    next: 'md-right-single-arrow',
                    prevYear: 'md-left-double-arrow',
                    nextYear: 'md-right-double-arrow'
                },
                buttonText: {
                    today: ' ',
                    month: ' ',
                    week: ' ',
                    day: ' '
                },
                aspectRatio: 2.1,
                defaultDate: moment(),
                scrollTime: '{{ \Carbon\Carbon::now()->subHour()->startOfHour()->format('H:i:s') }}',
                locale: 'fr',
                selectable: true,
                slotDuration: '00:30',
                selectHelper: true,
                select: function() {
                    UIkit.modal.prompt(
                        '{{ Form::open(['route' => 'consultations.store']) }}'+
                            '<h3 class="heading_b uk-margin-medium-bottom">Créer un rendez-vous</h3>' +
                            '{{ Form::hidden('from_consultation','true') }}'+
                            '<div class="uk-grid" data-uk-grid-margin>'+
                                '<div class="uk-width-medium-1-1">'+
                                    '{{ Form::label('code_statut', 'Statut *') }}'+
                                    '{{ Form::select('code_statut', ['RDV' => 'Rendez-vous', 'ATT' => 'Ajouté à la file d\'attente'], 'RDV',array('class'=>'md-input'.($errors->has('code_statut') ? ' md-input-danger' : ''))) }}'+
                                    '{!! $errors->first('code_statut', '<span style="color:#dd4b39 !important"><i class="uk-icon-times-circle-o uk-text-danger"></i> :message</span>') !!}'+
                                '</div>'+
                            '</div>'+
                            '<div class="uk-grid" data-uk-grid-margin>'+
                                '<div class="uk-width-medium-1-1">'+
                                    '{{ Form::label('patient_id', 'Patient *') }}'+
                                    '{{ Form::select('patient_id', $liste_patients, old('patient_id'),array('required','data-md-selectize','class'=>'md-input'.($errors->has('patient_id') ? ' md-input-danger' : ''))) }}'+
                                '</div>'+
                            '</div>'+
                            '<div class="uk-grid" data-uk-grid-margin>'+
                                '<div class="uk-width-medium-1-1">'+
                                    '{{ Form::label('date_consultation', 'Date de consultation *') }}'+
                                    '{{ Form::text('date_consultation', \Carbon\Carbon::now()->format('d/m/Y H:i'),array('required', 'placeholder'=>'Date de consultation','style'=>'width:100%; margin-top:5px','data-uk-datepicker'=>"{format:'DD/MM/YYYY HH:mm'}",'id'=>'date_consultation','class'=>'label-fixed md-input'.($errors->has('date_consultation') ? ' md-input-danger' : ''))) }}'+
                                '</div>'+
                            '</div>'+
                            '<div class="uk-grid" data-uk-grid-margin>'+
                                '<div class="uk-width-medium-1-2 uk-text-left">'+
                                    '<button class="md-btn md-btn-default md-btn-wave-light uk-modal-close" type="button">Annuler</a>'+
                                '</div>'+
                                '<div class="uk-width-medium-1-2 uk-text-right">'+
                                    '<button class="md-btn md-btn-success md-btn-wave-light" type="submit">Ajouter</a>'+
                                '</div>'+
                            '</div>'+
                        '{{ Form::close() }}'
                    );
                },
                editable: false,
                eventLimit: true,
                height: 'parent',
                noEventsMessage: 'Aucune activité à afficher',
                timeFormat: 'HH:mm',
                nowIndicator: true,
                events: [
                    @foreach($consultations as $consultation)
                    {
                        id: '{{ $consultation->id }}',
                        title: '{{ $consultation->nom_patient }}',
                        start: moment('{{ \Carbon\Carbon::createFromFormat('d/m/Y H:i', $consultation->date_consultation)->format('Y-m-d H:i') }}')
                                .format('YYYY-MM-DD HH:mm'),
                        end: moment('{{ \Carbon\Carbon::createFromFormat('d/m/Y H:i', $consultation->date_consultation)->addMinutes(30)->format('Y-m-d H:i') }}')
                                .format('YYYY-MM-DD HH:mm'),
                        url: '{{ route('consultations.edit', $consultation) }}',
                        @if(\Carbon\Carbon::createFromFormat('d/m/Y H:i', $consultation->date_consultation)->toDateTimeString() > \Carbon\Carbon::now()->toDateTimeString())
                        color: '#7cb342',
                        textColor: '#fff',
                        @else
                        color: '#0277bd',
                        textColor: '#fff',
                        @endif
                    },
                    @endforeach
                ]
            });
        }
    </script>

@endsection

@section('content')

    <div class="md-card">
        <div class="md-card-content" style="height: 450px;">
            <div id="calendar_selectable"></div>
        </div>
    </div>

    {{--<div class="md-card uk-margin-medium-bottom">--}}
        {{--<div class="md-card-content">--}}
            {{--<div class="dt_colVis_buttons"></div>--}}
            {{--<table id="dt_colVis" class="uk-table" cellspacing="0" width="100%">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                    {{--@foreach($table_headers as $table_header)--}}
                        {{--<th>{{$table_header}}</th>--}}
                    {{--@endforeach--}}
                {{--</tr>--}}
                {{--</thead>--}}

                {{--<tbody>--}}
                {{--@foreach($consultations as $consultation)--}}
                    {{--<tr>--}}
                        {{--<td>--}}
                            {{--{!! Html::decode(link_to_route('consultations.edit','<i class="md-icon material-icons">&#xE254;</i>',$consultation)) !!}--}}
                            {{--<a href="{{ route('consultations.destroy', [$consultation]) }}" class="destroy-btn"--}}
                               {{--data-remote="true" data-method="delete" data-confirm="Êtes-vous sûr de vouloir supprimer cet enregistrement ?">--}}
                                {{--<i class="md-icon material-icons">&#xE872;</i>--}}
                            {{--</a>--}}
                        {{--</td>--}}
                        {{--<td>{{ $consultation->nom_complet_patient }}</td>--}}
{{--                        <td>{{ $consultation->nom_medecin }}</td>--}}
                        {{--<td>{{ $consultation->date_consultation }}</td>--}}
                        {{--<td>{{ $consultation->nom_statut }}</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                {{--</tbody>--}}
            {{--</table>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div class="md-fab-wrapper fab-save">
        <a class="md-fab md-fab-success md-fab-wave-light" href="{{ route('consultations.create') }}" title="Ajouter une nouvelle consultation">
            <i class="material-icons">&#xe7fe;</i>
        </a>
    </div>

@endsection