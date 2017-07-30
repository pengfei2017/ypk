<?php

namespace Ypk\Models;

class CmsModuleFrame extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $frame_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $frame_title;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $frame_name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $frame_explain;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $frame_structure;

    /**
     * Method to set the value of field frame_id
     *
     * @param integer $frame_id
     * @return $this
     */
    public function setFrameId($frame_id)
    {
        $this->frame_id = $frame_id;

        return $this;
    }

    /**
     * Method to set the value of field frame_title
     *
     * @param string $frame_title
     * @return $this
     */
    public function setFrameTitle($frame_title)
    {
        $this->frame_title = $frame_title;

        return $this;
    }

    /**
     * Method to set the value of field frame_name
     *
     * @param string $frame_name
     * @return $this
     */
    public function setFrameName($frame_name)
    {
        $this->frame_name = $frame_name;

        return $this;
    }

    /**
     * Method to set the value of field frame_explain
     *
     * @param string $frame_explain
     * @return $this
     */
    public function setFrameExplain($frame_explain)
    {
        $this->frame_explain = $frame_explain;

        return $this;
    }

    /**
     * Method to set the value of field frame_structure
     *
     * @param string $frame_structure
     * @return $this
     */
    public function setFrameStructure($frame_structure)
    {
        $this->frame_structure = $frame_structure;

        return $this;
    }

    /**
     * Returns the value of field frame_id
     *
     * @return integer
     */
    public function getFrameId()
    {
        return $this->frame_id;
    }

    /**
     * Returns the value of field frame_title
     *
     * @return string
     */
    public function getFrameTitle()
    {
        return $this->frame_title;
    }

    /**
     * Returns the value of field frame_name
     *
     * @return string
     */
    public function getFrameName()
    {
        return $this->frame_name;
    }

    /**
     * Returns the value of field frame_explain
     *
     * @return string
     */
    public function getFrameExplain()
    {
        return $this->frame_explain;
    }

    /**
     * Returns the value of field frame_structure
     *
     * @return string
     */
    public function getFrameStructure()
    {
        return $this->frame_structure;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cms_module_frame';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsModuleFrame[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsModuleFrame
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
