<?php

namespace Company;

use Company\Staff\Employee;

class Manager extends Person
{
    private array $employees = [];

    public function addEmployee(Employee $employee): void
    {
        $this->employees[] = $employee;
    }

    public function getEmployees(): array
    {
        return $this->employees;
    }
}
