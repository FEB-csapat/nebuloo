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

    'accepted' => ':attribute el kell fogadni.',
    'accepted_if' => ':attribute csak akkor fogadható el, ha :other :value.',
    'active_url' => ':attribute nem érvényes URL.',
    'after' => ':attribute dátumának :date utáni dátumnak kell lennie.',
    'after_or_equal' => ':attribute dátumának :date utáni vagy azonos dátumnak kell lennie.',
    'alpha' => ':attribute csak betűket tartalmazhat.',
    'alpha_dash' => ':attribute csak betűket, számokat, kötőjeleket és alsó vonásokat tartalmazhat.',
    'alpha_num' => ':attribute csak betűket és számokat tartalmazhat.',
    'array' => ':attribute tömbnek kell lennie.',
    'before' => ':attribute dátumának :date előtti dátumnak kell lennie.',
    'before_or_equal' => ':attribute dátumának :date előtti vagy azonos dátumnak kell lennie.',
    'between' => [
        'array' => ':attribute :min és :max közötti elemet kell tartalmazzon.',
        'file' => ':attribute :min és :max kilobájt közötti méretű kell legyen.',
        'numeric' => ':attribute :min és :max közötti értékű kell legyen.',
        'string' => ':attribute :min és :max karakter közötti hosszúságú kell legyen.',
    ],
    'boolean' => ':attribute mezőnek igaznak vagy hamisnak kell lennie.',
    'confirmed' => ':attribute megerősítése nem egyezik meg.',
    'current_password' => 'A jelszó helytelen.',
    'date' => ':attribute nem érvényes dátum.',
    'date_equals' => ':attribute dátumának egyeznie kell a következővel: :date.',
    'date_format' => ':attribute nem felel meg a következő formátumnak: :format.',
    'declined' => ':attribute elutasításra került.',
    'declined_if' => ':attribute csak akkor utasítható el, ha :other :value.',
    'different' => ':attribute és :other különbözőnek kell lenniük.',
    'digits' => ':attribute :digits számjegyből kell álljon.',
    'digits_between' => ':attribute :min és :max közötti számjegynek kell lennie.',
    'dimensions' => ':attribute érvénytelen képméreteket tartalmaz.',
    'distinct' => ':attribute mező duplikált értéket tartalmaz.',
    'doesnt_end_with' => ':attribute nem végződhet az alábbiak egyikével: :values.',
    'doesnt_start_with' => ':attribute nem kezdődhet az alábbiak egyikével: :values.',
    'email' => ':attribute érvényes email cím kell legyen.',
    'ends_with' => ':attribute az alábbiakkal kell végződjön: :values.',
    'enum' => 'A kiválasztott :attribute érvénytelen.',
    'exists' => 'A kiválasztott :attribute érvénytelen',

    
    'file' => 'A(z) :attribute fájlnak kell lennie.',
    'filled' => 'A(z) :attribute mezőnek értéket kell tartalmaznia.',
    'gt' => [
        'array' => 'A(z) :attribute több, mint :value elemet kell, hogy tartalmazzon.',
        'file' => 'A(z) :attribute mérete nagyobb kell, hogy legyen, mint :value kilobájt.',
        'numeric' => 'A(z) :attribute nagyobb kell, hogy legyen, mint :value.',
        'string' => 'A(z) :attribute hossza nagyobb kell, hogy legyen, mint :value karakter.',
    ],
    'gte' => [
        'array' => 'A(z) :attribute legalább :value elemet kell, hogy tartalmazzon.',
        'file' => 'A(z) :attribute mérete legalább :value kilobájt kell, hogy legyen.',
        'numeric' => 'A(z) :attribute legalább :value kell, hogy legyen.',
        'string' => 'A(z) :attribute hossza legalább :value karakter kell, hogy legyen.',
    ],
    'image' => 'A(z) :attribute képnek kell lennie.',
    'in' => 'A kiválasztott :attribute érvénytelen.',
    'in_array' => 'A(z) :attribute mező nem létezik a(z) :other-ben.',
    'integer' => 'A(z) :attribute szám egésznek kell lennie.',
    'ip' => 'A(z) :attribute érvényes IP címnek kell lennie.',
    'ipv4' => 'A(z) :attribute érvényes IPv4 címnek kell lennie.',
    'ipv6' => 'A(z) :attribute érvényes IPv6 címnek kell lennie.',
    'json' => 'A(z) :attribute érvényes JSON karakterlánynak kell lennie.',
    'lt' => [
        'array' => 'A(z) :attribute kevesebb, mint :value elemet kell, hogy tartalmazzon.',
        'file' => 'A(z) :attribute mérete kisebb kell, hogy legyen, mint :value kilobájt.',
        'numeric' => 'A(z) :attribute kisebb kell, hogy legyen, mint :value.',
        'string' => 'A(z) :attribute hossza kisebb kell, hogy legyen, mint :value karakter.',
    ],
    'lte' => [
        'array' => 'A(z) :attribute nem lehet több, mint :value elemet tartalmazni.',
        'file' => 'A(z) :attribute mérete legfeljebb :value kilobájt lehet.',
        'numeric' => 'A(z) :attribute legfeljebb :value lehet.',
        'string' => 'A(z) :attribute hossza legfeljebb :value karakter lehet.',
    ],
    'mac_address' => 'A(z) :attribute érvényes MAC címnek kell lennie.',
    


    'max' => [
        'array' => 'A(z) :attribute nem lehet több, mint :max elem.',
        'file' => 'A(z) :attribute mérete nem lehet nagyobb, mint :max kilobájt.',
        'numeric' => 'A(z) :attribute értéke nem lehet nagyobb, mint :max.',
        'string' => 'A(z) :attribute hossza nem lehet nagyobb, mint :max karakter.',
    ],
    'max_digits' => 'A(z) :attribute nem lehet több, mint :max számjegy.',
    'mimes' => 'A(z) :attribute fájltípusa :values kell legyen.',
    'mimetypes' => 'A(z) :attribute fájltípusa :values kell legyen.',
    'min' => [
        'array' => 'A(z) :attribute legalább :min elemet kell tartalmazzon.',
        'file' => 'A(z) :attribute mérete legalább :min kilobájt kell legyen.',
        'numeric' => 'A(z) :attribute értéke legalább :min kell legyen.',
        'string' => 'A(z) :attribute hossza legalább :min karakter kell legyen.',
    ],
    'min_digits' => 'A(z) :attribute legalább :min számjegyet kell tartalmazzon.',
    'multiple_of' => 'A(z) :attribute értéke többszöröse kell legyen a(z) :value értéknek.',
    'not_in' => 'A kiválasztott :attribute érvénytelen.',
    'not_regex' => 'A(z) :attribute formátuma érvénytelen.',
    'numeric' => 'A(z) :attribute szám kell legyen.',
    'password' => [
        'letters' => 'A(z) :attribute legalább egy betűt tartalmaznia kell.',
        'mixed' => 'A(z) :attribute legalább egy nagybetűt, és egy kisbetűt is tartalmaznia kell.',
        'numbers' => 'A(z) :attribute legalább egy számot tartalmaznia kell.',
        'symbols' => 'A(z) :attribute legalább egy szimbólumot tartalmaznia kell.',
        'uncompromised' => 'A(z) :attribute előfordult egy adatszivárgásban. Kérjük válasszon másik :attribute értéket.',
    ],
    'present' => 'A(z) :attribute mező jelen kell legyen.',
    'prohibited' => 'A(z) :attribute mező tilos.',
    'prohibited_if' => 'A(z) :attribute mező tilos, ha a(z) :other értéke :value.',
    'prohibited_unless' => 'A(z) :attribute mező tilos, hacsak a(z) :other értéke a következők között nincs: :values.',
    'prohibits' => 'A(z) :attribute mező megakadályozza a(z) :other jelenlétét.',
    'regex' => 'A(z) :attribute formátuma érvénytelen.',
    'required' => 'A(z) :attribute mező kötelező.',


    'required_array_keys' => ':attribute mezőnek tartalmaznia kell az alábbi bejegyzéseket: :values.',
    'required_if' => 'A(z) :attribute mező kitöltése szükséges, ha a(z) :other értéke :value.',
    'required_if_accepted' => 'A(z) :attribute mező kitöltése szükséges, ha a(z) :other elfogadva van.',
    'required_unless' => 'A(z) :attribute mező kitöltése szükséges, hacsak a(z) :other értéke :values közé nem tartozik.',
    'required_with' => 'A(z) :attribute mező kitöltése szükséges, ha a(z) :values jelen van.',
    'required_with_all' => 'A(z) :attribute mező kitöltése szükséges, ha a(z) :values jelen van.',
    'required_without' => 'A(z) :attribute mező kitöltése szükséges, ha a(z) :values nem jelen van.',
    'required_without_all' => 'A(z) :attribute mező kitöltése szükséges, ha a(z) :values egyike sem jelenik meg.',
    'same' => 'A(z) :attribute és a(z) :other mezőnek egyezniük kell.',
    'size' => [
        'array' => 'A(z) :attribute mezőnek :size elemet kell tartalmaznia.',
        'file' => 'A(z) :attribute fájlnak :size kilobájt méretűnek kell lennie.',
        'numeric' => 'A(z) :attribute értékének :size-nek kell lennie.',
        'string' => 'A(z) :attribute szövegnek :size karakter hosszúnak kell lennie.',
    ],
    'starts_with' => 'A(z) :attribute mezőnek az alábbiakkal kell kezdődnie: :values.',
    'string' => 'A(z) :attribute mezőnek szövegnek kell lennie.',
    'timezone' => 'A(z) :attribute mezőnek érvényes időzónának kell lennie.',
    'unique' => 'A(z) :attribute már foglalt.',
    'uploaded' => 'A(z) :attribute feltöltése nem sikerült.',
    'url' => 'A(z) :attribute érvényes URL-nek kell lennie.',
    'uuid' => 'A(z) :attribute érvényes UUID-nak kell lennie.',

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
