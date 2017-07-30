<?php

namespace Ypk\Models;

class ChatLog extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $m_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $f_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $f_name;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    protected $f_ip;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $t_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $t_name;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    protected $t_msg;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $add_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $chat_card_id;

    /**
     * @return int
     */
    public function getChatCardId()
    {
        return $this->chat_card_id;
    }

    /**
     * @param int $chat_card_id
     */
    public function setChatCardId($chat_card_id)
    {
        $this->chat_card_id = $chat_card_id;
    }

    /**
     * Method to set the value of field m_id
     *
     * @param integer $m_id
     * @return $this
     */
    public function setMId($m_id)
    {
        $this->m_id = $m_id;

        return $this;
    }

    /**
     * Method to set the value of field f_id
     *
     * @param integer $f_id
     * @return $this
     */
    public function setFId($f_id)
    {
        $this->f_id = $f_id;

        return $this;
    }

    /**
     * Method to set the value of field f_name
     *
     * @param string $f_name
     * @return $this
     */
    public function setFName($f_name)
    {
        $this->f_name = $f_name;

        return $this;
    }

    /**
     * Method to set the value of field f_ip
     *
     * @param string $f_ip
     * @return $this
     */
    public function setFIp($f_ip)
    {
        $this->f_ip = $f_ip;

        return $this;
    }

    /**
     * Method to set the value of field t_id
     *
     * @param integer $t_id
     * @return $this
     */
    public function setTId($t_id)
    {
        $this->t_id = $t_id;

        return $this;
    }

    /**
     * Method to set the value of field t_name
     *
     * @param string $t_name
     * @return $this
     */
    public function setTName($t_name)
    {
        $this->t_name = $t_name;

        return $this;
    }

    /**
     * Method to set the value of field t_msg
     *
     * @param string $t_msg
     * @return $this
     */
    public function setTMsg($t_msg)
    {
        $this->t_msg = $t_msg;

        return $this;
    }

    /**
     * Method to set the value of field add_time
     *
     * @param integer $add_time
     * @return $this
     */
    public function setAddTime($add_time)
    {
        $this->add_time = $add_time;

        return $this;
    }

    /**
     * Returns the value of field m_id
     *
     * @return integer
     */
    public function getMId()
    {
        return $this->m_id;
    }

    /**
     * Returns the value of field f_id
     *
     * @return integer
     */
    public function getFId()
    {
        return $this->f_id;
    }

    /**
     * Returns the value of field f_name
     *
     * @return string
     */
    public function getFName()
    {
        return $this->f_name;
    }

    /**
     * Returns the value of field f_ip
     *
     * @return string
     */
    public function getFIp()
    {
        return $this->f_ip;
    }

    /**
     * Returns the value of field t_id
     *
     * @return integer
     */
    public function getTId()
    {
        return $this->t_id;
    }

    /**
     * Returns the value of field t_name
     *
     * @return string
     */
    public function getTName()
    {
        return $this->t_name;
    }

    /**
     * Returns the value of field t_msg
     *
     * @return string
     */
    public function getTMsg()
    {
        return $this->t_msg;
    }

    /**
     * Returns the value of field add_time
     *
     * @return integer
     */
    public function getAddTime()
    {
        return $this->add_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'chat_log';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ChatLog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ChatLog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
