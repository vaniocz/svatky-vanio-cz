<?php

// input

try {
    $date = new \DateTimeImmutable($_GET['date']);
    if (!$date) {
        $date = new \DateTimeImmutable;
    }
} catch (\Exception $e) {
    $date = new \DateTimeImmutable;
}

$year = (int) $date->format('Y');
$month = (int) $date->format('n');
$day = (int) $date->format('j');

// constants

$months = [
    1 => ['nominative' => 'leden', 'genitive' => 'ledna'],
    ['nominative' => 'únor', 'genitive' => 'února'],
    ['nominative' => 'březen', 'genitive' => 'března'],
    ['nominative' => 'duben', 'genitive' => 'dubna'],
    ['nominative' => 'květen', 'genitive' => 'května'],
    ['nominative' => 'červen', 'genitive' => 'června'],
    ['nominative' => 'červenec', 'genitive' => 'července'],
    ['nominative' => 'srpen', 'genitive' => 'srpna'],
    ['nominative' => 'září', 'genitive' => 'září'],
    ['nominative' => 'říjen', 'genitive' => 'října'],
    ['nominative' => 'listopad', 'genitive' => 'listopadu'],
    ['nominative' => 'prosinec', 'genitive' => 'prosince'],
];

$dows = ['neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota'];

$names = [
 1 => [1 => 'Nový rok', 'Karina', 'Radmila', 'Diana', 'Dalimil', 'Tři králové', 'Vilma', 'Čestmír', 'Vladan', 'Břetislav', 'Bohdana', 'Pravoslav', 'Edita', 'Radovan', 'Alice', 'Ctirad', 'Drahoslav', 'Vladislav', 'Doubravka', 'Ilona', 'Běla', 'Slavomír', 'Zdeněk', 'Milena', 'Miloš', 'Zora', 'Ingrid', 'Otýlie', 'Zdislava', 'Robin', 'Marika'],
 [1 => 'Hynek', 'Nela a Hromnice', 'Blažej', 'Jarmila', 'Dobromila', 'Vanda', 'Veronika', 'Milada', 'Apolena', 'Mojmír', 'Božena', 'Slavěna', 'Věnceslav', 'Valentýn', 'Jiřina', 'Ljuba', 'Miloslava', 'Gizela', 'Patrik', 'Oldřich', 'Lenka', 'Petr', 'Svatopluk', 'Matěj', 'Liliana', 'Dorota', 'Alexandr', 'Lumír', 'Horymír'],
 [1 => 'Bedřich', 'Anežka', 'Kamil', 'Stela', 'Kazimír', 'Miroslav', 'Tomáš', 'Gabriela', 'Františka', 'Viktorie', 'Anděla', 'Řehoř', 'Růžena', 'Rút a Matylda', 'Ida', 'Elena a Herbert', 'Vlastimil', 'Eduard', 'Josef', 'Světlana', 'Radek', 'Leona', 'Ivona', 'Gabriel', 'Marián', 'Emanuel', 'Dita', 'Soňa', 'Taťána', 'Arnošt', 'Kvido'],
 [1 => 'Hugo', 'Erika', 'Richard', 'Ivana', 'Miroslava', 'Vendula', 'Heřman a Hermína', 'Ema', 'Dušan', 'Darja', 'Izabela', 'Julius', 'Aleš', 'Vincenc', 'Anastázie', 'Irena', 'Rudolf', 'Valérie', 'Rostislav', 'Marcela', 'Alexandra', 'Evžénie', 'Vojtěch', 'Jiří', 'Marek', 'Oto', 'Jaroslav', 'Vlastislav', 'Robert', 'Blahoslav'],
 [1 => 'Svátek práce', 'Zikmund', 'Alexej', 'Květoslav', 'Klaudie', 'Radoslav', 'Stanislav', 'Statní svátek - Ukončení II. světové války', 'Ctibor', 'Blažena', 'Svatava', 'Pankrác', 'Servác', 'Bonifác', 'Žofie', 'Přemysl', 'Aneta', 'Nataša', 'Ivo', 'Zbyšek', 'Monika', 'Emil', 'Vladimír', 'Jana', 'Viola', 'Filip', 'Valdemar', 'Vilém', 'Maxim', 'Ferdinand', 'Kamila'],
 [1 => 'Laura', 'Jarmil', 'Tamara', 'Dalibor', 'Dobroslav', 'Norbert', 'Iveta', 'Medard', 'Stanislava', 'Gita', 'Bruno', 'Antonie', 'Antonín', 'Roland', 'Vít', 'Zbyněk', 'Adolf', 'Milan', 'Leoš', 'Květa', 'Alois', 'Pavla', 'Zdeňka', 'Jan', 'Ivan', 'Adriana', 'Ladislav', 'Lubomír', 'Petr a Pavel', 'Šárka'],
 [1 => 'Jaroslava', 'Patricie', 'Radomír', 'Prokop', 'Cyril a Metoděj', 'Jan Hus', 'Bohuslava', 'Nora', 'Drahoslava', 'Libuše a Amálie', 'Olga', 'Bořek', 'Markéta', 'Karolína', 'Jindřich', 'Luboš', 'Martina', 'Drahomíra', 'Čeněk', 'Ilja', 'Vítězslav', 'Magdaléna', 'Libor', 'Kristýna', 'Jakub', 'Anna', 'Věroslav', 'Viktor', 'Marta', 'Bořivoj', 'Ignác'],
 [1 => 'Oskar', 'Gustav', 'Miluše', 'Dominik', 'Kristián', 'Oldřiška', 'Lada', 'Soběslav', 'Roman', 'Vavřinec', 'Zuzana', 'Klára', 'Alena', 'Alan', 'Hana', 'Jáchym', 'Petra', 'Helena', 'Ludvík', 'Bernard', 'Johana', 'Bohuslav', 'Sandra', 'Bartoloměj', 'Radim', 'Luděk', 'Otakar', 'Augustýn', 'Evelína', 'Vladěna', 'Pavlína'],
 [1 => 'Linda a Samuel', 'Adéla', 'Bronislav', 'Jindřiška', 'Boris', 'Boleslav', 'Regína', 'Mariana', 'Daniela', 'Irma', 'Denisa', 'Marie', 'Lubor', 'Radka', 'Jolana', 'Ludmila', 'Naděžda', 'Kryštof', 'Zita', 'Oleg', 'Matouš', 'Darina', 'Berta', 'Jaromír', 'Zlata', 'Andrea', 'Jonáš', 'Václav', 'Michal', 'Jeroným'],
 [1 => 'Igor', 'Olívie a Oliver', 'Bohumil', 'František', 'Eliška', 'Hanuš', 'Justýna', 'Věra', 'Štefan a Sára', 'Marina', 'Andrej', 'Marcel', 'Renáta', 'Agáta', 'Tereza', 'Havel', 'Hedvika', 'Lukáš', 'Michaela', 'Vendelín', 'Brigita', 'Sabina', 'Teodor', 'Nina', 'Beáta', 'Erik', 'Šarlota a Zoe', 'Jidáš', 'Silvie', 'Tadeáš', 'Štěpánka'],
 [1 => 'Felix', 'Památka zesnulých', 'Hubert', 'Karel', 'Miriam', 'Liběna', 'Saskie', 'Bohumír', 'Bohdan', 'Evžen', 'Martin', 'Benedikt', 'Tibor', 'Sáva', 'Leopold', 'Otmar', 'Mahulena', 'Romana', 'Alžběta', 'Nikola', 'Albert', 'Cecílie', 'Klement', 'Emílie', 'Kateřina', 'Artur', 'Xenie', 'René', 'Zina', 'Ondřej'],
 [1 => 'Iva', 'Blanka', 'Svatoslav', 'Barbora', 'Jitka', 'Mikuláš', 'Ambrož', 'Květoslava', 'Vratislav', 'Julie', 'Dana', 'Simona', 'Lucie', 'Lýdie', 'Radana', 'Albína', 'Daniel', 'Miloslav', 'Ester', 'Dagmar', 'Natálie', 'Šimon', 'Vlasta', 'Adam a Eva', 'Boží hod - 1. svátek vánoční', 'Štěpán', 'Žaneta', 'Bohumila', 'Judita', 'David', 'Silvestr'],
];

$holidays = [
    1 => [
        1 => [ 2001 => 'Den obnovy samostatného českého státu', 1951 => 'Nový rok' ],
    ],
    5 => [
        1 => [ 1951 => 'Svátek práce' ],
        8 => [ 2004 => 'Den vítězství', 2001 => 'Den osvobození', 1992 => 'Den osvobození od fašismu' ],
        9 => [ 1992 => null, 1951 => 'Den vítězství nad hitlerovským fašismem a osvobození naší vlasti Sovětskou armádou' ],
    ],
    7 => [
        5 => [ 1990 => 'Den slovanských věrozvěstů Cyrila a Metoděje' ],
        6 => [ 1990 => 'Den upálení mistra Jana Husa' ],
    ],
    9 => [
        28 => [ 2000 => 'Den české státnosti' ],
    ],
    10 => [
        28 => [ 1988 => 'Den vzniku samostatného československého státu' ],
    ],
    11 => [
        17 => [ 2000 => 'Den boje za svobodu a demokracii' ],
    ],
    12 => [
        24 => [ 1990 => 'Štědrý den' ],
        25 => [ 1951 => '1. svátek vánoční' ],
        26 => [ 1951 => '2. svátek vánoční' ],
    ],
];

// evaluate public holidays

$holidayName = '';
if (isset($holidays[$month][$day])) {
    foreach ($holidays[$month][$day] as $validityYear => $description) {
        if ($year >= $validityYear) {
            if ($description !== null) {
                $holidayName = $description; 
            }
            break;
        }
    }
}

if ( $year >= 1951 ) {
    $springDate = new \DateTimeImmutable("$year-03-21");
    $daysToEaster = easter_days($year);
    $daysToEasterMonday = $daysToEaster + 1;
    $easterMonday = $springDate->add(new \DateInterval("P{$daysToEasterMonday}D"));
    if ($easterMonday->format('Y-m-d') === $date->format('Y-m-d')) {
        $holidayName = 'Velikonoční pondělí';
    } else if ( $year >= 2016 ) {
        $daysToEasterFriday = $daysToEaster - 2;
        $easterFriday = $springDate->add(new \DateInterval("P{$daysToEasterFriday}D"));
        if ($easterFriday->format('Y-m-d') === $date->format('Y-m-d')) {
            $holidayName = 'Velký pátek';
        }
    }
}

// compose output

$output = [];
$output['date'] = $date->format('Y-m-d');
$output['month'] = $months[$month];
$output['dow'] = $dows[$date->format('N')];
$output['name'] = $names[$month][$day];
$output['isPublicHoliday'] = $holidayName !== '';
if ($output['isPublicHoliday']) {
    $output['holidayName'] = $holidayName;
}


// assemble response

if (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
    echo json_encode($output);
} else if (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') !== false) {
    echo '<html><head><meta charset="utf-8"></head><body><dl>';
    foreach($output as $name => $value) {
        if (is_array($value)) {
            foreach($value as $subName => $subValue) {
                echo "<dt>$name $subName</dt><dd>$subValue</dd>"; 
            }
        
        } else {
            $value = is_bool($value) ? (int) $value : $value;
            echo "<dt>$name</dt><dd>$value</dd>"; 
        }
    }
    echo '</dl></body></html>';
} else {
    foreach($output as $name => $value) {
        if (is_array($value)) {
            foreach($value as $subName => $subValue) {
                echo "$name $subName: $subValue\n"; 
            }
        
        } else {
            $value = is_bool($value) ? (int) $value : $value;
            echo "$name: $value\n"; 
        }
    }
}
