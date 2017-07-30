<?php

namespace Ypk\Models;

class MbCategory extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=5, nullable=false)
     */
    protected $gc_id;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $gc_thumb;

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
     * Method to set the value of field gc_thumb
     *
     * @param string $gc_thumb
     * @return $this
     */
    public function setGcThumb($gc_thumb)
    {
        $this->gc_thumb = $gc_thumb;

        return $this;
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
     * Returns the value of field gc_thumb
     *
     * @return string
     */
    public function getGcThumb()
    {
        return $this->gc_thumb;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'mb_category';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MbCategory[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MbCategory
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
