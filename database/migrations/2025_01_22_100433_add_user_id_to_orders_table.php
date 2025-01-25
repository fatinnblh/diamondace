<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Order;
use App\Models\User;

class AddUserIdToOrdersTable extends Migration
{
    public function up()
    {
        // First add the user_id column without constraints
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });

        // Get the existing admin user
        $adminUser = User::where('email', 'acethesis2u@gmail.com')->first();

        if (!$adminUser) {
            // Create admin user only if it doesn't exist
            $adminUser = User::create([
                'name' => 'Admin',
                'email' => 'acethesis2u@gmail.com',
                'password' => bcrypt('Ace_thesis@2u'),
                'role' => 'admin'
            ]);
        }

        // Update existing orders to use the admin user
        Order::whereNull('user_id')->update(['user_id' => $adminUser->id]);

        // Now add the foreign key constraint
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}
