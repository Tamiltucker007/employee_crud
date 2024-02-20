<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $employees =  Employee::all();

        $data = $employees->map(function ($employee) {
            $employeeArray = $employee->toArray();
            unset($employeeArray['created_at'], $employeeArray['updated_at'], $employeeArray['resume'], $employeeArray['photo']);

            return $employeeArray;
        });

        return $data;
    }

    public function headings(): array
    {
        return ['S.No', 'First Name', 'Last Name', 'DOB', 'Education Qualification', 'Address', 'Email', 'Phone'];
    }
}
