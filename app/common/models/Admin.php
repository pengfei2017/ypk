<?php

namespace Ypk\Models;

class Admin extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $admin_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $admin_name;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $admin_avatar;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    protected $admin_password;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $admin_login_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $admin_login_num;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $admin_is_super;

    /**
     *
     * @var integer
     * @Column(type="integer", length=6, nullable=true)
     */
    protected $admin_gid;

    /**
     *
     * @var string
     * @Column(type="string", length=400, nullable=true)
     */
    protected $admin_quick_link;

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
     * Method to set the value of field admin_avatar
     *
     * @param string $admin_avatar
     * @return $this
     */
    public function setAdminAvatar($admin_avatar)
    {
        $this->admin_avatar = $admin_avatar;

        return $this;
    }

    /**
     * Method to set the value of field admin_password
     *
     * @param string $admin_password
     * @return $this
     */
    public function setAdminPassword($admin_password)
    {
        $this->admin_password = $admin_password;

        return $this;
    }

    /**
     * Method to set the value of field admin_login_time
     *
     * @param integer $admin_login_time
     * @return $this
     */
    public function setAdminLoginTime($admin_login_time)
    {
        $this->admin_login_time = $admin_login_time;

        return $this;
    }

    /**
     * Method to set the value of field admin_login_num
     *
     * @param integer $admin_login_num
     * @return $this
     */
    public function setAdminLoginNum($admin_login_num)
    {
        $this->admin_login_num = $admin_login_num;

        return $this;
    }

    /**
     * Method to set the value of field admin_is_super
     *
     * @param integer $admin_is_super
     * @return $this
     */
    public function setAdminIsSuper($admin_is_super)
    {
        $this->admin_is_super = $admin_is_super;

        return $this;
    }

    /**
     * Method to set the value of field admin_gid
     *
     * @param integer $admin_gid
     * @return $this
     */
    public function setAdminGid($admin_gid)
    {
        $this->admin_gid = $admin_gid;

        return $this;
    }

    /**
     * Method to set the value of field admin_quick_link
     *
     * @param string $admin_quick_link
     * @return $this
     */
    public function setAdminQuickLink($admin_quick_link)
    {
        $this->admin_quick_link = $admin_quick_link;

        return $this;
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
     * Returns the value of field admin_name
     *
     * @return string
     */
    public function getAdminName()
    {
        return $this->admin_name;
    }

    /**
     * Returns the value of field admin_avatar
     *
     * @return string
     */
    public function getAdminAvatar()
    {
        return $this->admin_avatar;
    }

    /**
     * Returns the value of field admin_password
     *
     * @return string
     */
    public function getAdminPassword()
    {
        return $this->admin_password;
    }

    /**
     * Returns the value of field admin_login_time
     *
     * @return integer
     */
    public function getAdminLoginTime()
    {
        return $this->admin_login_time;
    }

    /**
     * Returns the value of field admin_login_num
     *
     * @return integer
     */
    public function getAdminLoginNum()
    {
        return $this->admin_login_num;
    }

    /**
     * Returns the value of field admin_is_super
     *
     * @return integer
     */
    public function getAdminIsSuper()
    {
        return $this->admin_is_super;
    }

    /**
     * Returns the value of field admin_gid
     *
     * @return integer
     */
    public function getAdminGid()
    {
        return $this->admin_gid;
    }

    /**
     * Returns the value of field admin_quick_link
     *
     * @return string
     */
    public function getAdminQuickLink()
    {
        return $this->admin_quick_link;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'admin';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Admin[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Admin
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
