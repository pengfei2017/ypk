<?php

namespace Ypk\Models;

class AdminLog extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $createtime;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $admin_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $admin_id;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    protected $ip;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $url;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

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
     * Method to set the value of field createtime
     *
     * @param integer $createtime
     * @return $this
     */
    public function setCreatetime($createtime)
    {
        $this->createtime = $createtime;

        return $this;
    }

    /**
     * Method to set the value of field admin_name
     *
     * @param string $admin_name
     * @return $this
     */
    public function setAdminName($admin_name)
    {
        $this->admin_name = $admin_name;

        return $this;
    }

    /**
     * Method to set the value of field admin_id
     *
     * @param integer $admin_id
     * @return $this
     */
    public function setAdminId($admin_id)
    {
        $this->admin_id = $admin_id;

        return $this;
    }

    /**
     * Method to set the value of field ip
     *
     * @param string $ip
     * @return $this
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Method to set the value of field url
     *
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * Returns the value of field createtime
     *
     * @return integer
     */
    public function getCreatetime()
    {
        return $this->createtime;
    }

    /**
     * Returns the value of field admin_name
     *
     * @return string
     */
    public function getAdminName()
    {
        return $this->admin_name;
    }

    /**
     * Returns the value of field admin_id
     *
     * @return integer
     */
    public function getAdminId()
    {
        return $this->admin_id;
    }

    /**
     * Returns the value of field ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Returns the value of field url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'admin_log';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdminLog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AdminLog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
