<?php
require_once('../../src/model/name.php');
require_once('../../src/infrastructure/AccessDataSource.php');
require_once('../../src/infrastructure/SendMail.php');

class ConfirmApplication
{
    private $confirm_model;
    private $access_db;
    private $send_mail;

    public function confirm($form_data)
    {
        $this->confirm_model = new Customer($form_data);
        $this->access_db = new AccessDataSource;
        $this->send_mail = new SendMail;

        if ($this->send_mail->Send($this->confirm_model)) {
            $this->access_db->insert($this->confirm_model);
            return true;
        }

        return false;
    }
}
