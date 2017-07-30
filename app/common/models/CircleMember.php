<?php

namespace Ypk\Models;

class CircleMember extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $circle_id;

    /**
     *
     * @var string
     * @Column(type="string", length=12, nullable=true)
     */
    protected $circle_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $member_name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $cm_applycontent;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $cm_applytime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $cm_state;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $cm_intro;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $cm_jointime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $cm_level;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $cm_levelname;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $cm_exp;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $cm_nextexp;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    protected $is_identity;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_allowspeak;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $is_star;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $cm_thcount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $cm_comcount;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $cm_lastspeaktime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $is_recommend;

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
     * Method to set the value of field cm_applycontent
     *
     * @param string $cm_applycontent
     * @return $this
     */
    public function setCmApplycontent($cm_applycontent)
    {
        $this->cm_applycontent = $cm_applycontent;

        return $this;
    }

    /**
     * Method to set the value of field cm_applytime
     *
     * @param string $cm_applytime
     * @return $this
     */
    public function setCmApplytime($cm_applytime)
    {
        $this->cm_applytime = $cm_applytime;

        return $this;
    }

    /**
     * Method to set the value of field cm_state
     *
     * @param integer $cm_state
     * @return $this
     */
    public function setCmState($cm_state)
    {
        $this->cm_state = $cm_state;

        return $this;
    }

    /**
     * Method to set the value of field cm_intro
     *
     * @param string $cm_intro
     * @return $this
     */
    public function setCmIntro($cm_intro)
    {
        $this->cm_intro = $cm_intro;

        return $this;
    }

    /**
     * Method to set the value of field cm_jointime
     *
     * @param string $cm_jointime
     * @return $this
     */
    public function setCmJointime($cm_jointime)
    {
        $this->cm_jointime = $cm_jointime;

        return $this;
    }

    /**
     * Method to set the value of field cm_level
     *
     * @param integer $cm_level
     * @return $this
     */
    public function setCmLevel($cm_level)
    {
        $this->cm_level = $cm_level;

        return $this;
    }

    /**
     * Method to set the value of field cm_levelname
     *
     * @param string $cm_levelname
     * @return $this
     */
    public function setCmLevelname($cm_levelname)
    {
        $this->cm_levelname = $cm_levelname;

        return $this;
    }

    /**
     * Method to set the value of field cm_exp
     *
     * @param integer $cm_exp
     * @return $this
     */
    public function setCmExp($cm_exp)
    {
        $this->cm_exp = $cm_exp;

        return $this;
    }

    /**
     * Method to set the value of field cm_nextexp
     *
     * @param integer $cm_nextexp
     * @return $this
     */
    public function setCmNextexp($cm_nextexp)
    {
        $this->cm_nextexp = $cm_nextexp;

        return $this;
    }

    /**
     * Method to set the value of field is_identity
     *
     * @param integer $is_identity
     * @return $this
     */
    public function setIsIdentity($is_identity)
    {
        $this->is_identity = $is_identity;

        return $this;
    }

    /**
     * Method to set the value of field is_allowspeak
     *
     * @param integer $is_allowspeak
     * @return $this
     */
    public function setIsAllowspeak($is_allowspeak)
    {
        $this->is_allowspeak = $is_allowspeak;

        return $this;
    }

    /**
     * Method to set the value of field is_star
     *
     * @param integer $is_star
     * @return $this
     */
    public function setIsStar($is_star)
    {
        $this->is_star = $is_star;

        return $this;
    }

    /**
     * Method to set the value of field cm_thcount
     *
     * @param integer $cm_thcount
     * @return $this
     */
    public function setCmThcount($cm_thcount)
    {
        $this->cm_thcount = $cm_thcount;

        return $this;
    }

    /**
     * Method to set the value of field cm_comcount
     *
     * @param integer $cm_comcount
     * @return $this
     */
    public function setCmComcount($cm_comcount)
    {
        $this->cm_comcount = $cm_comcount;

        return $this;
    }

    /**
     * Method to set the value of field cm_lastspeaktime
     *
     * @param string $cm_lastspeaktime
     * @return $this
     */
    public function setCmLastspeaktime($cm_lastspeaktime)
    {
        $this->cm_lastspeaktime = $cm_lastspeaktime;

        return $this;
    }

    /**
     * Method to set the value of field is_recommend
     *
     * @param integer $is_recommend
     * @return $this
     */
    public function setIsRecommend($is_recommend)
    {
        $this->is_recommend = $is_recommend;

        return $this;
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
     * Returns the value of field member_name
     *
     * @return string
     */
    public function getMemberName()
    {
        return $this->member_name;
    }

    /**
     * Returns the value of field cm_applycontent
     *
     * @return string
     */
    public function getCmApplycontent()
    {
        return $this->cm_applycontent;
    }

    /**
     * Returns the value of field cm_applytime
     *
     * @return string
     */
    public function getCmApplytime()
    {
        return $this->cm_applytime;
    }

    /**
     * Returns the value of field cm_state
     *
     * @return integer
     */
    public function getCmState()
    {
        return $this->cm_state;
    }

    /**
     * Returns the value of field cm_intro
     *
     * @return string
     */
    public function getCmIntro()
    {
        return $this->cm_intro;
    }

    /**
     * Returns the value of field cm_jointime
     *
     * @return string
     */
    public function getCmJointime()
    {
        return $this->cm_jointime;
    }

    /**
     * Returns the value of field cm_level
     *
     * @return integer
     */
    public function getCmLevel()
    {
        return $this->cm_level;
    }

    /**
     * Returns the value of field cm_levelname
     *
     * @return string
     */
    public function getCmLevelname()
    {
        return $this->cm_levelname;
    }

    /**
     * Returns the value of field cm_exp
     *
     * @return integer
     */
    public function getCmExp()
    {
        return $this->cm_exp;
    }

    /**
     * Returns the value of field cm_nextexp
     *
     * @return integer
     */
    public function getCmNextexp()
    {
        return $this->cm_nextexp;
    }

    /**
     * Returns the value of field is_identity
     *
     * @return integer
     */
    public function getIsIdentity()
    {
        return $this->is_identity;
    }

    /**
     * Returns the value of field is_allowspeak
     *
     * @return integer
     */
    public function getIsAllowspeak()
    {
        return $this->is_allowspeak;
    }

    /**
     * Returns the value of field is_star
     *
     * @return integer
     */
    public function getIsStar()
    {
        return $this->is_star;
    }

    /**
     * Returns the value of field cm_thcount
     *
     * @return integer
     */
    public function getCmThcount()
    {
        return $this->cm_thcount;
    }

    /**
     * Returns the value of field cm_comcount
     *
     * @return integer
     */
    public function getCmComcount()
    {
        return $this->cm_comcount;
    }

    /**
     * Returns the value of field cm_lastspeaktime
     *
     * @return string
     */
    public function getCmLastspeaktime()
    {
        return $this->cm_lastspeaktime;
    }

    /**
     * Returns the value of field is_recommend
     *
     * @return integer
     */
    public function getIsRecommend()
    {
        return $this->is_recommend;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle_member';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleMember[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CircleMember
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
