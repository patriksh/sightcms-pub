<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute mora biti prihvaćen.',
    'accepted_if' => ':attribute mora biti prihvaćen kada je :other :value.',
    'active_url' => ':attribute nije valjani URL.',
    'after' => ':attribute mora biti datum nakon :date.',
    'after_or_equal' => ':attribute mora biti datum nakon ili jednak :date.',
    'alpha' => ':attribute može sadržavati samo slova.',
    'alpha_dash' => ':attribute može sadržavati samo slova, brojeve, crtice i donje crte.',
    'alpha_num' => ':attribute može sadržavati samo slova i brojeve.',
    'array' => ':attribute mora biti niz.',
    'ascii' => ':attribute može sadržavati samo jednobajtna alfanumerička slova i simbole.',
    'before' => ':attribute mora biti datum prije :date.',
    'before_or_equal' => ':attribute mora biti datum prije ili jednak :date.',
    'between' => [
        'array' => ':attribute mora imati između :min i :max stavki.',
        'file' => ':attribute mora biti između :min i :max kilobajta.',
        'numeric' => ':attribute mora biti između :min i :max.',
        'string' => ':attribute mora biti između :min i :max znakova.',
    ],
    'boolean' => ':attribute mora biti istina ili laž.',
    'confirmed' => 'Potvrda :attribute nije ispravna.',
    'current_password' => 'Lozinka nije ispravna.',
    'date' => ':attribute nije valjani datum.',
    'date_equals' => ':attribute mora biti datum jednak :date.',
    'date_format' => ':attribute ne odgovara formatu :format.',
    'decimal' => ':attribute mora imati :decimal decimalna mjesta.',
    'declined' => ':attribute mora biti odbijen.',
    'declined_if' => ':attribute mora biti odbijen kada je :other :value.',
    'different' => ':attribute i :other moraju biti različiti.',
    'digits' => ':attribute mora imati :digits znamenaka.',
    'digits_between' => ':attribute mora biti između :min i :max znamenki.',
    'dimensions' => ':attribute ima nevaljane dimenzije slike.',
    'distinct' => 'Polje :attribute ima duplu vrijednost.',
    'doesnt_end_with' => ':attribute ne smije završavati s jednim od sljedećeg: :values.',
    'doesnt_start_with' => ':attribute ne smije započeti s jednim od sljedećeg: :values.',
    'email' => ':attribute mora biti valjana e-mail adresa.',
    'ends_with' => ':attribute mora završavati s jednim od sljedećeg: :values.',
    'enum' => 'Odabrani :attribute je nevažeći.',
    'exists' => 'Odabrani :attribute je nevažeći.',
    'file' => 'Polje :attribute mora biti datoteka.',
    'filled' => 'Polje :attribute mora imati vrijednost.',
    'gt' => [
        'array' => 'Polje :attribute mora imati više od :value stavki.',
        'file' => 'Polje :attribute mora biti veće od :value kilobajta.',
        'numeric' => 'Polje :attribute mora biti veće od :value.',
        'string' => 'Polje :attribute mora biti duže od :value znakova.',
    ],
    'gte' => [
        'array' => 'Polje :attribute mora imati :value stavki ili više.',
        'file' => 'Polje :attribute mora biti veće ili jednako :value kilobajta.',
        'numeric' => 'Polje :attribute mora biti veće ili jednako :value.',
        'string' => 'Polje :attribute mora biti duže ili jednako :value znakova.',
    ],
    'image' => 'Polje :attribute mora biti slika.',
    'in' => 'Odabrano polje :attribute je nevažeće.',
    'in_array' => 'Polje :attribute ne postoji u :other.',
    'integer' => 'Polje :attribute mora biti cijeli broj.',
    'ip' => 'Polje :attribute mora biti valjana IP adresa.',
    'ipv4' => 'Polje :attribute mora biti valjana IPv4 adresa.',
    'ipv6' => 'Polje :attribute mora biti valjana IPv6 adresa.',
    'json' => 'Polje :attribute mora biti valjan JSON string.',
    'lowercase' => 'Polje :attribute mora biti malim slovima.',
    'lt' => [
        'array' => ':Attribute mora imati manje od :value stavki.',
        'file' => ':Attribute mora biti manje od :value kilobajta.',
        'numeric' => ':Attribute mora biti manje od :value.',
        'string' => ':Attribute mora biti kraće od :value znakova.',
    ],
    'lte' => [
        'array' => ':Attribute ne smije imati više od :value stavki.',
        'file' => ':Attribute mora biti manje ili jednako :value kilobajta.',
        'numeric' => ':Attribute mora biti manje ili jednako :value.',
        'string' => ':Attribute mora biti kraće ili jednako :value znakova.',
    ],
    'mac_address' => ':Attribute mora biti valjana MAC adresa.',
    'max' => [
        'array' => ':Attribute ne smije imati više od :max stavki.',
        'file' => ':Attribute ne smije biti veće od :max kilobajta.',
        'numeric' => ':Attribute ne smije biti veće od :max.',
        'string' => ':Attribute ne smije biti duže od :max znakova.',
    ],
    'max_digits' => ':Attribute ne smije imati više od :max znamenki.',
    'mimes' => ':Attribute mora biti datoteka tipa: :values.',
    'mimetypes' => ':Attribute mora biti datoteka tipa: :values.',
    'min' => [
        'array' => ':Attribute mora imati najmanje :min stavki.',
        'file' => ':Attribute mora biti najmanje :min kilobajta.',
        'numeric' => ':Attribute mora biti najmanje :min.',
        'string' => ':Attribute mora biti najmanje :min znakova.',
    ],
    'min_digits' => 'Polje :attribute mora sadržavati najmanje :min znamenki.',
    'missing' => 'Polje :attribute mora nedostajati.',
    'missing_if' => 'Polje :attribute mora nedostajati kada je :other :value.',
    'missing_unless' => 'Polje :attribute mora nedostajati osim ako je :other :value.',
    'missing_with' => 'Polje :attribute mora nedostajati kada je :values prisutan.',
    'missing_with_all' => 'Polje :attribute mora nedostajati kada su prisutni :values.',
    'multiple_of' => ':attribute mora biti višekratnik od :value.',
    'not_in' => 'Odabrano polje :attribute je nevažeće.',
    'not_regex' => 'Format polja :attribute nije važeći.',
    'numeric' => 'Polje :attribute mora biti broj.',
    'password' => [
        'letters' => 'Polje :attribute mora sadržavati barem jedno slovo.',
        'mixed' => 'Polje :attribute mora sadržavati barem jedno veliko i jedno malo slovo.',
        'numbers' => 'Polje :attribute mora sadržavati barem jedan broj.',
        'symbols' => 'Polje :attribute mora sadržavati barem jedan simbol.',
        'uncompromised' => 'Polje :attribute se pojavljuje u jednom od nedavnih curenja podataka. Molimo odaberite drugo :attribute.',
    ], 
    'present' => 'Polje :attribute mora biti prisutno.',
    'prohibited' => 'Polje :attribute je zabranjeno.',
    'prohibited_if' => 'Polje :attribute je zabranjeno kada je :other :value.',
    'prohibited_unless' => 'Polje :attribute je zabranjeno, osim ako je :other u :values.',
    'prohibits' => 'Polje :attribute zabranjuje prisutnost polja :other.',
    'regex' => 'Format polja :attribute nije ispravan.',
    'required' => 'Polje :attribute je obavezno.',
    'required_array_keys' => 'Polje :attribute mora sadržavati unose za: :values.',
    'required_if' => 'Polje :attribute je obavezno kada je :other :value.',
    'required_if_accepted' => 'Polje :attribute je obavezno kada je :other prihvaćeno.',
    'required_unless' => 'Polje :attribute je obavezno, osim ako je :other u :values.',
    'required_with' => 'Polje :attribute je obavezno kada je prisutno polje :values.',
    'required_with_all' => 'Polje :attribute je obavezno kada su prisutna polja :values.',
    'required_without' => 'Polje :attribute je obavezno kada nije prisutno polje :values.',
    'required_without_all' => 'Polje :attribute je obavezno kada nisu prisutna polja :values.',
    'same' => 'Polja :attribute i :other se moraju podudarati.',
    'size' => [
        'array' => ':attribute mora sadržavati :size stavki.',
        'file' => ':attribute mora biti :size kilobajta.',
        'numeric' => ':attribute mora biti :size.',
        'string' => ':attribute mora biti :size znakova.',
    ],
    'starts_with' => ':attribute mora početi s jednim od sljedećeg: :values.',
    'string' => ':attribute mora biti niz znakova.',
    'timezone' => ':attribute mora biti valjana vremenska zona.',
    'unique' => ':attribute već postoji.',
    'uploaded' => ':attribute nije uspješno prenesen.',
    'uppercase' => ':attribute mora biti napisan velikim slovima.',
    'url' => ':attribute mora biti valjani URL.',
    'ulid' => ':attribute mora biti valjani ULID.',
    'uuid' => ':attribute mora biti valjani UUID.',
    
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
