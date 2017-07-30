<?php

namespace Ypk\Models;

class MicroAdv extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $adv_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $adv_type;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $adv_name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $adv_image;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $adv_url;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $adv_sort;

    /**
     * Method to set the value of field adv_id
     *
     * @param integer $adv_id
     * @return $this
     */
    public function setAdvId($adv_id)
    {
        $this->adv_id = $adv_id;

        return $this;
    }

    /**
     * Method to set the value of field adv_type
     *
     * @param string $adv_type
     * @return $this
     */
    public function setAdvType($adv_type)
    {
        $this->adv_type = $adv_type;

        return $this;
    }

    /**
     * Method to set the value of field adv_name
     *
     * @param string $adv_name
     * @return $this
     */
    public function setAdvName($adv_name)
    {
        $this->adv_name = $adv_name;

        return $this;
    }

    /**
     * Method to set the value of field adv_image
     *
     * @param string $adv_image
     * @return $this
     */
    public function setAdvImage($adv_image)
    {
        $this->adv_image = $adv_image;

        return $this;
    }

    /**
     * Method to set the value of field adv_url
     *
     * @param string $adv_url
     * @return $this
     */
    public function setAdvUrl($adv_url)
    {
        $this->adv_url = $adv_url;

        return $this;
    }

    /**
     * Method to set the value of field adv_sort
     *
     * @param integer $adv_sort
     * @return $this
     */
    public function setAdvSort($adv_sort)
    {
        $this->adv_sort = $adv_sort;

        return $this;
    }

    /**
     * Returns the value of field adv_id
     *
     * @return integer
     */
    public function getAdvId()
    {
        return $this->adv_id;
    }

    /**
     * Returns the value of field adv_type
     *
     * @return string
     */
    public function getAdvType()
    {
        return $this->adv_type;
    }

    /**
     * Returns the value of field adv_name
     *
     * @return string
     */
    public function getAdvName()
    {
        return $this->adv_name;
    }

    /**
     * Returns the value of field adv_image
     *
     * @return string
     */
    public function getAdvImage()
    {
        return $this->adv_image;
    }

    /**
     * Returns the value of field adv_url
     *
     * @return string
     */
    public function getAdvUrl()
    {
        return $this->adv_url;
    }

    /**
     * Returns the value of field adv_sort
     *
     * @return integer
     */
    public function getAdvSort()
    {
        return $this->adv_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'micro_adv';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MicroAdv[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MicroAdv
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
