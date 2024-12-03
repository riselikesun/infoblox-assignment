<?php

namespace Company\Staff;

use Company\Person;

class Employee extends Person
{
    private string $employeeID;
    private string $Designation;

    public function __construct(string $name, int $age, string $employeeID, string $Designation)
    {
        parent::__construct($name, $age);
        $this->employeeID = $employeeID;
        $this->Designation = $Designation;
    }

    public function getEmployeeId(): string
    {
        return $this->employeeID;
    }

    public function getDesignation(): string
    {
        return $this->Designation;
    }
}
