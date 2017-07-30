<?php

namespace Ypk\Models;

class ArticleClass extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $ac_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $ac_code;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $ac_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $ac_parent_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $ac_sort;

    /**
     * Method to set the value of field ac_id
     *
     * @param integer $ac_id
     * @return $this
     */
    public function setAcId($ac_id)
    {
        $this->ac_id = $ac_id;

        return $this;
    }

    /**
     * Method to set the value of field ac_code
     *
     * @param string $ac_code
     * @return $this
     */
    public function setAcCode($ac_code)
    {
        $this->ac_code = $ac_code;

        return $this;
    }

    /**
     * Method to set the value of field ac_name
     *
     * @param string $ac_name
     * @return $this
     */
    public function setAcName($ac_name)
    {
        $this->ac_name = $ac_name;

        return $this;
    }

    /**
     * Method to set the value of field ac_parent_id
     *
     * @param integer $ac_parent_id
     * @return $this
     */
    public function setAcParentId($ac_parent_id)
    {
        $this->ac_parent_id = $ac_parent_id;

        return $this;
    }

    /**
     * Method to set the value of field ac_sort
     *
     * @param integer $ac_sort
     * @return $this
     */
    public function setAcSort($ac_sort)
    {
        $this->ac_sort = $ac_sort;

        return $this;
    }

    /**
     * Returns the value of field ac_id
     *
     * @return integer
     */
    public function getAcId()
    {
        return $this->ac_id;
    }

    /**
     * Returns the value of field ac_code
     *
     * @return string
     */
    public function getAcCode()
    {
        return $this->ac_code;
    }

    /**
     * Returns the value of field ac_name
     *
     * @return string
     */
    public function getAcName()
    {
        return $this->ac_name;
    }

    /**
     * Returns the value of field ac_parent_id
     *
     * @return integer
     */
    public function getAcParentId()
    {
        return $this->ac_parent_id;
    }

    /**
     * Returns the value of field ac_sort
     *
     * @return integer
     */
    public function getAcSort()
    {
        return $this->ac_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'article_class';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ArticleClass[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ArticleClass
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
