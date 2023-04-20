<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Backpack Crud Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the CRUD interface.
    | You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    // Forms
    'save_action_save_and_new' => 'Spremi i nova stavka',
    'save_action_save_and_edit' => 'Spremite i uredite ovu stavku',
    'save_action_save_and_back' => 'Spremi i natrag',
    'save_action_save_and_preview' => 'Spremi i pregledaj',
    'save_action_changed_notification' => 'Zadano ponašanje nakon spremanja je promijenjeno.',

    // Create form
    'add' => 'Dodaj',
    'back_to_all' => 'Natrag na sve',
    'cancel' => 'Otkaži',
    'add_a_new' => 'Dodaj novi',

    // Edit form
    'edit' => 'Uredi',
    'save' => 'Spremi',

    // Translatable models
    'edit_translations' => 'Prijevod',
    'language' => 'Jezik',

    // CRUD table view
    'all' => 'Sve',
    'in_the_database' => 'u bazi podataka',
    'list' => 'Popis',
    'reset' => 'Reset',
    'actions' => 'Opcije',
    'preview' => 'Pregled',
    'delete' => 'Izbriši',
    'admin' => 'Administrator',
    'details_row' => 'Ovo je red s detaljima. Izmijenite kako želite.',
    'details_row_loading_error' => 'Došlo je do pogreške prilikom učitavanja detalja. Molimo pokušajte ponovno.',
    'clone' => 'Klon',
    'clone_success' => '<strong>Stavka kloniran</strong><br>Nova stavka je dodana, s istim informacijama kao ovaj.',
    'clone_failure' => '<strong>Kloniranje nije uspjelo</strong><br>Nova stavka nije mogla biti kreiran. Molimo pokušajte ponovno.',

    // Confirmation messages and bubbles
    'delete_confirm' => 'Jeste li sigurni da želite izbrisati ovu stavku?',
    'delete_confirmation_title' => 'Stavka obrisana',
    'delete_confirmation_message' => 'Stavka je uspješno izbrisana.',
    'delete_confirmation_not_title' => 'NIJE obrisano',
    'delete_confirmation_not_message' => "Došlo je do pogreške. Vaša stavka možda nije izbrisana.",
    'delete_confirmation_not_deleted_title' => 'Nije izbrisano',
    'delete_confirmation_not_deleted_message' => 'Ništa se nije dogodilo. Vaš predmet je siguran.',

    // Bulk actions
    'bulk_no_entries_selected_title' => 'Nijedna stavka nije odabrana',
    'bulk_no_entries_selected_message' => 'Odaberite jednu ili više stavki za izvođenje skupne radnje na njima.',

    // Bulk delete
    'bulk_delete_are_you_sure' => 'Jeste li sigurni da želite izbrisati ove :number stavke?',
    'bulk_delete_sucess_title' => 'Stavke izbrisani',
    'bulk_delete_sucess_message' => 'stavke su obrisane',
    'bulk_delete_error_title' => 'Brisanje nije uspjelo',
    'bulk_delete_error_message' => 'Jedna ili više stavki nije bilo moguće izbrisati',

    // Bulk clone
    'bulk_clone_are_you_sure'   => 'Are you sure you want to clone these :number entries?',
    'bulk_clone_sucess_title'   => 'Entries cloned',
    'bulk_clone_sucess_message' => ' items have been cloned.',
    'bulk_clone_error_title'    => 'Cloning failed',
    'bulk_clone_error_message'  => 'One or more entries could not be created. Please try again.',

    // Ajax errors
    'ajax_error_title' => 'Greška',
    'ajax_error_text' => 'Pogreška pri učitavanju stranice. Molimo osvježite stranicu.',

    // DataTables translation
    'emptyTable' => 'Nema dostupnih podataka u tablici',
    'info' => 'Prikazuje _START_ do _END_ od _TOTAL_ unosa',
    'infoEmpty' => 'Nema unosa',
    'infoFiltered' => '(filtrirano od _MAX_ ukupnih unosa)',
    'infoPostFix'    => '.',
    'thousands'      => ',',
    'lengthMenu' => '_MENU_ stavki po stranici',
    'loadingRecords' => 'Učitavanje...',
    'processing' => 'Obrada...',
    'search' => 'Traži',
    'zeroRecords' => 'Nisu pronađeni odgovarajući unosi',
    'paginate'       => [
        'first' => 'Prvi',
        'last' => 'Zadnji',
        'next' => 'Dalje',
        'previous' => 'Prethodni',
    ],
    'aria' => [
        'sortAscending' => ': aktivirajte za sortiranje stupaca uzlazno',
        'sortDescending' => ': aktivirajte za sortiranje stupaca silazno',
    ],
    'export' => [
        'export' => 'Izvoz',
        'copy' => 'Kopiraj',
        'excel' => 'Excel',
        'csv' => 'CSV',
        'pdf' => 'PDF',
        'print' => 'Ispis',
        'column_visibility' => 'Vidljivost stupca',
    ],

    // global crud - errors
    'unauthorized_access' => 'Neovlašteni pristup - nemate potrebna dopuštenja da vidite ovu stranicu.',
    'please_fix' => 'Ispravite sljedeće pogreške:',

    // global crud - success / error notification bubbles
    'insert_success' => 'Stavka je uspješno dodana.',
    'update_success' => 'Stavka je uspješno modificirana.',

    // CRUD reorder view
    'reorder' => 'Promijeni redoslijed',
    'reorder_text' => 'Koristite drag&drop za promjenu redoslijeda.',
    'reorder_success_title' => 'Gotovo',
    'reorder_success_message' => 'Redoslijed je spremljen.',
    'reorder_error_title' => 'Pogreška',
    'reorder_error_message' => 'Redoslijed nije spremljen.',

    // CRUD yes/no
    'yes' => 'Da',
    'no'  => 'Ne',

    // CRUD filters navbar view
    'filters' => 'Filteri',
    'toggle_filters' => 'Prebacivanje filtera',
    'remove_filters' => 'Ukloni filtere',
    'apply' => 'Primijeni',

    //filters language strings
    'today' => 'Danas',
    'yesterday' => 'Jučer',
    'last_7_days' => 'Zadnjih 7 dana',
    'last_30_days' => 'Zadnjih 30 dana',
    'this_month' => 'Ovaj mjesec',
    'last_month' => 'Prošli mjesec',
    'custom_range' => 'Prilagođeni raspon',
    'weekLabel' => 'W',

    // Fields
    'browse_uploads' => 'Pregledaj prijenose',
    'select_all' => 'Odaberi sve',
    'select_files' => 'Odaberi datoteke',
    'select_file' => 'Odaberi datoteku',
    'clear' => 'Očisti',
    'page_link' => 'Veza do stranice',
    'page_link_placeholder' => 'http://example.com/your-desired-page',
    'internal_link' => 'Interna poveznica',
    'internal_link_placeholder' => 'Interni identifikator. Primjer: \'admin/stranica\' (bez navodnika) za \':url\'',
    'external_link' => 'Vanjski link',
    'choose_file' => 'Odaberi datoteku',
    'new_item' => 'Nova stavka',
    'select_entry' => 'Odaberi stavku',
    'select_entries' => 'Odaberi stavkee',
    'upload_multiple_files_selected' => 'Odabrane datoteke. Nakon spremanja, oni će se pojaviti iznad.',

    //Table field
    'table_cant_add'    => 'Cannot add new :entity',
    'table_max_reached' => 'Maximum number of :max reached',

    // google_map
    'google_map_locate' => 'Get my location',

    // File manager
    'file_manager' => 'File Manager',

    // InlineCreateOperation
    'related_entry_created_success' => 'Related entry has been created and selected.',
    'related_entry_created_error' => 'Could not create related entry.',
    'inline_saving' => 'Saving...',

    // returned when no translations found in select inputs
    'empty_translations' => '(empty)',

    // The pivot selector required validation message
    'pivot_selector_required_validation_message' => 'The pivot field is required.',
];
