<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel
{
    public function model(array $row)
    {
        // Skip header if necessary, but ToModel usually processes all rows.
        // If the first row is the header, we might want to check for it.
        if (!isset($row[0]) || $row[0] == 'ID') {
            return null;
        }

        return new User([
            'document'  => $row[0],
            'fullname'  => $row[1],
            'gender'    => $row[2],
            'birthdate' => $row[3],
            'phone'     => $row[4],
            'email'     => $row[5],
            'password'  => Hash::make($row[6]),
        ]);
    }
}
