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
        Schema::create('tbl_rol', function (Blueprint $table){
            $table->id();
            $table->string('name')->unique()->nullable(false);
            $table->string('description')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps('created_at');
        });

        Schema::create('tbl_module', function (Blueprint $table){
            $table->id();
            $table->string('name')->unique()->nullable(false);
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps('created_at');
        });

        Schema::create('tbl_permission', function (Blueprint $table){
            $table->id();
            $table->string('name')->unique()->nullable(false);
            $table->string('description')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps('created_at');
        });

        /**
         * Create the role-permission table
         */

         Schema::create('tbl_rol_permission', function (Blueprint $table){
             $table->id();
             $table->foreignId('rol_id')->constrained('tbl_rol');
             $table->foreignId('permission_id')->constrained('tbl_permission');
             $table->timestamps('created_at');
             $table->timestamps('modified_at');
         });

         /**
          * Create the module-submodule table
          */

          Schema::create('tbl_submodule', function (Blueprint $table){
              $table->id();
              $table->foreignId('module_id')->constrained('tbl_module');
              $table->string('name')->unique()->nullable(false);
              $table->string('description')->nullable();
              $table->string('pagination')->nullable();
              $table->timestamps('created_at');
              $table->timestamps('modified_at');
          });

                  /**
         * Create the user role-privileges table
         */
        Schema::create('users_privileges', function (Blueprint $table){
            $table->id();
            $table->foreignId('module_id')->constrained('tbl_module');
            $table->foreignId('submodule_id')->constrained('tbl_submodule');
            $table->foreignId('rol_id')->constrained('tbl_rol');
            $table->foreignId('authorization_id')->constrained('users');
        });

        Schema::create('user_roles', function (Blueprint $table){
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('rol_id')->constrained('tbl_rol');
            $table->foreignId('assigned_to')->constrained('users');
            $table->timestamps('assigned_at');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_rol');
        Schema::dropIfExists('tbl_module');
        Schema::dropIfExists('tbl_permission');
        Schema::dropIfExists('tbl_rol_permission');
        Schema::dropIfExists('tbl_submodule');
        Schema::dropIfExists('users_privileges');
        Schema::dropIfExists('user_roles');
    }
};
