<?php
class MY_Loader extends CI_Loader 
{
    public function template($template_name, $vars=array(),$acceso="",$return = FALSE)
    {
		
        $content  = $this->view('plantilla/cabecera', $acceso, $return);
        $content .= $this->view($template_name, $vars, $return);
        $content .= $this->view('plantilla/pie', $vars, $return);

        if ($return)
        {
            return $content;
        }
    }
}
?>