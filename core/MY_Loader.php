<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH . "third_party/MX/Loader.php";

class MY_Loader extends MX_Loader
{
    public function template($template_name, $vars = array(), $return = FALSE)
    {
        if ($return) :
            $content  = $this->view('__templates/script', $vars, $return);
            $content .= $this->view('__templates/header', $vars, $return);
            $content .= $this->view('__templates/sidebar', $vars, $return);
            // $content .= $this->view($template_name, $vars, $return);
            $content .= $this->view('__templates/footer', $vars, $return);

            return $content;
        else :
            $this->view('__templates/script', $vars);
            $this->view('__templates/header', $vars);
            $this->view('__templates/sidebar', $vars);
            // $this->view($template_name, $vars);
            $this->view('__templates/footer', $vars);
        endif;
    }
}
