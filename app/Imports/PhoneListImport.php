<?php

namespace App\Imports;

use App\Models\PhoneList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

/**
 * @method validate(array $row, string[] $array)
 */
class PhoneListImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return float|\Illuminate\Database\Eloquent\Model|int|null
    */
    public static function checkNegative($value)
    {
        if ($value)
        {
            $value ;
            return $value;
        }
    }
    public function model(array $row)
    {
        {
            return new PhoneList([

                'phone'                     =>$row['phone'],
                'uid'                       => $row['uid'],
                'email'                     => $row['email'],
                'first_name'                => $row['first_name'],
                'last_name'                 => $row['last_name'],
                'name'                      => $row['first_name'].' '.$row['last_name'],
                'gender'                    => $row['gender'],
                'country'                   => $row['country'],
                'location'                  => $row['location'],
                'hometown'                  => $row['hometown'],
                'relationship_status'       => $row['relationship_status'],
                'education_last_year'       => $row['education_last_year'],
                'work'                      => $row['work'],
            ]);
        }

    }



}
