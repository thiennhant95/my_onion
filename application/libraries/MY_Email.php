<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Email extends CI_Email {

    public function __construct()
    {
        parent::__construct();
    }

    protected function _set_header($header, $value)
    {
        $this->_headers[$header] = $value;
    }

    public function subject($subject)
    {
        //$subject = $this->_prep_q_encoding($subject);
        $this->_set_header('Subject', $subject);
        return $this;
    }

    public function message($body)
    {
        if (strtolower($this->charset) == 'iso-2022-jp')
        {
            $this->_body = rtrim(str_replace("\r", "", $body));
        }
        else
        {
            //$this->_body = stripslashes(rtrim(str_replace("\r", "", $body)));
            $this->_body = rtrim(str_replace("\r", "", $body));
        }
        return $this;
    }
}