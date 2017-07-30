<?php

namespace Ypk\Models;

class StoreSnsComment extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $scomm_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $strace_id;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $scomm_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $scomm_memberid;

    /**
     *
     * @var string
     * @Column(type="string", length=45, nullable=true)
     */
    protected $scomm_membername;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $scomm_memberavatar;

    /**
     *
     * @var string
     * @Column(type="string", length=11, nullable=true)
     */
    protected $scomm_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $scomm_state;

    /**
     * Method to set the value of field scomm_id
     *
     * @param integer $scomm_id
     * @return $this
     */
    public function setScommId($scomm_id)
    {
        $this->scomm_id = $scomm_id;

        return $this;
    }

    /**
     * Method to set the value of field strace_id
     *
     * @param integer $strace_id
     * @return $this
     */
    public function setStraceId($strace_id)
    {
        $this->strace_id = $strace_id;

        return $this;
    }

    /**
     * Method to set the value of field scomm_content
     *
     * @param string $scomm_content
     * @return $this
     */
    public function setScommContent($scomm_content)
    {
        $this->scomm_content = $scomm_content;

        return $this;
    }

    /**
     * Method to set the value of field scomm_memberid
     *
     * @param integer $scomm_memberid
     * @return $this
     */
    public function setScommMemberid($scomm_memberid)
    {
        $this->scomm_memberid = $scomm_memberid;

        return $this;
    }

    /**
     * Method to set the value of field scomm_membername
     *
     * @param string $scomm_membername
     * @return $this
     */
    public function setScommMembername($scomm_membername)
    {
        $this->scomm_membername = $scomm_membername;

        return $this;
    }

    /**
     * Method to set the value of field scomm_memberavatar
     *
     * @param string $scomm_memberavatar
     * @return $this
     */
    public function setScommMemberavatar($scomm_memberavatar)
    {
        $this->scomm_memberavatar = $scomm_memberavatar;

        return $this;
    }

    /**
     * Method to set the value of field scomm_time
     *
     * @param string $scomm_time
     * @return $this
     */
    public function setScommTime($scomm_time)
    {
        $this->scomm_time = $scomm_time;

        return $this;
    }

    /**
     * Method to set the value of field scomm_state
     *
     * @param integer $scomm_state
     * @return $this
     */
    public function setScommState($scomm_state)
    {
        $this->scomm_state = $scomm_state;

        return $this;
    }

    /**
     * Returns the value of field scomm_id
     *
     * @return integer
     */
    public function getScommId()
    {
        return $this->scomm_id;
    }

    /**
     * Returns the value of field strace_id
     *
     * @return integer
     */
    public function getStraceId()
    {
        return $this->strace_id;
    }

    /**
     * Returns the value of field scomm_content
     *
     * @return string
     */
    public function getScommContent()
    {
        return $this->scomm_content;
    }

    /**
     * Returns the value of field scomm_memberid
     *
     * @return integer
     */
    public function getScommMemberid()
    {
        return $this->scomm_memberid;
    }

    /**
     * Returns the value of field scomm_membername
     *
     * @return string
     */
    public function getScommMembername()
    {
        return $this->scomm_membername;
    }

    /**
     * Returns the value of field scomm_memberavatar
     *
     * @return string
     */
    public function getScommMemberavatar()
    {
        return $this->scomm_memberavatar;
    }

    /**
     * Returns the value of field scomm_time
     *
     * @return string
     */
    public function getScommTime()
    {
        return $this->scomm_time;
    }

    /**
     * Returns the value of field scomm_state
     *
     * @return integer
     */
    public function getScommState()
    {
        return $this->scomm_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_sns_comment';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreSnsComment[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreSnsComment
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
