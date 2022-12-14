<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLaraTicketsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // added fields to users tables
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('laratickets_admin')->default(0);
            $table->boolean('laratickets_agent')->default(0);
        });

        Schema::create('laratickets_priorities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('color');
        });

        Schema::create('laratickets_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('color');
        });

        Schema::create('laratickets_categories_users', function (Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->integer('user_id')->unsigned();
        });

        Schema::create('laratickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->longText('content');
            $table->string('code')->nullable();
            $table->longText('html')->nullable();
            $table->integer('status');
            $table->integer('priority_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('agent_id')->unsigned();
            $table->string('model')->nullable();
            $table->integer('model_id')->nullable();
            $table->integer('category_id')->unsigned();
            $table->integer('created_by')->nullable();
            $table->integer('last_comment_by')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('laratickets_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('content');
            $table->longText('html')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('ticket_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('laratickets_audits', function (Blueprint $table) {
            $table->increments('id');
            $table->text('operation');
            $table->integer('user_id')->unsigned();
            $table->integer('ticket_id')->unsigned();
            $table->timestamps();
        });

        Schema::create('laratickets_replies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('content');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('laratickets_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->unique();
            $table->mediumText('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['laratickets_admin', 'laratickets_agent']);
        });

        Schema::drop('laratickets_audits');
        Schema::drop('laratickets_comments');
        Schema::drop('laratickets');
        Schema::drop('laratickets_categories_users');
        Schema::drop('laratickets_categories');
        Schema::drop('laratickets_priorities');
        Schema::drop('laratickets_replies');
        Schema::drop('laratickets_settings');
    }
}
