<?php

namespace App\Console\Commands;

use App\Models\AdminModel;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterEmailCommand extends Command implements ShouldQueue
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:register-email-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    private $email;
//    public function __construct($email)
//    {
//        $this->email=$email;
//    }

    public function handle()
    {
        AdminModel::create([
            'email'=>$this->email
        ]);
    }
}
