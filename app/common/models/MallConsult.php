<?php

namespace Ypk\Models;

class MallConsult extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $mc_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $mct_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $member_name;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=false)
     */
    protected $mc_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $mc_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_reply;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=true)
     */
    protected $mc_reply;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $mc_reply_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $admin_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $admin_name;

    /**
     * Method to set the value of field mc_id
     *
     * @param integer $mc_id
     * @return $this
     */
    public function setMcId($mc_id)
    {
        $this->mc_id = $mc_id;

        return $this;
    }

    /**
     * Method to set the value of field mct_id
     *
     * @param integer $mct_id
     * @return $this
     */
    public function setMctId($mct_id)
    {
        $this->mct_id = $mct_id;

        return $this;
    }

    /**
     * Method to set the value of field member_id
     *
     * @param integer $member_id
     * @return $this
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;

        return $this;
    }

    /**
     * Method to set the value of field member_name
     *
     * @param string $member_name
     * @return $this
     */
    public function setMemberName($member_name)
    {
        $this->member_name = $member_name;

        return $this;
    }

    /**
     * Method to set the value of field mc_content
     *
     * @param string $mc_content
     * @return $this
     */
    public function setMcContent($mc_content)
    {
        $this->mc_content = $mc_content;

        return $this;
    }

    /**
     * Method to set the value of field mc_addtime
     *
     * @param integer $mc_addtime
     * @return $this
     */
    public function setMcAddtime($mc_addtime)
    {
        $this->mc_addtime = $mc_addtime;

        return $this;
    }

    /**
     * Method to set the value of field is_reply
     *
     * @param integer $is_reply
     * @return $this
     */
    public function setIsReply($is_reply)
    {
        $this->is_reply = $is_reply;

        return $this;
    }

    /**
     * Method to set the value of field mc_reply
     *
     * @param string $mc_reply
     * @return $this
     */
    public function setMcReply($mc_reply)
    {
        $this->mc_reply = $mc_reply;

        return $this;
    }

    /**
     * Method to set the value of field mc_reply_time
     *
     * @param integer $mc_reply_time
     * @return $this
     */
    public function setMcReplyTime($mc_reply_time)
    {
        $this->mc_reply_time = $mc_reply_time;

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
     * Returns the value of field mc_id
     *
     * @return integer
     */
    public function getMcId()
    {
        return $this->mc_id;
    }

    /**
     * Returns the value of field mct_id
     *
     * @return integer
     */
    public function getMctId()
    {
        return $this->mct_id;
    }

    /**
     * Returns the value of field member_id
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * Returns the value of field member_name
     *
     * @return string
     */
    public function getMemberName()
    {
        return $this->member_name;
    }

    /**
     * Returns the value of field mc_content
     *
     * @return string
     */
    public function getMcContent()
    {
        return $this->mc_content;
    }

    /**
     * Returns the value of field mc_addtime
     *
     * @return integer
     */
    public function getMcAddtime()
    {
        return $this->mc_addtime;
    }

    /**
     * Returns the value of field is_reply
     *
     * @return integer
     */
    public function getIsReply()
    {
        return $this->is_reply;
    }

    /**
     * Returns the value of field mc_reply
     *
     * @return string
     */
    public function getMcReply()
    {
        return $this->mc_reply;
    }

    /**
     * Returns the value of field mc_reply_time
     *
     * @return integer
     */
    public function getMcReplyTime()
    {
        return $this->mc_reply_time;
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'mall_consult';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MallConsult[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MallConsult
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
