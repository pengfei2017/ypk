<?php

namespace Ypk\Models;

class SnsGoods extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $snsgoods_goodsid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $snsgoods_goodsname;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $snsgoods_goodsimage;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $snsgoods_goodsprice;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $snsgoods_storeid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $snsgoods_storename;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $snsgoods_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $snsgoods_likenum;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $snsgoods_likemember;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $snsgoods_sharenum;

    /**
     * Method to set the value of field snsgoods_goodsid
     *
     * @param integer $snsgoods_goodsid
     * @return $this
     */
    public function setSnsgoodsGoodsid($snsgoods_goodsid)
    {
        $this->snsgoods_goodsid = $snsgoods_goodsid;

        return $this;
    }

    /**
     * Method to set the value of field snsgoods_goodsname
     *
     * @param string $snsgoods_goodsname
     * @return $this
     */
    public function setSnsgoodsGoodsname($snsgoods_goodsname)
    {
        $this->snsgoods_goodsname = $snsgoods_goodsname;

        return $this;
    }

    /**
     * Method to set the value of field snsgoods_goodsimage
     *
     * @param string $snsgoods_goodsimage
     * @return $this
     */
    public function setSnsgoodsGoodsimage($snsgoods_goodsimage)
    {
        $this->snsgoods_goodsimage = $snsgoods_goodsimage;

        return $this;
    }

    /**
     * Method to set the value of field snsgoods_goodsprice
     *
     * @param double $snsgoods_goodsprice
     * @return $this
     */
    public function setSnsgoodsGoodsprice($snsgoods_goodsprice)
    {
        $this->snsgoods_goodsprice = $snsgoods_goodsprice;

        return $this;
    }

    /**
     * Method to set the value of field snsgoods_storeid
     *
     * @param integer $snsgoods_storeid
     * @return $this
     */
    public function setSnsgoodsStoreid($snsgoods_storeid)
    {
        $this->snsgoods_storeid = $snsgoods_storeid;

        return $this;
    }

    /**
     * Method to set the value of field snsgoods_storename
     *
     * @param string $snsgoods_storename
     * @return $this
     */
    public function setSnsgoodsStorename($snsgoods_storename)
    {
        $this->snsgoods_storename = $snsgoods_storename;

        return $this;
    }

    /**
     * Method to set the value of field snsgoods_addtime
     *
     * @param integer $snsgoods_addtime
     * @return $this
     */
    public function setSnsgoodsAddtime($snsgoods_addtime)
    {
        $this->snsgoods_addtime = $snsgoods_addtime;

        return $this;
    }

    /**
     * Method to set the value of field snsgoods_likenum
     *
     * @param integer $snsgoods_likenum
     * @return $this
     */
    public function setSnsgoodsLikenum($snsgoods_likenum)
    {
        $this->snsgoods_likenum = $snsgoods_likenum;

        return $this;
    }

    /**
     * Method to set the value of field snsgoods_likemember
     *
     * @param string $snsgoods_likemember
     * @return $this
     */
    public function setSnsgoodsLikemember($snsgoods_likemember)
    {
        $this->snsgoods_likemember = $snsgoods_likemember;

        return $this;
    }

    /**
     * Method to set the value of field snsgoods_sharenum
     *
     * @param integer $snsgoods_sharenum
     * @return $this
     */
    public function setSnsgoodsSharenum($snsgoods_sharenum)
    {
        $this->snsgoods_sharenum = $snsgoods_sharenum;

        return $this;
    }

    /**
     * Returns the value of field snsgoods_goodsid
     *
     * @return integer
     */
    public function getSnsgoodsGoodsid()
    {
        return $this->snsgoods_goodsid;
    }

    /**
     * Returns the value of field snsgoods_goodsname
     *
     * @return string
     */
    public function getSnsgoodsGoodsname()
    {
        return $this->snsgoods_goodsname;
    }

    /**
     * Returns the value of field snsgoods_goodsimage
     *
     * @return string
     */
    public function getSnsgoodsGoodsimage()
    {
        return $this->snsgoods_goodsimage;
    }

    /**
     * Returns the value of field snsgoods_goodsprice
     *
     * @return double
     */
    public function getSnsgoodsGoodsprice()
    {
        return $this->snsgoods_goodsprice;
    }

    /**
     * Returns the value of field snsgoods_storeid
     *
     * @return integer
     */
    public function getSnsgoodsStoreid()
    {
        return $this->snsgoods_storeid;
    }

    /**
     * Returns the value of field snsgoods_storename
     *
     * @return string
     */
    public function getSnsgoodsStorename()
    {
        return $this->snsgoods_storename;
    }

    /**
     * Returns the value of field snsgoods_addtime
     *
     * @return integer
     */
    public function getSnsgoodsAddtime()
    {
        return $this->snsgoods_addtime;
    }

    /**
     * Returns the value of field snsgoods_likenum
     *
     * @return integer
     */
    public function getSnsgoodsLikenum()
    {
        return $this->snsgoods_likenum;
    }

    /**
     * Returns the value of field snsgoods_likemember
     *
     * @return string
     */
    public function getSnsgoodsLikemember()
    {
        return $this->snsgoods_likemember;
    }

    /**
     * Returns the value of field snsgoods_sharenum
     *
     * @return integer
     */
    public function getSnsgoodsSharenum()
    {
        return $this->snsgoods_sharenum;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'sns_goods';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsGoods[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsGoods
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
