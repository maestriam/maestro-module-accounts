<?php

namespace Maestro\Accounts\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallCommand  extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accounts:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup module configuration.';

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
        Artisan::call("maestro:migrate Accounts");
        
        $this->info('Accounts module configurated with successful');      
    }
}