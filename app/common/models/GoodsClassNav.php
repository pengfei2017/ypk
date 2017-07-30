<?php

namespace Ypk\Models;

class GoodsClassNav extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $cn_adv2_link;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $gc_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $cn_alias;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $cn_classids;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $cn_brandids;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $cn_pic;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $cn_adv1;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $cn_adv1_link;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $cn_adv2;

    /**
     * Method to set the value of field cn_adv2_link
     *
     * @param string $cn_adv2_link
     * @return $this
     */
    public function setCnAdv2Link($cn_adv2_link)
    {
        $this->cn_adv2_link = $cn_adv2_link;

        return $this;
    }

    /**
     * Method to set the value of field gc_id
     *
     * @param integer $gc_id
     * @return $this
     */
    public function setGcId($gc_id)
    {
        $this->gc_id = $gc_id;

        return $this;
    }

    /**
     * Method to set the value of field cn_alias
     *
     * @param string $cn_alias
     * @return $this
     */
    public function setCnAlias($cn_alias)
    {
        $this->cn_alias = $cn_alias;

        return $this;
    }

    /**
     * Method to set the value of field cn_classids
     *
     * @param string $cn_classids
     * @return $this
     */
    public function setCnClassids($cn_classids)
    {
        $this->cn_classids = $cn_classids;

        return $this;
    }

    /**
     * Method to set the value of field cn_brandids
     *
     * @param string $cn_brandids
     * @return $this
     */
    public function setCnBrandids($cn_brandids)
    {
        $this->cn_brandids = $cn_brandids;

        return $this;
    }

    /**
     * Method to set the value of field cn_pic
     *
     * @param string $cn_pic
     * @return $this
     */
    public function setCnPic($cn_pic)
    {
        $this->cn_pic = $cn_pic;

        return $this;
    }

    /**
     * Method to set the value of field cn_adv1
     *
     * @param string $cn_adv1
     * @return $this
     */
    public function setCnAdv1($cn_adv1)
    {
        $this->cn_adv1 = $cn_adv1;

        return $this;
    }

    /**
     * Method to set the value of field cn_adv1_link
     *
     * @param string $cn_adv1_link
     * @return $this
     */
    public function setCnAdv1Link($cn_adv1_link)
    {
        $this->cn_adv1_link = $cn_adv1_link;

        return $this;
    }

    /**
     * Method to set the value of field cn_adv2
     *
     * @param string $cn_adv2
     * @return $this
     */
    public function setCnAdv2($cn_adv2)
    {
        $this->cn_adv2 = $cn_adv2;

        return $this;
    }

    /**
     * Returns the value of field cn_adv2_link
     *
     * @return string
     */
    public function getCnAdv2Link()
    {
        return $this->cn_adv2_link;
    }

    /**
     * Returns the value of field gc_id
     *
     * @return integer
     */
    public function getGcId()
    {
        return $this->gc_id;
    }

    /**
     * Returns the value of field cn_alias
     *
     * @return string
     */
    public function getCnAlias()
    {
        return $this->cn_alias;
    }

    /**
     * Returns the value of field cn_classids
     *
     * @return string
     */
    public function getCnClassids()
    {
        return $this->cn_classids;
    }

    /**
     * Returns the value of field cn_brandids
     *
     * @return string
     */
    public function getCnBrandids()
    {
        return $this->cn_brandids;
    }

    /**
     * Returns the value of field cn_pic
     *
     * @return string
     */
    public function getCnPic()
    {
        return $this->cn_pic;
    }

    /**
     * Returns the value of field cn_adv1
     *
     * @return string
     */
    public function getCnAdv1()
    {
        return $this->cn_adv1;
    }

    /**
     * Returns the value of field cn_adv1_link
     *
     * @return string
     */
    public function getCnAdv1Link()
    {
        return $this->cn_adv1_link;
    }

    /**
     * Returns the value of field cn_adv2
     *
     * @return string
     */
    public function getCnAdv2()
    {
        return $this->cn_adv2;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'goods_class_nav';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsClassNav[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsClassNav
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
