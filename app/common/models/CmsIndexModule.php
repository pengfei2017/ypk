<?php

namespace Ypk\Models;

class CmsIndexModule extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $module_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $module_title;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $module_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $module_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $module_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $module_state;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $module_content;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $module_style;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $module_view;

    /**
     * Method to set the value of field module_id
     *
     * @param integer $module_id
     * @return $this
     */
    public function setModuleId($module_id)
    {
        $this->module_id = $module_id;

        return $this;
    }

    /**
     * Method to set the value of field module_title
     *
     * @param string $module_title
     * @return $this
     */
    public function setModuleTitle($module_title)
    {
        $this->module_title = $module_title;

        return $this;
    }

    /**
     * Method to set the value of field module_name
     *
     * @param string $module_name
     * @return $this
     */
    public function setModuleName($module_name)
    {
        $this->module_name = $module_name;

        return $this;
    }

    /**
     * Method to set the value of field module_type
     *
     * @param string $module_type
     * @return $this
     */
    public function setModuleType($module_type)
    {
        $this->module_type = $module_type;

        return $this;
    }

    /**
     * Method to set the value of field module_sort
     *
     * @param integer $module_sort
     * @return $this
     */
    public function setModuleSort($module_sort)
    {
        $this->module_sort = $module_sort;

        return $this;
    }

    /**
     * Method to set the value of field module_state
     *
     * @param integer $module_state
     * @return $this
     */
    public function setModuleState($module_state)
    {
        $this->module_state = $module_state;

        return $this;
    }

    /**
     * Method to set the value of field module_content
     *
     * @param string $module_content
     * @return $this
     */
    public function setModuleContent($module_content)
    {
        $this->module_content = $module_content;

        return $this;
    }

    /**
     * Method to set the value of field module_style
     *
     * @param string $module_style
     * @return $this
     */
    public function setModuleStyle($module_style)
    {
        $this->module_style = $module_style;

        return $this;
    }

    /**
     * Method to set the value of field module_view
     *
     * @param integer $module_view
     * @return $this
     */
    public function setModuleView($module_view)
    {
        $this->module_view = $module_view;

        return $this;
    }

    /**
     * Returns the value of field module_id
     *
     * @return integer
     */
    public function getModuleId()
    {
        return $this->module_id;
    }

    /**
     * Returns the value of field module_title
     *
     * @return string
     */
    public function getModuleTitle()
    {
        return $this->module_title;
    }

    /**
     * Returns the value of field module_name
     *
     * @return string
     */
    public function getModuleName()
    {
        return $this->module_name;
    }

    /**
     * Returns the value of field module_type
     *
     * @return string
     */
    public function getModuleType()
    {
        return $this->module_type;
    }

    /**
     * Returns the value of field module_sort
     *
     * @return integer
     */
    public function getModuleSort()
    {
        return $this->module_sort;
    }

    /**
     * Returns the value of field module_state
     *
     * @return integer
     */
    public function getModuleState()
    {
        return $this->module_state;
    }

    /**
     * Returns the value of field module_content
     *
     * @return string
     */
    public function getModuleContent()
    {
        return $this->module_content;
    }

    /**
     * Returns the value of field module_style
     *
     * @return string
     */
    public function getModuleStyle()
    {
        return $this->module_style;
    }

    /**
     * Returns the value of field module_view
     *
     * @return integer
     */
    public function getModuleView()
    {
        return $this->module_view;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cms_index_module';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsIndexModule[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsIndexModule
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
