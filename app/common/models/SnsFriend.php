<?php

namespace Ypk\Models;

class SnsFriend extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $friend_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $friend_frommid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $friend_frommname;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $friend_frommavatar;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $friend_tomid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $friend_tomname;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $friend_tomavatar;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $friend_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $friend_followstate;

    /**
     * Method to set the value of field friend_id
     *
     * @param integer $friend_id
     * @return $this
     */
    public function setFriendId($friend_id)
    {
        $this->friend_id = $friend_id;

        return $this;
    }

    /**
     * Method to set the value of field friend_frommid
     *
     * @param integer $friend_frommid
     * @return $this
     */
    public function setFriendFrommid($friend_frommid)
    {
        $this->friend_frommid = $friend_frommid;

        return $this;
    }

    /**
     * Method to set the value of field friend_frommname
     *
     * @param string $friend_frommname
     * @return $this
     */
    public function setFriendFrommname($friend_frommname)
    {
        $this->friend_frommname = $friend_frommname;

        return $this;
    }

    /**
     * Method to set the value of field friend_frommavatar
     *
     * @param string $friend_frommavatar
     * @return $this
     */
    public function setFriendFrommavatar($friend_frommavatar)
    {
        $this->friend_frommavatar = $friend_frommavatar;

        return $this;
    }

    /**
     * Method to set the value of field friend_tomid
     *
     * @param integer $friend_tomid
     * @return $this
     */
    public function setFriendTomid($friend_tomid)
    {
        $this->friend_tomid = $friend_tomid;

        return $this;
    }

    /**
     * Method to set the value of field friend_tomname
     *
     * @param string $friend_tomname
     * @return $this
     */
    public function setFriendTomname($friend_tomname)
    {
        $this->friend_tomname = $friend_tomname;

        return $this;
    }

    /**
     * Method to set the value of field friend_tomavatar
     *
     * @param string $friend_tomavatar
     * @return $this
     */
    public function setFriendTomavatar($friend_tomavatar)
    {
        $this->friend_tomavatar = $friend_tomavatar;

        return $this;
    }

    /**
     * Method to set the value of field friend_addtime
     *
     * @param integer $friend_addtime
     * @return $this
     */
    public function setFriendAddtime($friend_addtime)
    {
        $this->friend_addtime = $friend_addtime;

        return $this;
    }

    /**
     * Method to set the value of field friend_followstate
     *
     * @param integer $friend_followstate
     * @return $this
     */
    public function setFriendFollowstate($friend_followstate)
    {
        $this->friend_followstate = $friend_followstate;

        return $this;
    }

    /**
     * Returns the value of field friend_id
     *
     * @return integer
     */
    public function getFriendId()
    {
        return $this->friend_id;
    }

    /**
     * Returns the value of field friend_frommid
     *
     * @return integer
     */
    public function getFriendFrommid()
    {
        return $this->friend_frommid;
    }

    /**
     * Returns the value of field friend_frommname
     *
     * @return string
     */
    public function getFriendFrommname()
    {
        return $this->friend_frommname;
    }

    /**
     * Returns the value of field friend_frommavatar
     *
     * @return string
     */
    public function getFriendFrommavatar()
    {
        return $this->friend_frommavatar;
    }

    /**
     * Returns the value of field friend_tomid
     *
     * @return integer
     */
    public function getFriendTomid()
    {
        return $this->friend_tomid;
    }

    /**
     * Returns the value of field friend_tomname
     *
     * @return string
     */
    public function getFriendTomname()
    {
        return $this->friend_tomname;
    }

    /**
     * Returns the value of field friend_tomavatar
     *
     * @return string
     */
    public function getFriendTomavatar()
    {
        return $this->friend_tomavatar;
    }

    /**
     * Returns the value of field friend_addtime
     *
     * @return integer
     */
    public function getFriendAddtime()
    {
        return $this->friend_addtime;
    }

    /**
     * Returns the value of field friend_followstate
     *
     * @return integer
     */
    public function getFriendFollowstate()
    {
        return $this->friend_followstate;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'sns_friend';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsFriend[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsFriend
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
