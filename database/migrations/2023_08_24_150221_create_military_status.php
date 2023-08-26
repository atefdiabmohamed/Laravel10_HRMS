<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('military_status', function (Blueprint $table) {
            $table->id();
            $table->string('name', 225);
            $table->tinyInteger('active')->default(1);
        });

        DB::table('military_status')->insert(
            [
             ['name'=>' أدي اخدمة',
             'active'=>1,
            ],
            ['name'=>'  اعفاء',
            'active'=>1,
        
           ],
           ['name'=>'  مؤجل',
           'active'=>1,
        
          ],
            ]
                
     
            
          
           );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('military_status');
    }
};
