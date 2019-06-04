<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSender;

class SendMailCmd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send mail debugging';

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
      $id= $this->argument('id');
      $title="Mail Automatica";
      $description="Questa è una mail generata automaticamente";
      // $user=User::inRandomOrder()->first();
      $user=User::findOrFail($id);
      $username=$user->name;

      Mail::to($user)->queue(new MailSender($title,$description,$username));
    }
}
