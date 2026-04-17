var DataTable;

$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var dt_tableAjax = $('#liste_patients');
    if (dt_tableAjax.length) {

        // var dt_buttons = dt_tableAjax.prev('.dt_colVis_buttons');

        DataTable = dt_tableAjax.DataTable({
            retrieve: true,
            order: order_columns,
            lengthChange: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: get_data_url,
                method: 'POST'
            },
            columns: datatable_columns,
            language: {
                "lengthMenu": "Afficher _MENU_ résultats par page",
                "zeroRecords": "Aucun résultat trouvé.",
                //"info": "Page _PAGE_ de _PAGES_",
                "info": "_START_ &agrave; _END_ sur _TOTAL_",
                "infoEmpty": "0 résultat(s)",
                "infoFiltered": "(filtré(s) parmi _MAX_ résultats au total)",
                "emptyTable": "Aucune donnée disponible.",
                "loadingRecords": "Chargement en cours...",
                "processing": "<div style='position: absolute;top: 50%;right: 50%;'><img src='public/dist/assets/img/spinners/spinner_large.gif' alt='Traitement en cours...'></div>",
                "search": "Rechercher :",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                },
                "aria": {
                    "sortAscending": ": trier en ordre croissant",
                    "sortDescending": ": trier en ordre décroissant"
                }
            }
        });
    }

    $.fn.capitalize = function () {

        $.each(this, function () {

            var split = this.value.split(' ');
            for (var i = 0, len = split.length; i < len; i++) {
                split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1);
            }
            this.value = split.join(' ');
        });
        return this;
    };

    $('.capitalized').keyup(function() {
        $(this).capitalize();
    }).capitalize();

    if ($("#dt_colVis").length) {
        DataTable = $("#dt_colVis").DataTable({
            retrieve: true,
            "language": {
                "lengthMenu": "Afficher _MENU_ résultats par page",
                "zeroRecords": "Aucun résultat trouvé.",
                "info": "Page _PAGE_ de _PAGES_",
                "infoEmpty": "0 résultat(s)",
                "infoFiltered": "(filtré(s) parmi _MAX_ résultats au total)",
                "emptyTable": "Aucune donnée disponible.",
                "loadingRecords": "Chargement en cours...",
                "processing": "Traitement en cours...",
                "search": "Rechercher :",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                }
            }
        });

        $('body').on('ajax:success', '.destroy-btn', function (e, data, status, xhr) {

            $('.dt_colVis_buttons').append('<button id="suppress-notification" style="display: none;" class="md-btn" ' +
                'data-message="<a href=\'#\' id=\'clear-suppress-notification\' class=\'notify-action\'><i class=\'uk-icon-times\'></i></a>' +
                'Suppression effectuée avec succès" ' +
                'data-status="success"' +
                'data-pos="top-center">' + '</button>');

            setTimeout(function() {
                $( "#suppress-notification" ).trigger( "click" );
            }, 200);
            setTimeout(function() {
                $( "#clear-suppress-notification" ).trigger( "click" );
            }, 5000);

            /* retirer la ligne */
            DataTable.row($(e.target).closest('tr')).remove().draw();
        });
    }

    if ($("#code_pays").length) {
        $('#code_pays').change(function () {
            var code_pays = $(this).val();
            var public_path = window.location.pathname;

            if (code_pays) {
                $.ajax({
                    type: "GET",
                    url: URL_API_PAYS + code_pays,
                    success: function (res) {
                        if (res) {
                            $("#ville_id").empty();
                            $("#ville_id").append('<option value="">- Choisir -</option>');
                            $.each(res, function (key, value) {
                                $("#ville_id").append('<option value="' + key + '">' + value + '</option>');
                            });
                            $("#ville_id").append('<option value="new_ville">Nouvelle ville</option>');
                        } else {
                            $("#ville_id").empty();
                        }
                    }
                });
            } else {
                $("#ville_id").empty();
            }
        });

    }

    if ($("#client_form").length) {
        $('.personne-morale').hide();
        $('#personne-physique').show();

        if($('#code_type_client option:selected').text() == 'Personne morale') {
            $('.personne-morale').show();
            $('#personne-physique').hide();
        }
        $(document).on('change', '#code_type_client', function (e) {
            if($('#code_type_client option:selected').text() == 'Personne morale') {
                $('.personne-morale').show('slow');
                $('#personne-physique').hide('slow');
            }
            else {
                $('.personne-morale').hide('slow');
                $('#personne-physique').show('slow');
            }
        });

        // section formulaire Nouvelle ville
        $('#new_ville_form').hide();
        $('.req_nom_ville').prop('required', false);

        if($('#ville_id option:selected').val() != "new_ville") {
            $('#new_ville_form').hide();
            $('.req_nom_ville').prop('required', false);
        }

        $(document).on('change', '#ville_id', function (e) {
            if($('#ville_id option:selected').val() != "new_ville") {
                $('#new_ville_form').hide('slow');
                $('.req_nom_ville ').prop('required', false);
            }
            else{
                $('#new_ville_form').show('slow');
                $('.req_nom_ville ').prop('required', true);
            }
        });

        var id_contact = 1;
        $('#add_personne_contact').click(function () {
            $("#personne_contact_form")
                .append(
                    '<div class="uk-grid" data-uk-grid-margin>' +
                        '<div class="uk-width-medium-1-3">' +
                            '<label>Nom</label>' +
                            '<input type="text" name="nom_contact_'+ id_contact +'" class="md-input" required />' +
                        '</div>' +
                        '<div class="uk-width-medium-1-3">' +
                            '<label>Email</label>' +
                            '<input type="email" name="email_contact_'+ id_contact +'" class="md-input" required />' +
                        '</div>' +
                        '<div class="uk-width-medium-1-3">' +
                            '<label>Poste</label>' +
                            '<input type="text" name="poste_contact_'+ id_contact +'" class="md-input" required />' +
                        '</div>' +
                        '<input type="hidden" name="nb_contact" value="' + id_contact + '" />' +
                    '</div>'
                );
            $('a#add_personne_contact').text('Ajouter une autre personne contact');
            id_contact++;
        });
    }

    $(document).on('change', '#service_id', function (e) {
        var nbJours = duree_services[this.value]; // recuperer la duree de l'abonnement en jours
        var dateDebutValue = $('#date_debut').val();
        if(dateDebutValue && this.value)
            setDateFin(dateDebutValue,nbJours);
    });

    $(document).on('change', '#date_debut', function (e) {
        var selectedService = $('#service_id option:selected').val();
        if(selectedService && this.value) {
            var nbJours = duree_services[selectedService]; // recuperer la duree de l'abonnement en jours
            var dateDebutValue = this.value;
            setDateFin(dateDebutValue,nbJours);
        }
    });

    if ($("#wizard_advanced_form").length) {

        // section formulaire client
        $('#section_client_form').show();
        $('.personne-morale').hide();
        $('#personne-physique').show();
        $('.req_physique').prop('required', true);
        $('.req_morale').prop('required', false);
        $('.req_telephone ').prop('required', true);

        if($('#code_type_client option:selected').text() == 'Personne morale') {
            $('.personne-morale').show();
            $('#add_personne_contact').hide();
            $('#personne-physique').hide();
            $('.req_physique').prop('required', false);
            $('.req_morale').prop('required', true);
        }
        $(document).on('change', '#code_type_client', function (e) {
            if($('#code_type_client option:selected').text() == 'Personne morale') {
                $('.personne-morale').show('slow');
                $('#add_personne_contact').hide();
                $('#personne-physique').hide('slow');
                $('.req_physique').prop('required', false);
                $('.req_morale').prop('required', true);
            }
            else {
                $('.personne-morale').hide('slow');
                $('#personne-physique').show('slow');
                $('.req_physique').prop('required', true);
                $('.req_morale').prop('required', false);
            }
        });

        if($('#client_id option:selected').val() != "") {
            $('#section_client_form').hide();
            $('.req_physique').prop('required', false);
            $('.req_telephone ').prop('required', false);
            $('.req_morale').prop('required', false);

            setTimeout(function() {
                $('#wizard_advanced').children('.content.clearfix').css("min-height", "400px").animate({height:'400px'});
            }, 200);
        }

        $(document).on('change', '#client_id', function (e) {
            if($('#client_id option:selected').val() != "") {
                $('#section_client_form').hide('slow');
                $('.req_physique').prop('required', false);
                $('.req_telephone ').prop('required', false);
                $('.req_morale').prop('required', false);

                setTimeout(function() {
                    $('#wizard_advanced').children('.content.clearfix').css("min-height", "400px").animate({height:'400px'});
                }, 200);
            }
            else{
                $('#section_client_form').show('slow');
                $('.personne-morale').hide();
                $('#personne-physique').show();
                $('.req_telephone ').prop('required', true);
                $('.req_physique').prop('required', true);
                $('.req_morale').prop('required', false);

                if($('#code_type_client option:selected').text() == 'Personne morale') {
                    $('.personne-morale').show();
                    $('#add_personne_contact').hide();
                    $('#personne-physique').hide();
                    $('.req_physique').prop('required', false);
                    $('.req_morale').prop('required', true);
                }

                setTimeout(function() {
                    $('#wizard_advanced').children('.content.clearfix').animate({height:'990px'});
                }, 200);
            }
        });


        // section formulaire expediteur
        $('#section_expediteur_form').show();
        $('.req_expediteur').prop('required', true);

        if($('#expediteur_id option:selected').val() != "") {
            $('#section_expediteur_form').hide();
            $('.req_expediteur').prop('required', false);
        }

        $(document).on('change', '#expediteur_id', function (e) {
            if($('#expediteur_id option:selected').val() != "") {
                $('#section_expediteur_form').hide('slow');
                $('.req_expediteur').prop('required', false);
            }
            else{
                $('#section_expediteur_form').show('slow');
                $('.req_expediteur').prop('required', true);
            }
        });


        // section formulaire groupeur
        $('#section_groupeur_form').show();
        $('.req_groupeur').prop('required', true);

        if($('#groupeur_id option:selected').val() != "") {
            $('#section_groupeur_form').hide();
            $('.req_groupeur').prop('required', false);
        }

        $(document).on('change', '#groupeur_id', function (e) {
            if($('#groupeur_id option:selected').val() != "") {
                $('#section_groupeur_form').hide('slow');
                $('.req_groupeur ').prop('required', false);
            }
            else{
                $('#section_groupeur_form').show('slow');
                $('.req_groupeur ').prop('required', true);
            }
        });


        // section formulaire Nouvelle ville
        $('#new_ville_form').hide();
        $('.req_nom_ville').prop('required', false);

        if($('#ville_id option:selected').val() != "new_ville") {
            $('#new_ville_form').hide();
            $('.req_nom_ville').prop('required', false);
        }

        $(document).on('change', '#ville_id', function (e) {
            if($('#ville_id option:selected').val() != "new_ville") {
                $('#new_ville_form').hide('slow');
                $('.req_nom_ville ').prop('required', false);
            }
            else{
                $('#new_ville_form').show('slow');
                $('.req_nom_ville ').prop('required', true);
            }
        });

    }

    if ($("#activite_form").length) {
        var recurrente = $('.recurrente');
        var ponctuelle = $('.ponctuelle');
        var req_recurrente = $('.req_recurrente');
        var req_ponctuelle = $('.req_ponctuelle');
        var req_heures = $('.req_heures');
        var heures = $('.heures');

        recurrente.hide();
        ponctuelle.hide();
        heures.hide();
        req_ponctuelle.prop('required', false);
        req_recurrente.prop('required', false);
        req_heures.prop('required', false);

        if ($('#type_activite option:selected').val() == "Ponctuelle") {
            ponctuelle.show();
            recurrente.hide();
            heures.show();
            req_ponctuelle.prop('required', true);
            req_recurrente.prop('required', false);
            req_heures.prop('required', true);
        }

        if ($('#type_activite option:selected').val() == "Récurrente") {
            ponctuelle.hide();
            recurrente.show();
            heures.show();
            req_ponctuelle.prop('required', false);
            req_recurrente.prop('required', true);
            req_heures.prop('required', true);
        }

        $(document).on('change', '#type_activite', function (e) {
            if ($('#type_activite option:selected').val() == "Ponctuelle") {
                ponctuelle.show('slow');
                recurrente.hide('slow');
                heures.show('slow');
                req_ponctuelle.prop('required', true);
                req_recurrente.prop('required', false);
                req_heures.prop('required', true);
            }
            else if ($('#type_activite option:selected').val() == "Récurrente") {
                ponctuelle.hide('slow');
                recurrente.show('slow');
                heures.show('slow');
                req_ponctuelle.prop('required', false);
                req_recurrente.prop('required', true);
                req_heures.prop('required', true);
            }
            else{
                recurrente.hide('slow');
                ponctuelle.hide('slow');
                heures.hide('slow');
                req_ponctuelle.prop('required', false);
                req_recurrente.prop('required', false);
                req_heures.prop('required', false);
            }
        });
    }

});

function setDateFin(dateDebut, jours) {
    //console.log(dateDebut,jours);
    var dateFin = moment(dateDebut,"DD/MM/YYYY").add(jours, 'days').format("DD/MM/YYYY");
    $('#date_fin').val(dateFin);
}