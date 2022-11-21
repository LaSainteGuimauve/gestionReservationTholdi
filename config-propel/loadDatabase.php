<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'default' => 
  array (
    0 => '\\App\\Http\\Model\\Map\\DevisTableMap',
    1 => '\\App\\Http\\Model\\Map\\DureeTableMap',
    2 => '\\App\\Http\\Model\\Map\\PaysTableMap',
    3 => '\\App\\Http\\Model\\Map\\ReservationTableMap',
    4 => '\\App\\Http\\Model\\Map\\ReserverTableMap',
    5 => '\\App\\Http\\Model\\Map\\TarificationcontainerTableMap',
    6 => '\\App\\Http\\Model\\Map\\TypecontainerTableMap',
    7 => '\\App\\Http\\Model\\Map\\UtilisateurTableMap',
    8 => '\\App\\Http\\Model\\Map\\VilleTableMap',
  ),
));
