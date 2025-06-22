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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name')->nullable();
            $table->foreignId('department_id')->constrained('departments');
            $table->integer('invoice_num');
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->foreignId('employee_id')->constrained('employees');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('paid_amount', 10, 2);
            $table->decimal('rest_amount', 10, 2);
            $table->string('payment_type');
            $table->text('notes')->nullable();
            $table->date('invoice_date');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
