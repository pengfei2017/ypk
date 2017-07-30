<?php

namespace Ypk\Models;

class RecPosition extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $rec_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $pic_type;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $title;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $content;

    /**
     * Method to set the value of field rec_id
     *
     * @param integer $rec_id
     * @return $this
     */
    public function setRecId($rec_id)
    {
        $this->rec_id = $rec_id;

        return $this;
    }

    /**
     * Method to set the value of field pic_type
     *
     * @param string $pic_type
     * @return $this
     */
    public function setPicType($pic_type)
    {
        $this->pic_type = $pic_type;

        return $this;
    }

    /**
     * Method to set the value of field title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Method to set the value of field content
     *
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Returns the value of field rec_id
     *
     * @return integer
     */
    public function getRecId()
    {
        return $this->rec_id;
    }

    /**
     * Returns the value of field pic_type
     *
     * @return string
     */
    public function getPicType()
    {
        return $this->pic_type;
    }

    /**
     * Returns the value of field title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns the value of field content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'rec_position';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return RecPosition[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return RecPosition
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
