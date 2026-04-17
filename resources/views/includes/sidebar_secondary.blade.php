<aside id="sidebar_secondary" class="tabbed_sidebar">
    <ul class="uk-tab uk-tab-icons uk-tab-grid" data-uk-tab="{connect:'#dashboard_sidebar_tabs', animation:'slide-horizontal'}">
        <li class="uk-width-1-1"><a href="javascript:void(0);"><i class="material-icons">&#xE8B9;</i></a></li>
    </ul>

    <div class="scrollbar-inner">
        <div class="uk-width-1-1">
            <div class="uk-accordion">
                <h3 class="uk-accordion-title">File d'attente</h3>
                <div class="uk-accordion-content">
                    <ul class="uk-nav uk-nav-dropdown">

                        @foreach(file_attente() as $file)
                            <li>
                                <a href="{{ route('patients.edit', [$file->patient_id, 'c_id'=>$file->id]) }}">{{ $file->patient->nom_complet ?? $file->patient_id }}</a>
                            </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>

</aside>
