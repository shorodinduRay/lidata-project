<?php

namespace App\Imports;

use App\Models\Lidata;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LidataImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Lidata([
            'person_email' => $row['person_email'],
            'person_name' => $row['person_name'],
            'person_first_name_unanalyzed' => $row['person_first_name_unanalyzed'],
            'person_last_name_unanalyzed' => $row['person_last_name_unanalyzed'],
            'person_sanitized_phone' => $row['person_sanitized_phone'],
            'person_title' => $row['person_title'],
            'person_functions' => $row['person_functions'],
            'person_detailed_function' => $row['person_detailed_function'],
            'person_seniority' => $row['person_seniority'],
            'person_location_city' => $row['person_location_city'],
            'person_location_state' => $row['person_location_state'],
            'person_location_country' => $row['person_location_country'],
            'person_location_postal_code' => $row['person_location_postal_code'],
            'person_linkedin_url' => $row['person_linkedin_url'],
            'organization_name' => $row['organization_name'],
            'organization_domain' => $row['organization_domain'],
            'organization_phone' => $row['organization_phone'],
            'organization_facebook_url' => $row['organization_facebook_url'],
            'organization_linkedin_numerical_urls' => $row['organization_linkedin_numerical_urls'],
            'organization_twitter_url' => $row['organization_twitter_url'],
            'organization_website_url' => $row['organization_website_url'],
            'organization_angellist_url' => $row['organization_angellist_url'],
            'organization_founded_year' => $row['organization_founded_year'],
            'organization_hq_location_city' => $row['organization_hq_location_city'],
            'organization_hq_location_postal_code' => $row['organization_hq_location_postal_code'],
            'organization_hq_location_state' => $row['organization_hq_location_state'],
            'organization_hq_location_country' => $row['organization_hq_location_country'],
            'organization_num_current_employees' => $row['organization_num_current_employees'],
            'organization_languages' => $row['organization_languages'],
            'organization_industries' => $row['organization_industries'],
            
        ]);
    }
}
