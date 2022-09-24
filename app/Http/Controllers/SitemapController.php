<?php

namespace App\Http\Controllers;


use App\Models\Lidata;

use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use File;
use App\Models\Country;

use Auth;

class SitemapController extends Controller
{

    public function generateSiteMap()
    {
        // $sitemap = Sitemap::create();
        // $sitemap->add(Url::create("/people/male"));

        $sitemap = SitemapGenerator::create('https://lidata.io')->getSitemap();
        $sitemap->writeToFile(public_path('main_sitemap.xml'));


        $userData = Lidata::select('id', 'person_first_name_unanalyzed', 'person_last_name_unanalyzed')->get(); //->take(56000)
        $sitemap = Sitemap::create();
        $count = 0;
        $number = 1;
        foreach ($userData as $key => $value) {
            $sitemap->add(Url::create("/user/{$value->id}/{$value->person_first_name_unanalyzed}-{$value->person_last_name_unanalyzed}"));

            $count += 1;
            if ($count == 10000) {
                $sitemap->writeToFile(public_path('sitemap' . $number . '.xml'));

                $sitemap = Sitemap::create();
                $count = 0;
                $number++;
            }
        }

        $companyData = Lidata::select('id', 'organization_name')->get(); //->take(56000)

        foreach ($companyData as $key => $value) {
            $sitemap->add(Url::create("user-company/{$value->id}/{$value->organization_name}"));

            $count += 1;
            if ($count == 10000) {
                $sitemap->writeToFile(public_path('sitemap' . $number . '.xml'));

                $sitemap = Sitemap::create();
                $count = 0;
                $number++;
            }
        }
        $sitemap->writeToFile(public_path('sitemap_last_data.xml'));

        return redirect()->back()->with('message', 'Sitemap Generated Successfully!');
    }

    public function sitemapFileList()
    {
        $files = File::files(public_path());
        date_default_timezone_set("Asia/Dhaka");

        $fileName = [];
        foreach ($files as $key => $file) {
            $full_name = $file->getFileName();
            $lastModified = date("Y-m-d H:i A", filemtime($file));

            $name = explode('.', $full_name);
            if (isset($name[1]) && $name[1] == 'xml') {
                $single_file = [
                    'name' => $full_name,
                    'modified' => $lastModified,
                ];

                array_push($fileName, $single_file);
            }
        }
        return view('sitemap.file-list', ['files' => $fileName]);
    }

    public function sitemapFileDetails($file_name)
    {
        date_default_timezone_set("Asia/Dhaka");
        $xmlDataString = file_get_contents(public_path($file_name));
        $xmlObject = simplexml_load_string($xmlDataString);

        $json = json_encode($xmlObject);
        $xmlFileArray = json_decode($json, true);

        // echo "<pre>"; 
        // print_r($xmlFileArray);
        // exit();

        return view('sitemap.file-details', ['fileData' => $xmlFileArray, 'file_name' => $file_name]);
    }
}
