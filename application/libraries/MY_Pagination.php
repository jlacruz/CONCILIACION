<?php
class MY_Pagination extends CI_Pagination
 {
    public function __construct()
	{
        parent::__construct();
    }

    public function pagina_actual() {
        return $this->cur_page;
    }
}
?>