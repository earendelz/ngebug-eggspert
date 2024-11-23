<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    public function model(array $row)
    {
        return new User([
            'username' => $row[0],
            'password' => bcrypt($row[1]),
            'nama' => $row[2],
            'email' => $row[3],
            'alamat' => $row[4],
        ]);
    }
}
