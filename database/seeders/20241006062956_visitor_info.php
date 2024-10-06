<?php

require_once "util/database/DbSeeder.php";

$seeder = new DbSeeder('visitor_info');

$visitors = [
    [
        'fname' => 'Taylor',
        'lname' => 'Swift',
        'purpose' => 'Visit the City Hall',
        'office' => 'CEBU CITY MEDICAL CENTER',
        'division' => 'Administrative',
        'type' => 'Visitor'
    ],
    [
        'fname' => 'Ariana',
        'lname' => 'Grande',
        'purpose' => 'Meet with the Mayor',
        'office' => 'OFFICE OF THE MAYOR',
        'division' => 'Client Support',
        'type' => 'Visitor'
    ],
    [
        'fname' => 'Olivia',
        'lname' => 'Rodrigo',
        'purpose' => 'Attend a meeting',
        'office' => 'CEBU CITY ENVIRONMENT AND NATURAL RESOURCES OFFICE',
        'division' => 'Technical Support',
        'type' => 'Visitor'
    ],
    [
        'fname' => 'Justin',
        'lname' => 'Bieber',
        'purpose' => 'Visit the City Health Department',
        'office' => 'CITY HEALTH DEPARTMENT',
        'division' => 'Developers',
        'type' => 'Visitor'
    ],
    [
        'fname' => 'Lady',
        'lname' => 'Gaga',
        'purpose' => 'Inspect the facilities',
        'office' => 'PEACE AND ORDER PROGRAM',
        'division' => 'Administrative',
        'type' => 'Visitor'
    ]
];

$employees = [
    [
        'employee_id' => '29381',
        'fname' => 'Nicki',
        'lname' => 'Minaj',
        'purpose' => 'Work at the Office of the City Accountant',
        'office' => 'OFFICE OF THE CITY ACCOUNTANT',
        'division' => 'Administrative',
        'type' => 'Employee'
    ],
    [
        'employee_id' => '12345',
        'fname' => 'Katy',
        'lname' => 'Perry',
        'purpose' => 'Work at the CEBU CITY MEDICAL CENTER',
        'office' => 'CEBU CITY MEDICAL CENTER',
        'division' => 'Client Support',
        'type' => 'Employee'
    ],
    [
        'employee_id' => '67890',
        'fname' => 'Beyoncé',
        'lname' => 'Knowles-Carter',
        'purpose' => 'Work at the CEBU CITY ENVIRONMENT AND NATURAL RESOURCES OFFICE',
        'office' => 'CEBU CITY ENVIRONMENT AND NATURAL RESOURCES OFFICE',
        'division' => 'Technical Support',
        'type' => 'Employee'
    ],
    [
        'employee_id' => '11111',
        'fname' => 'Rihanna',
        'lname' => 'Fenty',
        'purpose' => 'Work at the CITY HEALTH DEPARTMENT',
        'office' => 'CITY HEALTH DEPARTMENT',
        'division' => 'Developers',
        'type' => 'Employee'
    ],
    [
        'employee_id' => '22222',
        'fname' => 'Abel',
        'lname' => 'Tesfaye',
        'purpose' => 'Work at the PEACE AND ORDER PROGRAM',
        'office' => 'PEACE AND ORDER PROGRAM',
        'division' => 'Administrative',
        'type' => 'Employee'
    ]
];

$visitor_info = array_merge($visitors, $employees);

echo $seeder->seed($visitor_info, true);