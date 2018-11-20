<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ApiUser;
use Carbon\Carbon;

class DeleteOldApiTokens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete_old_api_tokens';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'All old Api tokens will be deleted after some time';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tokens = ApiUser::where('last_login_at', '<=', Carbon::now()->subHour(12)->format('Y-m-d H:i:s'))->get();
        
        foreach($tokens as $token)
        {
            $token->delete();
        }
    }
}
