<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentCategoriesWithProductsCountView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
create or replace view vw_parent_categories_with_products as
        select ctg.id,
       (select count(p.id)
        from products p
        where category_id in (with recursive recursive as (
            select id
            from categories c
            where id = ctg.id
            union
            select cc.id
            from categories cc
                     inner join recursive rcs on rcs.id = cc.parent_id
        )
                              select *
                              from recursive)) as products_count
from categories ctg
where parent_id is null;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view if exists vw_parent_categories_with_products");
    }
}
