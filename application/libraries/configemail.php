<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class configEmail
{
    function configSrvEmail()
	{ 
			$email_config = Array(
				'protocol'  => 'smtp',
				'smtp_host' => '172.16.8.88',
				'smtp_port' => '25',
				'smtp_user' => 'correspondencia@mijp.gob.ve',
				'smtp_pass' => 'AAbb01**',
				'mailtype'  => 'html',
				'starttls'  => true,
				'newline'   => "\r\n"
			);
			return $email_config;
    } 
    //Ejemplo de utilización para una clave de 10 caracteres: 
}