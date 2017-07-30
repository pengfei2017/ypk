<?php

namespace Ypk\Models;

class SnsTracelog extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $trace_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $trace_originalid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $trace_originalmemberid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $trace_originalstate;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $trace_memberid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $trace_membername;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $trace_memberavatar;

    /**
     *
     * @var string
     * @Column(type="string", length=500, nullable=true)
     */
    protected $trace_title;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $trace_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $trace_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $trace_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $trace_privacy;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $trace_commentcount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $trace_copycount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $trace_orgcommentcount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $trace_orgcopycount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $trace_from;

    /**
     * Method to set the value of field trace_id
     *
     * @param integer $trace_id
     * @return $this
     */
    public function setTraceId($trace_id)
    {
        $this->trace_id = $trace_id;

        return $this;
    }

    /**
     * Method to set the value of field trace_originalid
     *
     * @param integer $trace_originalid
     * @return $this
     */
    public function setTraceOriginalid($trace_originalid)
    {
        $this->trace_originalid = $trace_originalid;

        return $this;
    }

    /**
     * Method to set the value of field trace_originalmemberid
     *
     * @param integer $trace_originalmemberid
     * @return $this
     */
    public function setTraceOriginalmemberid($trace_originalmemberid)
    {
        $this->trace_originalmemberid = $trace_originalmemberid;

        return $this;
    }

    /**
     * Method to set the value of field trace_originalstate
     *
     * @param integer $trace_originalstate
     * @return $this
     */
    public function setTraceOriginalstate($trace_originalstate)
    {
        $this->trace_originalstate = $trace_originalstate;

        return $this;
    }

    /**
     * Method to set the value of field trace_memberid
     *
     * @param integer $trace_memberid
     * @return $this
     */
    public function setTraceMemberid($trace_memberid)
    {
        $this->trace_memberid = $trace_memberid;

        return $this;
    }

    /**
     * Method to set the value of field trace_membername
     *
     * @param string $trace_membername
     * @return $this
     */
    public function setTraceMembername($trace_membername)
    {
        $this->trace_membername = $trace_membername;

        return $this;
    }

    /**
     * Method to set the value of field trace_memberavatar
     *
     * @param string $trace_memberavatar
     * @return $this
     */
    public function setTraceMemberavatar($trace_memberavatar)
    {
        $this->trace_memberavatar = $trace_memberavatar;

        return $this;
    }

    /**
     * Method to set the value of field trace_title
     *
     * @param string $trace_title
     * @return $this
     */
    public function setTraceTitle($trace_title)
    {
        $this->trace_title = $trace_title;

        return $this;
    }

    /**
     * Method to set the value of field trace_content
     *
     * @param string $trace_content
     * @return $this
     */
    public function setTraceContent($trace_content)
    {
        $this->trace_content = $trace_content;

        return $this;
    }

    /**
     * Method to set the value of field trace_addtime
     *
     * @param integer $trace_addtime
     * @return $this
     */
    public function setTraceAddtime($trace_addtime)
    {
        $this->trace_addtime = $trace_addtime;

        return $this;
    }

    /**
     * Method to set the value of field trace_state
     *
     * @param integer $trace_state
     * @return $this
     */
    public function setTraceState($trace_state)
    {
        $this->trace_state = $trace_state;

        return $this;
    }

    /**
     * Method to set the value of field trace_privacy
     *
     * @param integer $trace_privacy
     * @return $this
     */
    public function setTracePrivacy($trace_privacy)
    {
        $this->trace_privacy = $trace_privacy;

        return $this;
    }

    /**
     * Method to set the value of field trace_commentcount
     *
     * @param integer $trace_commentcount
     * @return $this
     */
    public function setTraceCommentcount($trace_commentcount)
    {
        $this->trace_commentcount = $trace_commentcount;

        return $this;
    }

    /**
     * Method to set the value of field trace_copycount
     *
     * @param integer $trace_copycount
     * @return $this
     */
    public function setTraceCopycount($trace_copycount)
    {
        $this->trace_copycount = $trace_copycount;

        return $this;
    }

    /**
     * Method to set the value of field trace_orgcommentcount
     *
     * @param integer $trace_orgcommentcount
     * @return $this
     */
    public function setTraceOrgcommentcount($trace_orgcommentcount)
    {
        $this->trace_orgcommentcount = $trace_orgcommentcount;

        return $this;
    }

    /**
     * Method to set the value of field trace_orgcopycount
     *
     * @param integer $trace_orgcopycount
     * @return $this
     */
    public function setTraceOrgcopycount($trace_orgcopycount)
    {
        $this->trace_orgcopycount = $trace_orgcopycount;

        return $this;
    }

    /**
     * Method to set the value of field trace_from
     *
     * @param integer $trace_from
     * @return $this
     */
    public function setTraceFrom($trace_from)
    {
        $this->trace_from = $trace_from;

        return $this;
    }

    /**
     * Returns the value of field trace_id
     *
     * @return integer
     */
    public function getTraceId()
    {
        return $this->trace_id;
    }

    /**
     * Returns the value of field trace_originalid
     *
     * @return integer
     */
    public function getTraceOriginalid()
    {
        return $this->trace_originalid;
    }

    /**
     * Returns the value of field trace_originalmemberid
     *
     * @return integer
     */
    public function getTraceOriginalmemberid()
    {
        return $this->trace_originalmemberid;
    }

    /**
     * Returns the value of field trace_originalstate
     *
     * @return integer
     */
    public function getTraceOriginalstate()
    {
        return $this->trace_originalstate;
    }

    /**
     * Returns the value of field trace_memberid
     *
     * @return integer
     */
    public function getTraceMemberid()
    {
        return $this->trace_memberid;
    }

    /**
     * Returns the value of field trace_membername
     *
     * @return string
     */
    public function getTraceMembername()
    {
        return $this->trace_membername;
    }

    /**
     * Returns the value of field trace_memberavatar
     *
     * @return string
     */
    public function getTraceMemberavatar()
    {
        return $this->trace_memberavatar;
    }

    /**
     * Returns the value of field trace_title
     *
     * @return string
     */
    public function getTraceTitle()
    {
        return $this->trace_title;
    }

    /**
     * Returns the value of field trace_content
     *
     * @return string
     */
    public function getTraceContent()
    {
        return $this->trace_content;
    }

    /**
     * Returns the value of field trace_addtime
     *
     * @return integer
     */
    public function getTraceAddtime()
    {
        return $this->trace_addtime;
    }

    /**
     * Returns the value of field trace_state
     *
     * @return integer
     */
    public function getTraceState()
    {
        return $this->trace_state;
    }

    /**
     * Returns the value of field trace_privacy
     *
     * @return integer
     */
    public function getTracePrivacy()
    {
        return $this->trace_privacy;
    }

    /**
     * Returns the value of field trace_commentcount
     *
     * @return integer
     */
    public function getTraceCommentcount()
    {
        return $this->trace_commentcount;
    }

    /**
     * Returns the value of field trace_copycount
     *
     * @return integer
     */
    public function getTraceCopycount()
    {
        return $this->trace_copycount;
    }

    /**
     * Returns the value of field trace_orgcommentcount
     *
     * @return integer
     */
    public function getTraceOrgcommentcount()
    {
        return $this->trace_orgcommentcount;
    }

    /**
     * Returns the value of field trace_orgcopycount
     *
     * @return integer
     */
    public function getTraceOrgcopycount()
    {
        return $this->trace_orgcopycount;
    }

    /**
     * Returns the value of field trace_from
     *
     * @return integer
     */
    public function getTraceFrom()
    {
        return $this->trace_from;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'sns_tracelog';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsTracelog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsTracelog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
