<?php
namespace juzz\UsuariosBundle\Service\Util;

interface TokenGeneratorInterface
{
    /**
    * @return string
    */
    public function generateToken();
}