<?php

namespace Ypk\Models;

class StoreDecorationBlock extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $block_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $decoration_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $block_layout;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $block_content;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $block_module_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=true)
     */
    protected $block_full_width;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $block_sort;

    /**
     * Method to set the value of field block_id
     *
     * @param integer $block_id
     * @return $this
     */
    public function setBlockId($block_id)
    {
        $this->block_id = $block_id;

        return $this;
    }

    /**
     * Method to set the value of field decoration_id
     *
     * @param integer $decoration_id
     * @return $this
     */
    public function setDecorationId($decoration_id)
    {
        $this->decoration_id = $decoration_id;

        return $this;
    }

    /**
     * Method to set the value of field store_id
     *
     * @param integer $store_id
     * @return $this
     */
    public function setStoreId($store_id)
    {
        $this->store_id = $store_id;

        return $this;
    }

    /**
     * Method to set the value of field block_layout
     *
     * @param string $block_layout
     * @return $this
     */
    public function setBlockLayout($block_layout)
    {
        $this->block_layout = $block_layout;

        return $this;
    }

    /**
     * Method to set the value of field block_content
     *
     * @param string $block_content
     * @return $this
     */
    public function setBlockContent($block_content)
    {
        $this->block_content = $block_content;

        return $this;
    }

    /**
     * Method to set the value of field block_module_type
     *
     * @param string $block_module_type
     * @return $this
     */
    public function setBlockModuleType($block_module_type)
    {
        $this->block_module_type = $block_module_type;

        return $this;
    }

    /**
     * Method to set the value of field block_full_width
     *
     * @param integer $block_full_width
     * @return $this
     */
    public function setBlockFullWidth($block_full_width)
    {
        $this->block_full_width = $block_full_width;

        return $this;
    }

    /**
     * Method to set the value of field block_sort
     *
     * @param integer $block_sort
     * @return $this
     */
    public function setBlockSort($block_sort)
    {
        $this->block_sort = $block_sort;

        return $this;
    }

    /**
     * Returns the value of field block_id
     *
     * @return integer
     */
    public function getBlockId()
    {
        return $this->block_id;
    }

    /**
     * Returns the value of field decoration_id
     *
     * @return integer
     */
    public function getDecorationId()
    {
        return $this->decoration_id;
    }

    /**
     * Returns the value of field store_id
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * Returns the value of field block_layout
     *
     * @return string
     */
    public function getBlockLayout()
    {
        return $this->block_layout;
    }

    /**
     * Returns the value of field block_content
     *
     * @return string
     */
    public function getBlockContent()
    {
        return $this->block_content;
    }

    /**
     * Returns the value of field block_module_type
     *
     * @return string
     */
    public function getBlockModuleType()
    {
        return $this->block_module_type;
    }

    /**
     * Returns the value of field block_full_width
     *
     * @return integer
     */
    public function getBlockFullWidth()
    {
        return $this->block_full_width;
    }

    /**
     * Returns the value of field block_sort
     *
     * @return integer
     */
    public function getBlockSort()
    {
        return $this->block_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_decoration_block';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreDecorationBlock[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreDecorationBlock
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
