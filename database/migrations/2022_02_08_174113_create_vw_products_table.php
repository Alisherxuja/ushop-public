<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVwProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'CREATE VIEW vw_products as
        select p.id,
       p.status,
       p.name_uz,
       p.name_ru,
       p.sku,
       p.slug,
       p.price,
       p.discount,
       p.old_price,
       p.stock,
       p.unicode,

       p.brand_id,
       b.name        as brand_name,
       b.slug        as brand_slug,
       b.logo        as brand_logo,
       b.status      as brand_status,

       p.category_id,
       c.parent_id   as category_parent_id,
       c.name_uz     as category_name_uz,
       c.name_ru     as category_name_ru,
       c.slug        as category_slug,
       c.status      as category_status,

       p.measure_id,
       m.name_uz     as measure_name_uz,
       m.name_ru     as measure_name_ru,
       m.symbol_uz   as measure_symbol_uz,
       m.symbol_ru   as measure_symbol_ru,

       p.created_at,
       p.updated_at

from products p
         join brands b on p.brand_id = b.id
         join categories c on p.category_id = c.id
         join measures m on p.measure_id = m.id
where p.deleted_at is null
  and b.deleted_at is null
  and c.deleted_at is null
  and m.deleted_at is null
';

        $this->down();
        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS vw_products');
    }
}
