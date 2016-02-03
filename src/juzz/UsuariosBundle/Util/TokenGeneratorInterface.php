<?php
namespace juzz\UsuariosBundle\Util;

interface TokenGeneratorInterface
{
    /**
    * @return string
    */
    public function generateToken();
}