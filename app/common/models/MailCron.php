<?php

namespace Ypk\Models;

class MailCron extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $mail_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $mail;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $subject;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $contnet;

    /**
     * Method to set the value of field mail_id
     *
     * @param integer $mail_id
     * @return $this
     */
    public function setMailId($mail_id)
    {
        $this->mail_id = $mail_id;

        return $this;
    }

    /**
     * Method to set the value of field mail
     *
     * @param string $mail
     * @return $this
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Method to set the value of field subject
     *
     * @param string $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Method to set the value of field contnet
     *
     * @param string $contnet
     * @return $this
     */
    public function setContnet($contnet)
    {
        $this->contnet = $contnet;

        return $this;
    }

    /**
     * Returns the value of field mail_id
     *
     * @return integer
     */
    public function getMailId()
    {
        return $this->mail_id;
    }

    /**
     * Returns the value of field mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Returns the value of field subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Returns the value of field contnet
     *
     * @return string
     */
    public function getContnet()
    {
        return $this->contnet;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'mail_cron';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MailCron[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MailCron
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
