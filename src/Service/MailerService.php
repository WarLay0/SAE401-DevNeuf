<?php

namespace App\Service;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

/**
 * Class MailerService
 * @package App\Service
 */

class MailerService {

    public function __construct(private readonly MailerInterface $mailer){}

    public function send (
        string $to,
        string $subject,
        string $templateTwig,
        array $context): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address('noreply@dualguest.fr', 'DualGuest'))
            ->to($to)
            ->subject($subject)
            ->htmlTemplate("mails/$templateTwig")
            ->context($context);
        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $transportException) {
            throw $transportException;
        }
    }


}

