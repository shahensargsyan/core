<?php
namespace App\EmailActivation;

use Mail;
use App\User;

class ActivationService
{
    protected $mailer;
    protected $activationRepo;
    protected $resendAfter = 24;

    public function __construct(ActivationRepository $activationRepo)
    {
        $this->activationRepo = $activationRepo;
    }

    public function sendActivationMail($user)
    {

        if ($user->active || !$this->shouldSend($user)) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);

        $link = route('user.activate', $token);
        /*
        $message = sprintf('Activate account <a href="%s">%s</a>', $link, $link);

        Mail::raw($message, function ($m) use ($user) {
            $m->to($user->email)->subject('Activation mail');
        });
        */
        
        $data = [
                'link' => $link,
                'imageUrl' =>  public_path() . '/img/salon-logo.png'
            ];

        Mail::send('activation.activation_email', $data, function($message) use ($user)
        {   
            $message->to($user->email)->subject('Activation mail');
        });

    }

    public function activateUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);
        $user->active = 1;
        $user->save();

        $this->activationRepo->deleteActivation($token);

        return $user;
    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}