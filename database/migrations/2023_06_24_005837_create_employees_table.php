<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('employees_code')->comment('كود الموظف التلقائي لايتغير');
            $table->integer('zketo_code')->comment('كود بصمة الموظف من جهاز البصمة لايتغير');
            $table->string("emp_name", 300);
            $table->tinyInteger('emp_gender')->comment("نوع الجنس  - واحد ذكر - اثنين انثي");
            $table->integer("branch_id")->default(1)->comment("الفرع التابع له الموظف ");
            $table->foreignId("Qualifications_id")->nullable()->comment("المؤهل التعليمي")->references("id")->on("qualifications")->onUpdate("cascade");
            $table->string("Qualifications_year", 10)->nullable()->comment("سنة التخرج");
            $table->tinyInteger("graduation_estimate")->nullable()->comment("تقدير التخرج - واحد مقبول - اثنين جيد - ثلاثه جيد مرتفع - اربعه جيد جدا - خمسه امتياز");
            $table->string("Graduation_specialization", 225)->nullable()->comment("تخصص التخرج");
            $table->date("brith_date")->nullable()->comment("تاريخ ميلاد الموظف");
            $table->string("emp_national_idenity", 50)->nullable()->comment("رقم البطاقة الشخصية - او رقم الهوية");
            $table->date("emp_end_identityIDate")->nullable()->comment("تاريخ نهاية البطاقة الشخصية - بطاقة الهوية");
            $table->string("emp_identityPlace", 225)->nullable()->comment("مكان اصدار بطاقة الهوية الشخصية");
            $table->integer('blood_group_id');
            $table->foreignId('religion_id')->comment('حقل الديانة')->references('id')->on('religions')->onUpdate('cascade');
            $table->integer("emp_lang_id")->nullable()->comment(" اللغه التي يتكلم بها الاساسية");
            $table->string("emp_email", 100)->nullable()->comment(" ايميل  الموظف");
            $table->integer("country_id")->nullable()->comment("دولة الموظف");
            $table->integer("governorate_id")->nullable()->comment("محافظة الموظف");
            $table->integer("city_id")->nullable()->comment("مدينة الموظف");
            $table->string("emp_home_tel", 50)->nullable()->comment("رقم هاتف المنزل");
            $table->string("emp_work_tel", 50)->nullable()->comment("رقم هاتف العمل");
            $table->integer("emp_military_id")->comment("الحالة العسكرية");
            $table->date("emp_military_date_from")->nullable()->comment("تاريخ بداية الخدمة العسكرية");
            $table->date("emp_military_date_to")->nullable()->comment("تاريخ نهاية الخدمة العسكرية");
            $table->string("emp_military_wepon")->nullable()->comment("نوع سلاح الخدمة العسكرية");
            $table->date("exemption_date")->nullable()->comment("تاريخ الاعفاء من الخدمه العسكرية");
            $table->string("exemption_reason", 300)->nullable()->comment("سبب الاعفاء من الخدمه العسكرية ");
            $table->string("postponement_reason", 225)->nullable()->comment("سبب التأجيل من الخدمه العسكرية ");
            $table->date("Date_resignation")->nullable()->comment("تاريخ ترك العمل");
            $table->string("resignation_cause")->nullable()->comment("سبب ترك العمل");
            $table->tinyInteger("does_has_Driving_License")->default(0)->comment("هل يمتلك رخصه قياده");
            $table->string("driving_License_degree", 50)->nullable()->comment("رقم رخصه القيادة");
            $table->integer('driving_license_types_id')->nullable();
            $table->tinyInteger("has_Relatives")->default(0)->comment("هل له اقارب بالعمل ");
            $table->string("Relatives_details", 600)->nullable()->comment("تفاصيل الاقارب بالعمل");
            $table->string("notes",600)->nullable();
            $table->date("emp_start_date")->nullable()->comment("تاريخ بدء العمل للموظف");
            $table->tinyInteger("Functiona_status")->default(0)->comment("حالة الموظف واحد يعمل - صفر خارج الخدمة");
            $table->foreignId("emp_Departments_code")->references("id")->on("departements")->onUpdate("cascade");
            $table->foreignId("emp_jobs_id")->references("id")->on("jobs_categories")->onUpdate("cascade");
            $table->tinyInteger("does_has_ateendance")->default(1)->comment("هل ملزم الموظف بعمل بصمه حضور وانصراف");
            $table->tinyInteger("is_has_fixced_shift")->nullable()->comment("هل للموظف شفت ثابت");
            $table->foreignId("shift_type_id")->references("id")->on("shifts_types")->onUpdate("cascade");
            $table->decimal("daily_work_hour", 10, 2)->nullable()->comment("عدد ساعات العمل للموظف وهذا في حالة ان ليس له شفت ثابت");
            $table->decimal("emp_sal", 10, 2)->default(0)->comment("راتب الموظف");
            $table->tinyInteger("MotivationType")->default(0)->comment("صفر لايوجد - واحد ثابت - اثنين متغير");
            $table->decimal("Motivation", 10, 2)->default(0)->comment("قيمة الحافز الثابت ان وجد");
            $table->tinyInteger("isSocialnsurance")->default(0)->comment("هل للموظف تأمين اجتماعي");
            $table->decimal("Socialnsurancecutmonthely", 10, 2)->nullable()->comment("  قيمة استقطاع التأمين الاجتماعي الشهري للموظف");
            $table->string("SocialnsuranceNumber",50)->nullable();
            $table->tinyInteger("ismedicalinsurance")->default(0)->comment("هل للموظف تأمين طبي");
            $table->decimal("medicalinsurancecutmonthely", 10, 2)->nullable()->comment("  قيمة استقطاع التأمين الطبي الشهري للموظف");
            $table->string("medicalinsuranceNumber",50)->nullable();
            $table->tinyInteger("sal_cach_or_visa")->default(1)->comment("نوع صرف الراتب - واحد كاش - اثنين فيزا بنكي");
            $table->tinyInteger("is_active_for_Vaccation")->default(0)->comment("هل هذا الموظف ينزل له رصيد اجازات	");
            $table->string("urgent_person_details", 600)->nullable()->comment("تفاصيل شخص يمكن الرجوع اليه للوصول للموظف");
            $table->string("staies_address", 300)->comment("عنوان الاقامة الفعلي للموظف");
            $table->integer('children_number')->default(0);
            $table->integer("emp_social_status_id")->comment("الحالة الاجتماعية");
            $table->foreignId("Resignations_id")->nullable()->references("id")->on("resignations")->onUpdate("cascade");
            $table->string("bank_number_account", 50)->nullable()->comment("رقم حساب البنك للموظف");
            $table->tinyInteger("is_Disabilities_processes")->default(0)->comment("هل له اعاقة  - واحد يوجد صفر لايوجد");
            $table->string("Disabilities_processes", 500)->nullable()->comment("نوع الاعاقة");
            $table->foreignId("emp_nationality_id")->references("id")->on("nationalities")->onUpdate("cascade");
            $table->string("emp_cafel")->nullable()->comment("اسم الكفيل ");
            $table->string("emp_pasport_no", 100)->nullable()->comment("رقم الباسبور ان وجد");
            $table->string("emp_pasport_from", 100)->nullable()->comment("مكان استخراج الباسبور");
            $table->date("emp_pasport_exp")->nullable()->comment("تاريخ انتهاء الباسبور");
            $table->string("emp_photo", 100)->nullable()->comment(" صورة  الموظف");
            $table->string('emp_CV',100)->nullable();
            $table->string("emp_Basic_stay_com",300)->nullable()->comment("عنوان اقامة الموظف في بلده الام");
            $table->date("date");
            $table->decimal("day_price", 10, 2)->nullable()->comment("سعر يوم الموظف");
            $table->tinyInteger("Does_have_fixed_allowances")->default(0)->comment("هل له بدلات ثابته");
            $table->tinyInteger("is_done_Vaccation_formula")->default(0)->comment("هل تمت المعادله التلقائية لاحتساب الرصيد السنوي للموظف");
          $table->tinyInteger("is_Sensitive_manager_data")->default(0)->comment("هل بيانات حساساه للمديرين مثلا ولاتظهر الا بصلاحيات خاصة	");
        
            

          
           
          
           
          
           
            $table->foreignId("added_by")->references("id")->on("admins")->onUpdate("cascade");
            $table->foreignId("updated_by")->nullable()->references("id")->on("admins")->onUpdate("cascade");
            $table->integer("com_code");
          
                   $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
