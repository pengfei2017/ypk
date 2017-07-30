<?php

namespace Ypk\Models;

class Link extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $link_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $link_title;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $link_url;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $link_pic;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $link_sort;

    /**
     * Method to set the value of field link_id
     *
     * @param integer $link_id
     * @return $this
     */
    public function setLinkId($link_id)
    {
        $this->link_id = $link_id;

        return $this;
    }

    /**
     * Method to set the value of field link_title
     *
     * @param string $link_title
     * @return $this
     */
    public function setLinkTitle($link_title)
    {
        $this->link_title = $link_title;

        return $this;
    }

    /**
     * Method to set the value of field link_url
     *
     * @param string $link_url
     * @return $this
     */
    public function setLinkUrl($link_url)
    {
        $this->link_url = $link_url;

        return $this;
    }

    /**
     * Method to set the value of field link_pic
     *
     * @param string $link_pic
     * @return $this
     */
    public function setLinkPic($link_pic)
    {
        $this->link_pic = $link_pic;

        return $this;
    }

    /**
     * Method to set the value of field link_sort
     *
     * @param integer $link_sort
     * @return $this
     */
    public function setLinkSort($link_sort)
    {
        $this->link_sort = $link_sort;

        return $this;
    }

    /**
     * Returns the value of field link_id
     *
     * @return integer
     */
    public function getLinkId()
    {
        return $this->link_id;
    }

    /**
     * Returns the value of field link_title
     *
     * @return string
     */
    public function getLinkTitle()
    {
        return $this->link_title;
    }

    /**
     * Returns the value of field link_url
     *
     * @return string
     */
    public function getLinkUrl()
    {
        return $this->link_url;
    }

    /**
     * Returns the value of field link_pic
     *
     * @return string
     */
    public function getLinkPic()
    {
        return $this->link_pic;
    }

    /**
     * Returns the value of field link_sort
     *
     * @return integer
     */
    public function getLinkSort()
    {
        return $this->link_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'link';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Link[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Link
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
