<?php


namespace App\Clients;

use Illuminate\Support\Facades\Mail;

class EMAILService
{
    /**
     * @param $email
     * @param $code
     * @return bool
     */
    public function sendEmailMessage($email, $code): bool
    {
        $text = 'Код подтверждения для замены почты: ' . $code;
        return self::sendToNewEmail('ushop@gmail.com', $email, $text, 'Код подтверждения', 'ushop');
    }

    /**
     * @param $from
     * @param $to
     * @param $text
     * @param $subject
     * @param $organization_name
     * @return bool
     */
    public static function sendToNewEmail($from, $to, $text, $subject, $organization_name): bool
    {
        if (env('APP_DEBUG')) // TODO, at production, remove this
            return true;
        $data = ['text' => $text];
        try {
            Mail::send('email.mail', $data, function ($message) use ($from, $to, $subject, $organization_name) {
                $message->to($to)->subject($subject);
                $message->from($from, $organization_name);
            });
            return true;
        } catch (\Exception $e) {
            return false;//$e->getMessage();
        }
    }
}
