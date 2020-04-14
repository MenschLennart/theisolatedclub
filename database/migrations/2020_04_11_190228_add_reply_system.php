<?php

use App\Comment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReplySystem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
           $table->renameColumn('replies_to', 'parent_id');
           $table->renameColumn('text', 'body');
           $table->integer('commentable_id')->unsigned();
           $table->string('commentable_type');
           $table->softDeletes();
        });

        // Need to set id and type of comment for existing entries
        $results = DB::table('comments')->select('*')->get();
        foreach($results as $result) {
            $activity_id = $result->activity()->id;
            $result->update([
                'commentable_id' => $activity_id,
                'commentable_type' => App\Activity::class
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->renameColumn('parent_id', 'replies_to');
            $table->dropColumn(['commentable_id', 'commentable_type']);
        });
    }
}
