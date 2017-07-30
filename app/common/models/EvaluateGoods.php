<?php

namespace Ypk\Models;

class EvaluateGoods extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $geval_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $geval_orderid;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $geval_orderno;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $geval_ordergoodsid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $geval_goodsid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $geval_goodsname;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $geval_goodsprice;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $geval_goodsimage;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $geval_scores;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $geval_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $geval_isanonymous;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $geval_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $geval_storeid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $geval_storename;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $geval_frommemberid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $geval_frommembername;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $geval_explain;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $geval_image;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $geval_content_again;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $geval_addtime_again;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $geval_image_again;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $geval_explain_again;

    /**
     * Method to set the value of field geval_id
     *
     * @param integer $geval_id
     * @return $this
     */
    public function setGevalId($geval_id)
    {
        $this->geval_id = $geval_id;

        return $this;
    }

    /**
     * Method to set the value of field geval_orderid
     *
     * @param integer $geval_orderid
     * @return $this
     */
    public function setGevalOrderid($geval_orderid)
    {
        $this->geval_orderid = $geval_orderid;

        return $this;
    }

    /**
     * Method to set the value of field geval_orderno
     *
     * @param string $geval_orderno
     * @return $this
     */
    public function setGevalOrderno($geval_orderno)
    {
        $this->geval_orderno = $geval_orderno;

        return $this;
    }

    /**
     * Method to set the value of field geval_ordergoodsid
     *
     * @param integer $geval_ordergoodsid
     * @return $this
     */
    public function setGevalOrdergoodsid($geval_ordergoodsid)
    {
        $this->geval_ordergoodsid = $geval_ordergoodsid;

        return $this;
    }

    /**
     * Method to set the value of field geval_goodsid
     *
     * @param integer $geval_goodsid
     * @return $this
     */
    public function setGevalGoodsid($geval_goodsid)
    {
        $this->geval_goodsid = $geval_goodsid;

        return $this;
    }

    /**
     * Method to set the value of field geval_goodsname
     *
     * @param string $geval_goodsname
     * @return $this
     */
    public function setGevalGoodsname($geval_goodsname)
    {
        $this->geval_goodsname = $geval_goodsname;

        return $this;
    }

    /**
     * Method to set the value of field geval_goodsprice
     *
     * @param double $geval_goodsprice
     * @return $this
     */
    public function setGevalGoodsprice($geval_goodsprice)
    {
        $this->geval_goodsprice = $geval_goodsprice;

        return $this;
    }

    /**
     * Method to set the value of field geval_goodsimage
     *
     * @param string $geval_goodsimage
     * @return $this
     */
    public function setGevalGoodsimage($geval_goodsimage)
    {
        $this->geval_goodsimage = $geval_goodsimage;

        return $this;
    }

    /**
     * Method to set the value of field geval_scores
     *
     * @param integer $geval_scores
     * @return $this
     */
    public function setGevalScores($geval_scores)
    {
        $this->geval_scores = $geval_scores;

        return $this;
    }

    /**
     * Method to set the value of field geval_content
     *
     * @param string $geval_content
     * @return $this
     */
    public function setGevalContent($geval_content)
    {
        $this->geval_content = $geval_content;

        return $this;
    }

    /**
     * Method to set the value of field geval_isanonymous
     *
     * @param integer $geval_isanonymous
     * @return $this
     */
    public function setGevalIsanonymous($geval_isanonymous)
    {
        $this->geval_isanonymous = $geval_isanonymous;

        return $this;
    }

    /**
     * Method to set the value of field geval_addtime
     *
     * @param integer $geval_addtime
     * @return $this
     */
    public function setGevalAddtime($geval_addtime)
    {
        $this->geval_addtime = $geval_addtime;

        return $this;
    }

    /**
     * Method to set the value of field geval_storeid
     *
     * @param integer $geval_storeid
     * @return $this
     */
    public function setGevalStoreid($geval_storeid)
    {
        $this->geval_storeid = $geval_storeid;

        return $this;
    }

    /**
     * Method to set the value of field geval_storename
     *
     * @param string $geval_storename
     * @return $this
     */
    public function setGevalStorename($geval_storename)
    {
        $this->geval_storename = $geval_storename;

        return $this;
    }

    /**
     * Method to set the value of field geval_frommemberid
     *
     * @param integer $geval_frommemberid
     * @return $this
     */
    public function setGevalFrommemberid($geval_frommemberid)
    {
        $this->geval_frommemberid = $geval_frommemberid;

        return $this;
    }

    /**
     * Method to set the value of field geval_frommembername
     *
     * @param string $geval_frommembername
     * @return $this
     */
    public function setGevalFrommembername($geval_frommembername)
    {
        $this->geval_frommembername = $geval_frommembername;

        return $this;
    }

    /**
     * Method to set the value of field geval_explain
     *
     * @param string $geval_explain
     * @return $this
     */
    public function setGevalExplain($geval_explain)
    {
        $this->geval_explain = $geval_explain;

        return $this;
    }

    /**
     * Method to set the value of field geval_image
     *
     * @param string $geval_image
     * @return $this
     */
    public function setGevalImage($geval_image)
    {
        $this->geval_image = $geval_image;

        return $this;
    }

    /**
     * Method to set the value of field geval_content_again
     *
     * @param string $geval_content_again
     * @return $this
     */
    public function setGevalContentAgain($geval_content_again)
    {
        $this->geval_content_again = $geval_content_again;

        return $this;
    }

    /**
     * Method to set the value of field geval_addtime_again
     *
     * @param integer $geval_addtime_again
     * @return $this
     */
    public function setGevalAddtimeAgain($geval_addtime_again)
    {
        $this->geval_addtime_again = $geval_addtime_again;

        return $this;
    }

    /**
     * Method to set the value of field geval_image_again
     *
     * @param string $geval_image_again
     * @return $this
     */
    public function setGevalImageAgain($geval_image_again)
    {
        $this->geval_image_again = $geval_image_again;

        return $this;
    }

    /**
     * Method to set the value of field geval_explain_again
     *
     * @param string $geval_explain_again
     * @return $this
     */
    public function setGevalExplainAgain($geval_explain_again)
    {
        $this->geval_explain_again = $geval_explain_again;

        return $this;
    }

    /**
     * Returns the value of field geval_id
     *
     * @return integer
     */
    public function getGevalId()
    {
        return $this->geval_id;
    }

    /**
     * Returns the value of field geval_orderid
     *
     * @return integer
     */
    public function getGevalOrderid()
    {
        return $this->geval_orderid;
    }

    /**
     * Returns the value of field geval_orderno
     *
     * @return string
     */
    public function getGevalOrderno()
    {
        return $this->geval_orderno;
    }

    /**
     * Returns the value of field geval_ordergoodsid
     *
     * @return integer
     */
    public function getGevalOrdergoodsid()
    {
        return $this->geval_ordergoodsid;
    }

    /**
     * Returns the value of field geval_goodsid
     *
     * @return integer
     */
    public function getGevalGoodsid()
    {
        return $this->geval_goodsid;
    }

    /**
     * Returns the value of field geval_goodsname
     *
     * @return string
     */
    public function getGevalGoodsname()
    {
        return $this->geval_goodsname;
    }

    /**
     * Returns the value of field geval_goodsprice
     *
     * @return double
     */
    public function getGevalGoodsprice()
    {
        return $this->geval_goodsprice;
    }

    /**
     * Returns the value of field geval_goodsimage
     *
     * @return string
     */
    public function getGevalGoodsimage()
    {
        return $this->geval_goodsimage;
    }

    /**
     * Returns the value of field geval_scores
     *
     * @return integer
     */
    public function getGevalScores()
    {
        return $this->geval_scores;
    }

    /**
     * Returns the value of field geval_content
     *
     * @return string
     */
    public function getGevalContent()
    {
        return $this->geval_content;
    }

    /**
     * Returns the value of field geval_isanonymous
     *
     * @return integer
     */
    public function getGevalIsanonymous()
    {
        return $this->geval_isanonymous;
    }

    /**
     * Returns the value of field geval_addtime
     *
     * @return integer
     */
    public function getGevalAddtime()
    {
        return $this->geval_addtime;
    }

    /**
     * Returns the value of field geval_storeid
     *
     * @return integer
     */
    public function getGevalStoreid()
    {
        return $this->geval_storeid;
    }

    /**
     * Returns the value of field geval_storename
     *
     * @return string
     */
    public function getGevalStorename()
    {
        return $this->geval_storename;
    }

    /**
     * Returns the value of field geval_frommemberid
     *
     * @return integer
     */
    public function getGevalFrommemberid()
    {
        return $this->geval_frommemberid;
    }

    /**
     * Returns the value of field geval_frommembername
     *
     * @return string
     */
    public function getGevalFrommembername()
    {
        return $this->geval_frommembername;
    }

    /**
     * Returns the value of field geval_explain
     *
     * @return string
     */
    public function getGevalExplain()
    {
        return $this->geval_explain;
    }

    /**
     * Returns the value of field geval_image
     *
     * @return string
     */
    public function getGevalImage()
    {
        return $this->geval_image;
    }

    /**
     * Returns the value of field geval_content_again
     *
     * @return string
     */
    public function getGevalContentAgain()
    {
        return $this->geval_content_again;
    }

    /**
     * Returns the value of field geval_addtime_again
     *
     * @return integer
     */
    public function getGevalAddtimeAgain()
    {
        return $this->geval_addtime_again;
    }

    /**
     * Returns the value of field geval_image_again
     *
     * @return string
     */
    public function getGevalImageAgain()
    {
        return $this->geval_image_again;
    }

    /**
     * Returns the value of field geval_explain_again
     *
     * @return string
     */
    public function getGevalExplainAgain()
    {
        return $this->geval_explain_again;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'evaluate_goods';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return EvaluateGoods[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return EvaluateGoods
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
