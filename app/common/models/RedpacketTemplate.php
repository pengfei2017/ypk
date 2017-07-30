<?php

namespace Ypk\Models;

class RedpacketTemplate extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_t_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $rpacket_t_title;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $rpacket_t_desc;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_t_start_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_t_end_date;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $rpacket_t_price;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $rpacket_t_limit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_t_adminid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $rpacket_t_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_t_total;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_t_giveout;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_t_used;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_t_updatetime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_t_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rpacket_t_eachlimit;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $rpacket_t_customimg;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $rpacket_t_recommend;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $rpacket_t_gettype;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $rpacket_t_isbuild;

    /**
     *
     * @var integer
     * @Column(type="integer", length=2, nullable=false)
     */
    protected $rpacket_t_mgradelimit;

    /**
     * Method to set the value of field rpacket_t_id
     *
     * @param integer $rpacket_t_id
     * @return $this
     */
    public function setRpacketTId($rpacket_t_id)
    {
        $this->rpacket_t_id = $rpacket_t_id;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_title
     *
     * @param string $rpacket_t_title
     * @return $this
     */
    public function setRpacketTTitle($rpacket_t_title)
    {
        $this->rpacket_t_title = $rpacket_t_title;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_desc
     *
     * @param string $rpacket_t_desc
     * @return $this
     */
    public function setRpacketTDesc($rpacket_t_desc)
    {
        $this->rpacket_t_desc = $rpacket_t_desc;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_start_date
     *
     * @param integer $rpacket_t_start_date
     * @return $this
     */
    public function setRpacketTStartDate($rpacket_t_start_date)
    {
        $this->rpacket_t_start_date = $rpacket_t_start_date;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_end_date
     *
     * @param integer $rpacket_t_end_date
     * @return $this
     */
    public function setRpacketTEndDate($rpacket_t_end_date)
    {
        $this->rpacket_t_end_date = $rpacket_t_end_date;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_price
     *
     * @param double $rpacket_t_price
     * @return $this
     */
    public function setRpacketTPrice($rpacket_t_price)
    {
        $this->rpacket_t_price = $rpacket_t_price;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_limit
     *
     * @param double $rpacket_t_limit
     * @return $this
     */
    public function setRpacketTLimit($rpacket_t_limit)
    {
        $this->rpacket_t_limit = $rpacket_t_limit;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_adminid
     *
     * @param integer $rpacket_t_adminid
     * @return $this
     */
    public function setRpacketTAdminid($rpacket_t_adminid)
    {
        $this->rpacket_t_adminid = $rpacket_t_adminid;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_state
     *
     * @param integer $rpacket_t_state
     * @return $this
     */
    public function setRpacketTState($rpacket_t_state)
    {
        $this->rpacket_t_state = $rpacket_t_state;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_total
     *
     * @param integer $rpacket_t_total
     * @return $this
     */
    public function setRpacketTTotal($rpacket_t_total)
    {
        $this->rpacket_t_total = $rpacket_t_total;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_giveout
     *
     * @param integer $rpacket_t_giveout
     * @return $this
     */
    public function setRpacketTGiveout($rpacket_t_giveout)
    {
        $this->rpacket_t_giveout = $rpacket_t_giveout;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_used
     *
     * @param integer $rpacket_t_used
     * @return $this
     */
    public function setRpacketTUsed($rpacket_t_used)
    {
        $this->rpacket_t_used = $rpacket_t_used;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_updatetime
     *
     * @param integer $rpacket_t_updatetime
     * @return $this
     */
    public function setRpacketTUpdatetime($rpacket_t_updatetime)
    {
        $this->rpacket_t_updatetime = $rpacket_t_updatetime;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_points
     *
     * @param integer $rpacket_t_points
     * @return $this
     */
    public function setRpacketTPoints($rpacket_t_points)
    {
        $this->rpacket_t_points = $rpacket_t_points;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_eachlimit
     *
     * @param integer $rpacket_t_eachlimit
     * @return $this
     */
    public function setRpacketTEachlimit($rpacket_t_eachlimit)
    {
        $this->rpacket_t_eachlimit = $rpacket_t_eachlimit;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_customimg
     *
     * @param string $rpacket_t_customimg
     * @return $this
     */
    public function setRpacketTCustomimg($rpacket_t_customimg)
    {
        $this->rpacket_t_customimg = $rpacket_t_customimg;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_recommend
     *
     * @param integer $rpacket_t_recommend
     * @return $this
     */
    public function setRpacketTRecommend($rpacket_t_recommend)
    {
        $this->rpacket_t_recommend = $rpacket_t_recommend;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_gettype
     *
     * @param integer $rpacket_t_gettype
     * @return $this
     */
    public function setRpacketTGettype($rpacket_t_gettype)
    {
        $this->rpacket_t_gettype = $rpacket_t_gettype;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_isbuild
     *
     * @param integer $rpacket_t_isbuild
     * @return $this
     */
    public function setRpacketTIsbuild($rpacket_t_isbuild)
    {
        $this->rpacket_t_isbuild = $rpacket_t_isbuild;

        return $this;
    }

    /**
     * Method to set the value of field rpacket_t_mgradelimit
     *
     * @param integer $rpacket_t_mgradelimit
     * @return $this
     */
    public function setRpacketTMgradelimit($rpacket_t_mgradelimit)
    {
        $this->rpacket_t_mgradelimit = $rpacket_t_mgradelimit;

        return $this;
    }

    /**
     * Returns the value of field rpacket_t_id
     *
     * @return integer
     */
    public function getRpacketTId()
    {
        return $this->rpacket_t_id;
    }

    /**
     * Returns the value of field rpacket_t_title
     *
     * @return string
     */
    public function getRpacketTTitle()
    {
        return $this->rpacket_t_title;
    }

    /**
     * Returns the value of field rpacket_t_desc
     *
     * @return string
     */
    public function getRpacketTDesc()
    {
        return $this->rpacket_t_desc;
    }

    /**
     * Returns the value of field rpacket_t_start_date
     *
     * @return integer
     */
    public function getRpacketTStartDate()
    {
        return $this->rpacket_t_start_date;
    }

    /**
     * Returns the value of field rpacket_t_end_date
     *
     * @return integer
     */
    public function getRpacketTEndDate()
    {
        return $this->rpacket_t_end_date;
    }

    /**
     * Returns the value of field rpacket_t_price
     *
     * @return double
     */
    public function getRpacketTPrice()
    {
        return $this->rpacket_t_price;
    }

    /**
     * Returns the value of field rpacket_t_limit
     *
     * @return double
     */
    public function getRpacketTLimit()
    {
        return $this->rpacket_t_limit;
    }

    /**
     * Returns the value of field rpacket_t_adminid
     *
     * @return integer
     */
    public function getRpacketTAdminid()
    {
        return $this->rpacket_t_adminid;
    }

    /**
     * Returns the value of field rpacket_t_state
     *
     * @return integer
     */
    public function getRpacketTState()
    {
        return $this->rpacket_t_state;
    }

    /**
     * Returns the value of field rpacket_t_total
     *
     * @return integer
     */
    public function getRpacketTTotal()
    {
        return $this->rpacket_t_total;
    }

    /**
     * Returns the value of field rpacket_t_giveout
     *
     * @return integer
     */
    public function getRpacketTGiveout()
    {
        return $this->rpacket_t_giveout;
    }

    /**
     * Returns the value of field rpacket_t_used
     *
     * @return integer
     */
    public function getRpacketTUsed()
    {
        return $this->rpacket_t_used;
    }

    /**
     * Returns the value of field rpacket_t_updatetime
     *
     * @return integer
     */
    public function getRpacketTUpdatetime()
    {
        return $this->rpacket_t_updatetime;
    }

    /**
     * Returns the value of field rpacket_t_points
     *
     * @return integer
     */
    public function getRpacketTPoints()
    {
        return $this->rpacket_t_points;
    }

    /**
     * Returns the value of field rpacket_t_eachlimit
     *
     * @return integer
     */
    public function getRpacketTEachlimit()
    {
        return $this->rpacket_t_eachlimit;
    }

    /**
     * Returns the value of field rpacket_t_customimg
     *
     * @return string
     */
    public function getRpacketTCustomimg()
    {
        return $this->rpacket_t_customimg;
    }

    /**
     * Returns the value of field rpacket_t_recommend
     *
     * @return integer
     */
    public function getRpacketTRecommend()
    {
        return $this->rpacket_t_recommend;
    }

    /**
     * Returns the value of field rpacket_t_gettype
     *
     * @return integer
     */
    public function getRpacketTGettype()
    {
        return $this->rpacket_t_gettype;
    }

    /**
     * Returns the value of field rpacket_t_isbuild
     *
     * @return integer
     */
    public function getRpacketTIsbuild()
    {
        return $this->rpacket_t_isbuild;
    }

    /**
     * Returns the value of field rpacket_t_mgradelimit
     *
     * @return integer
     */
    public function getRpacketTMgradelimit()
    {
        return $this->rpacket_t_mgradelimit;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'redpacket_template';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return RedpacketTemplate[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return RedpacketTemplate
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
