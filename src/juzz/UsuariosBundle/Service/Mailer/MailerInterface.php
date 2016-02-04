<?php
namespace juzz\UsuariosBundle\Service\Mailer;

use juzz\UsuariosBundle\Entity\Usuarios as UserEntity;


interface MailerInterface
{
    /**
     * Send an email to a user to confirm the account creation
     *
     * @param UserEntity $user
     *
     * @return void
     */
    public function sendConfirmationEmailMessage(UserEntity $user);
    /**
     * Send an email to a user to confirm the password reset
     *
     * @param UserEntity $user
     *
     * @return void
     */
    public function sendResettingEmailMessage(UserEntity $user);
}