<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Log;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Mockery\Exception;

class DeleteOldPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:old-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes posts older than 1 year without comments.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Subtract one year from now
        $limitDate = Carbon::now()->subYear();

        try {
            $posts = Post::where('created_at', '<=', $limitDate)
                ->Where('is_deleted', false)
                ->doesntHave('comments')
                ->update(['is_deleted' => true]);

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }

        Log::info("Soft deleted {$posts} posts");

        return false;
    }
}
