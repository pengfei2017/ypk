<?php

namespace Ypk\Models;

class PointsCart extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pcart_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pmember_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pgoods_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $pgoods_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pgoods_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pgoods_choosenum;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $pgoods_image;

    /**
     * Method to set the value of field pcart_id
     *
     * @param integer $pcart_id
     * @return $this
     */
    public function setPcartId($pcart_id)
    {
        $this->pcart_id = $pcart_id;

        return $this;
    }

    /**
     * Method to set the value of field pmember_id
     *
     * @param integer $pmember_id
     * @return $this
     */
    public function setPmemberId($pmember_id)
    {
        $this->pmember_id = $pmember_id;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_id
     *
     * @param integer $pgoods_id
     * @return $this
     */
    public function setPgoodsId($pgoods_id)
    {
        $this->pgoods_id = $pgoods_id;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_name
     *
     * @param string $pgoods_name
     * @return $this
     */
    public function setPgoodsName($pgoods_name)
    {
        $this->pgoods_name = $pgoods_name;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_points
     *
     * @param integer $pgoods_points
     * @return $this
     */
    public function setPgoodsPoints($pgoods_points)
    {
        $this->pgoods_points = $pgoods_points;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_choosenum
     *
     * @param integer $pgoods_choosenum
     * @return $this
     */
    public function setPgoodsChoosenum($pgoods_choosenum)
    {
        $this->pgoods_choosenum = $pgoods_choosenum;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_image
     *
     * @param string $pgoods_image
     * @return $this
     */
    public function setPgoodsImage($pgoods_image)
    {
        $this->pgoods_image = $pgoods_image;

        return $this;
    }

    /**
     * Returns the value of field pcart_id
     *
     * @return integer
     */
    public function getPcartId()
    {
        return $this->pcart_id;
    }

    /**
     * Returns the value of field pmember_id
     *
     * @return integer
     */
    public function getPmemberId()
    {
        return $this->pmember_id;
    }

    /**
     * Returns the value of field pgoods_id
     *
     * @return integer
     */
    public function getPgoodsId()
    {
        return $this->pgoods_id;
    }

    /**
     * Returns the value of field pgoods_name
     *
     * @return string
     */
    public function getPgoodsName()
    {
        return $this->pgoods_name;
    }

    /**
     * Returns the value of field pgoods_points
     *
     * @return integer
     */
    public function getPgoodsPoints()
    {
        return $this->pgoods_points;
    }

    /**
     * Returns the value of field pgoods_choosenum
     *
     * @return integer
     */
    public function getPgoodsChoosenum()
    {
        return $this->pgoods_choosenum;
    }

    /**
     * Returns the value of field pgoods_image
     *
     * @return string
     */
    public function getPgoodsImage()
    {
        return $this->pgoods_image;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'points_cart';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PointsCart[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PointsCart
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
