<?php

namespace Ypk\Models;

class CmsNavigation extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $navigation_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $navigation_title;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $navigation_link;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $navigation_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $navigation_open_type;

    /**
     * Method to set the value of field navigation_id
     *
     * @param integer $navigation_id
     * @return $this
     */
    public function setNavigationId($navigation_id)
    {
        $this->navigation_id = $navigation_id;

        return $this;
    }

    /**
     * Method to set the value of field navigation_title
     *
     * @param string $navigation_title
     * @return $this
     */
    public function setNavigationTitle($navigation_title)
    {
        $this->navigation_title = $navigation_title;

        return $this;
    }

    /**
     * Method to set the value of field navigation_link
     *
     * @param string $navigation_link
     * @return $this
     */
    public function setNavigationLink($navigation_link)
    {
        $this->navigation_link = $navigation_link;

        return $this;
    }

    /**
     * Method to set the value of field navigation_sort
     *
     * @param integer $navigation_sort
     * @return $this
     */
    public function setNavigationSort($navigation_sort)
    {
        $this->navigation_sort = $navigation_sort;

        return $this;
    }

    /**
     * Method to set the value of field navigation_open_type
     *
     * @param integer $navigation_open_type
     * @return $this
     */
    public function setNavigationOpenType($navigation_open_type)
    {
        $this->navigation_open_type = $navigation_open_type;

        return $this;
    }

    /**
     * Returns the value of field navigation_id
     *
     * @return integer
     */
    public function getNavigationId()
    {
        return $this->navigation_id;
    }

    /**
     * Returns the value of field navigation_title
     *
     * @return string
     */
    public function getNavigationTitle()
    {
        return $this->navigation_title;
    }

    /**
     * Returns the value of field navigation_link
     *
     * @return string
     */
    public function getNavigationLink()
    {
        return $this->navigation_link;
    }

    /**
     * Returns the value of field navigation_sort
     *
     * @return integer
     */
    public function getNavigationSort()
    {
        return $this->navigation_sort;
    }

    /**
     * Returns the value of field navigation_open_type
     *
     * @return integer
     */
    public function getNavigationOpenType()
    {
        return $this->navigation_open_type;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cms_navigation';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsNavigation[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsNavigation
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
