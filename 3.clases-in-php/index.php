<?php
// clases uses example

require_once 'Company/Person.php';
require_once 'Company/Manager.php';
require_once 'Company/Staff/Employee.php';

use Company\Manager;
use Company\Staff\Employee;

$manager = new Manager("Suresh Sah", 40);

$employee1 = new Employee('Employee 1', 25, 'ep100', 'Software Engineer');
$employee2 = new Employee('Employee 2', 30, 'ep200', 'SEO Analyst');
$employee3 = new Employee('Employee 3', 29, 'ep300', 'Seniour Software Engineer');

$manager->addEmployee($employee1);
$manager->addEmployee($employee2);
$manager->addEmployee($employee3);

// show manager details

echo "\nManager: " . $manager->getName() . "\n";
echo "Employees under " . $manager->getName() . ":\n";

foreach ($manager->getEmployees() as $employee) {
    echo  '- ' . $employee->getName() . ", " . $employee->getDesignation() . ", ID: " . $employee->getEmployeeID() . ", Age: " . $employee->getAge() . "\n";
}
