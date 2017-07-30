<?php

namespace Ypk\Models;

class CircleInform extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $inform_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $circle_id;

    /**
     *
     * @var string
     * @Column(type="string", length=12, nullable=false)
     */
    protected $circle_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $theme_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $theme_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $reply_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
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
     * @Column(type="string", length=255, nullable=false)
     */
    protected $inform_content;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $inform_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $inform_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $inform_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $inform_opid;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $inform_opname;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $inform_opexp;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $inform_opresult;

    /**
     * Method to set the value of field inform_id
     *
     * @param integer $inform_id
     * @return $this
     */
    public function setInformId($inform_id)
    {
        $this->inform_id = $inform_id;

        return $this;
    }

    /**
     * Method to set the value of field circle_id
     *
     * @param integer $circle_id
     * @return $this
     */
    public function setCircleId($circle_id)
    {
        $this->circle_id = $circle_id;

        return $this;
    }

    /**
     * Method to set the value of field circle_name
     *
     * @param string $circle_name
     * @return $this
     */
    public function setCircleName($circle_name)
    {
        $this->circle_name = $circle_name;

        return $this;
    }

    /**
     * Method to set the value of field theme_id
     *
     * @param integer $theme_id
     * @return $this
     */
    public function setThemeId($theme_id)
    {
        $this->theme_id = $theme_id;

        return $this;
    }

    /**
     * Method to set the value of field theme_name
     *
     * @param string $theme_name
     * @return $this
     */
    public function setThemeName($theme_name)
    {
        $this->theme_name = $theme_name;

        return $this;
    }

    /**
     * Method to set the value of field reply_id
     *
     * @param integer $reply_id
     * @return $this
     */
    public function setReplyId($reply_id)
    {
        $this->reply_id = $reply_id;

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
     * Method to set the value of field inform_content
     *
     * @param string $inform_content
     * @return $this
     */
    public function setInformContent($inform_content)
    {
        $this->inform_content = $inform_content;

        return $this;
    }

    /**
     * Method to set the value of field inform_time
     *
     * @param string $inform_time
     * @return $this
     */
    public function setInformTime($inform_time)
    {
        $this->inform_time = $inform_time;

        return $this;
    }

    /**
     * Method to set the value of field inform_type
     *
     * @param integer $inform_type
     * @return $this
     */
    public function setInformType($inform_type)
    {
        $this->inform_type = $inform_type;

        return $this;
    }

    /**
     * Method to set the value of field inform_state
     *
     * @param integer $inform_state
     * @return $this
     */
    public function setInformState($inform_state)
    {
        $this->inform_state = $inform_state;

        return $this;
    }

    /**
     * Method to set the value of field inform_opid
     *
     * @param integer $inform_opid
     * @return $this
     */
    public function setInformOpid($inform_opid)
    {
        $this->inform_opid = $inform_opid;

        return $this;
    }

    /**
     * Method to set the value of field inform_opname
     *
     * @param string $inform_opname
     * @return $this
     */
    public function setInformOpname($inform_opname)
    {
        $this->inform_opname = $inform_opname;

        return $this;
    }

    /**
     * Method to set the value of field inform_opexp
     *
     * @param integer $inform_opexp
     * @return $this
     */
    public function setInformOpexp($inform_opexp)
    {
        $this->inform_opexp = $inform_opexp;

        return $this;
    }

    /**
     * Method to set the value of field inform_opresult
     *
     * @param string $inform_opresult
     * @return $this
     */
    public function setInformOpresult($inform_opresult)
    {
        $this->inform_opresult = $inform_opresult;

        return $this;
    }

    /**
     * Returns the value of field inform_id
     *
     * @return integer
     */
    public function getInformId()
    {
        return $this->inform_id;
    }

    /**
     * Returns the value of field circle_id
     *
     * @return integer
     */
    public function getCircleId()
    {
        return $this->circle_id;
    }

    /**
     * Returns the value of field circle_name
     *
     * @return string
     */
    public function getCircleName()
    {
        return $this->circle_name;
    }

    /**
     * Returns the value of field theme_id
     *
     * @return integer
     */
    public function getThemeId()
    {
        return $this->theme_id;
    }

    /**
     * Returns the value of field theme_name
     *
     * @return string
     */
    public function getThemeName()
    {
        return $this->theme_name;
    }

    /**
     * Returns the value of field reply_id
     *
     * @return integer
     */
    public function getReplyId()
    {
        return $this->reply_id;
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
     * Returns the value of field inform_content
     *
     * @return string
     */
    public function getInformContent()
    {
        return $this->inform_content;
    }

    /**
     * Returns the value of field inform_time
     *
     * @return string
     */
    public function getInformTime()
    {
        return $this->inform_time;
    }

    /**
     * Returns the value of field inform_type
     *
     * @return integer
     */
    public function getInformType()
    {
        return $this->inform_type;
    }

    /**
     * Returns the value of field inform_state
     *
     * @return integer
     */
    public function getInformState()
    {
        return $this->inform_state;
    }

    /**
     * Returns the value of field inform_opid
     *
     * @return integer
     */
    public function getInformOpid()
    {
        return $this->inform_opid;
    }

    /**
     * Returns the value of field inform_opname
     *
     * @return string
     */
    public function getInformOpname()
    {
        return $this->inform_opname;
    }

    /**
     * Returns the value of field inform_opexp
     *
     * @return integer
     */
    public function getInformOpexp()
    {
        return $this->inform_opexp;
    }

    /**
     * Returns the value of field inform_opresult
     *
     * @return string
     */
    public function getInformOpresult()
    {
        return $this->inform_opresult;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_inform';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleInform[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleInform
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
