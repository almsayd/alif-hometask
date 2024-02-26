<?php

namespace App\Console\Commands;

use App\Mail\BirthdayEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Command\Command as CommandAlias;

class BirthdaySendEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:birthday-init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'User birthday congratulation';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {


        $users = User::all();


        foreach ($users as $user) {
            $formattedBirthday = Carbon::parse($user->birthday)->format('m-d');
            $today = now()->format('m-d');

            $email = $user->email;
            $name = $user->name;
            $mail = "Happy Birthday, $name";


            if ($today === $formattedBirthday){
//                Mail::to($user->email)->send(new BirthdayEmail($user));
                Mail::raw($mail,function ($mail) use ($email){
                    $mail->to($email)->subject('Birthday congratulation');
                });

                $user->congratulated = true;
                $user->save();
            }
        }
        return  CommandAlias::SUCCESS;
    }

}
