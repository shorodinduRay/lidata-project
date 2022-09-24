<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSetPurchasePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_purchase_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan');
            $table->integer('credit');
            $table->string('creditConvert');
            $table->integer('dataViews');
            $table->string('dataViewsConvert');
            $table->string('dataFilter');
            $table->string('csvExport');
            $table->string('icon');
            $table->integer('price');
            $table->timestamps();
        });

        DB::table('set_purchase_plans')->insert(
            array(
                'plan'=> 'Free',
                'credit' => 50,
                'creditConvert' => '50',
                'dataViews' => 50,
                'dataViewsConvert' => '50',
                'dataFilter' => 'Basic Filters',
                'csvExport' => 'CSV Export',
                'icon' => 'bi-send-fill',
                'price' => 0,
            ),
        );
        DB::table('set_purchase_plans')->insert(
            array(
                'plan'=> 'Basic',
                'credit' => 5000,
                'creditConvert' => '5K',
                'dataViews' => 5000,
                'dataViewsConvert' => '5K',
                'dataFilter' => 'Data Filters',
                'csvExport' => 'CSV Export',
                'icon' => 'bi-file-earmark-fill',
                'price' => 100,
            ),
        );
        DB::table('set_purchase_plans')->insert(
            array(
                'plan'=> 'Professional',
                'credit' => 10000,
                'creditConvert' => '10K',
                'dataViews' => 10000,
                'dataViewsConvert' => '10K',
                'dataFilter' => 'Data Filters',
                'csvExport' => 'CSV Export',
                'icon' => 'bi-award-fill',
                'price' => 190,
            ),
        );
        DB::table('set_purchase_plans')->insert(
            array(
                'plan'=> 'Business',
                'credit' => 50000,
                'creditConvert' => '50K',
                'dataViews' => 50000,
                'dataViewsConvert' => '50K',
                'dataFilter' => 'Data Filters',
                'csvExport' => 'CSV Export',
                'icon' => 'bi-briefcase-fill',
                'price' => 400,
            ),
        );
        DB::table('set_purchase_plans')->insert(
            array(
                'plan'=> 'Business Pro',
                'credit' => 300000,
                'creditConvert' => '300K',
                'dataViews' => 300000,
                'dataViewsConvert' => '300K',
                'dataFilter' => 'Data Filters',
                'csvExport' => 'CSV Export',
                'icon' => 'bi-handbag-fill',
                'price' => 1000,
            ),
        );
        DB::table('set_purchase_plans')->insert(
            array(
                'plan'=> 'Business',
                'credit' => 1000000,
                'creditConvert' => '1M',
                'dataViews' => 1000000,
                'dataViewsConvert' => '1M',
                'dataFilter' => 'Data Filters',
                'csvExport' => 'CSV Export',
                'icon' => 'bi-briefcase-fill',
                'price' => 1500,
            ),
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('set_purchase_plans');
    }
}
