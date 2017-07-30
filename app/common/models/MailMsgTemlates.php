<?php

namespace Ypk\Models;

class MailMsgTemlates extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $name;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $title;

    /**
     *
     * @var string
     * @Primary
     * @Column(type="string", length=30, nullable=false)
     */
    protected $code;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $content;

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Method to set the value of field code
     *
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Method to set the value of field content
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the value of field code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns the value of field content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'mail_msg_temlates';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MailMsgTemlates[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MailMsgTemlates
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
