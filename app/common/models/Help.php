<?php

namespace Ypk\Models;

class Help extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $help_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $help_sort;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $help_title;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $help_info;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $help_url;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $update_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $page_show;

    /**
     * Method to set the value of field help_id
     *
     * @param integer $help_id
     * @return $this
     */
    public function setHelpId($help_id)
    {
        $this->help_id = $help_id;

        return $this;
    }

    /**
     * Method to set the value of field help_sort
     *
     * @param integer $help_sort
     * @return $this
     */
    public function setHelpSort($help_sort)
    {
        $this->help_sort = $help_sort;

        return $this;
    }

    /**
     * Method to set the value of field help_title
     *
     * @param string $help_title
     * @return $this
     */
    public function setHelpTitle($help_title)
    {
        $this->help_title = $help_title;

        return $this;
    }

    /**
     * Method to set the value of field help_info
     *
     * @param string $help_info
     * @return $this
     */
    public function setHelpInfo($help_info)
    {
        $this->help_info = $help_info;

        return $this;
    }

    /**
     * Method to set the value of field help_url
     *
     * @param string $help_url
     * @return $this
     */
    public function setHelpUrl($help_url)
    {
        $this->help_url = $help_url;

        return $this;
    }

    /**
     * Method to set the value of field update_time
     *
     * @param integer $update_time
     * @return $this
     */
    public function setUpdateTime($update_time)
    {
        $this->update_time = $update_time;

        return $this;
    }

    /**
     * Method to set the value of field type_id
     *
     * @param integer $type_id
     * @return $this
     */
    public function setTypeId($type_id)
    {
        $this->type_id = $type_id;

        return $this;
    }

    /**
     * Method to set the value of field page_show
     *
     * @param integer $page_show
     * @return $this
     */
    public function setPageShow($page_show)
    {
        $this->page_show = $page_show;

        return $this;
    }

    /**
     * Returns the value of field help_id
     *
     * @return integer
     */
    public function getHelpId()
    {
        return $this->help_id;
    }

    /**
     * Returns the value of field help_sort
     *
     * @return integer
     */
    public function getHelpSort()
    {
        return $this->help_sort;
    }

    /**
     * Returns the value of field help_title
     *
     * @return string
     */
    public function getHelpTitle()
    {
        return $this->help_title;
    }

    /**
     * Returns the value of field help_info
     *
     * @return string
     */
    public function getHelpInfo()
    {
        return $this->help_info;
    }

    /**
     * Returns the value of field help_url
     *
     * @return string
     */
    public function getHelpUrl()
    {
        return $this->help_url;
    }

    /**
     * Returns the value of field update_time
     *
     * @return integer
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * Returns the value of field type_id
     *
     * @return integer
     */
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Returns the value of field page_show
     *
     * @return integer
     */
    public function getPageShow()
    {
        return $this->page_show;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'help';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Help[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Help
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
