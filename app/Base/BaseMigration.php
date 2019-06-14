<?php

namespace App\Base;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BaseMigration extends Migration
{
    public $model;

    public $table_name;

    public $columns;

    /**
     * Run the migrations.
     */
    public function __construct()
    {
        $class_name = 'App\\Models\\' . $this->model;
        $model = new $class_name();
        $this->table_name = $model->getTable();
        $this->columns = $model->getColumns();
    }

    public function up()
    {
        $columns = $this->columns;
        $table_name = $this->table_name;
        Schema::defaultStringLength(191);
        Schema::create($table_name, function (Blueprint $table) use ($columns, $table_name) {
            $table->bigIncrements('id');
            foreach($columns as $column){
                $name = $column['name'];
                $type = isset($column['type']) ? $column['type'] : '';
                $database = isset($column['database']) ? $column['database'] : '';
                $relation = isset($column['relation']) ? $column['relation'] : '';

                if($database === 'none'){
                    continue;
                }
                elseif($relation){
                    $table->unsignedBigInteger($name);
                    $table->foreign($name)->references('id')->on($relation);
                }
                else{
                    $table->{$type}($name)->{$database}(true);
                }
            }
            if($table_name === 'categories' || $table_name === 'menus'){
                $table->nestedSet();
            }
            if($table_name === 'users'){
                $table->rememberToken();
            }
            if($table_name === 'addresses'){
                $table->decimal('latitude', 10, 8)->nullable();
                $table->decimal('longitude', 11, 8)->nullable();
            }
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists($this->table_name);
    }
}
