<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVwOrdersCountAndTotalAmountBetweenDays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("create or replace view vw_order_counts_and_total_amounts as
select  count(o.id) as orders_count,
        sum(o.total_price) as total_amount,
        created_at::date as order_date
from orders o
where o.status = 10
group by created_at::date
      ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("drop view vw_order_counts_and_total_amounts");
    }
}
