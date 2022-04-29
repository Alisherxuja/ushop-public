<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTreeReverseFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        DB::statement("create function get_categories_tree(cId bigint)
returns table (
id bigint,
parent_id bigint,
slug varchar,
name_ru varchar,
name_uz varchar,
depth integer
)
language plpgsql
as
$$
begin
return query WITH RECURSIVE subordinates AS (
    SELECT c.id,
           c.parent_id,
c.slug,
           c.name_ru,
           c.name_uz,
           1 as depth
    FROM categories c
    WHERE c.id = $1
    UNION
    SELECT e.id,
           e.parent_id,
e.slug,
           e.name_ru,
           e.name_uz,
           s.depth + 1 as depth
    FROM categories e
             INNER JOIN subordinates s ON s.parent_id = e.id
)
SELECT *
FROM subordinates order by depth desc;
end;
$$");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop function if exists get_categories_tree;");
    }
}
