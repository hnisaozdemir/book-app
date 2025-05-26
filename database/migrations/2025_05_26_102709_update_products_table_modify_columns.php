<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTableModifyColumns extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // stock sütununu kaldır
            $table->dropColumn('stock');

            // yeni sütunları ekle
            $table->string('author')->nullable()->after('description');
            $table->string('type')->nullable()->after('author');
            $table->year('publication_year')->nullable()->after('type');
            $table->integer('page_count')->nullable()->after('publication_year');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // yeni sütunları kaldır
            $table->dropColumn(['author', 'type', 'publication_year', 'page_count']);

            // eski sütunu geri ekle
            $table->integer('stock')->default(0)->after('price');
        });
    }
}
