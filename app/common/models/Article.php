<?php

namespace Ypk\Models;

class Article extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $article_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $ac_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $article_url;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $article_show;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $article_position;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $article_sort;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $article_title;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $article_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $article_time;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $imgsrc;

    /**
     * @return string
     */
    public function getImgsrc()
    {
        return $this->imgsrc;
    }

    /**
     * @param string $imgsrc
     */
    public function setImgsrc(string $imgsrc)
    {
        $this->imgsrc = $imgsrc;
    }

    /**
     * Method to set the value of field article_id
     *
     * @param integer $article_id
     * @return $this
     */
    public function setArticleId($article_id)
    {
        $this->article_id = $article_id;

        return $this;
    }

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
     * Method to set the value of field article_url
     *
     * @param string $article_url
     * @return $this
     */
    public function setArticleUrl($article_url)
    {
        $this->article_url = $article_url;

        return $this;
    }

    /**
     * Method to set the value of field article_show
     *
     * @param integer $article_show
     * @return $this
     */
    public function setArticleShow($article_show)
    {
        $this->article_show = $article_show;

        return $this;
    }

    /**
     * Method to set the value of field article_position
     *
     * @param integer $article_position
     * @return $this
     */
    public function setArticlePosition($article_position)
    {
        $this->article_position = $article_position;

        return $this;
    }

    /**
     * Method to set the value of field article_sort
     *
     * @param integer $article_sort
     * @return $this
     */
    public function setArticleSort($article_sort)
    {
        $this->article_sort = $article_sort;

        return $this;
    }

    /**
     * Method to set the value of field article_title
     *
     * @param string $article_title
     * @return $this
     */
    public function setArticleTitle($article_title)
    {
        $this->article_title = $article_title;

        return $this;
    }

    /**
     * Method to set the value of field article_content
     *
     * @param string $article_content
     * @return $this
     */
    public function setArticleContent($article_content)
    {
        $this->article_content = $article_content;

        return $this;
    }

    /**
     * Method to set the value of field article_time
     *
     * @param integer $article_time
     * @return $this
     */
    public function setArticleTime($article_time)
    {
        $this->article_time = $article_time;

        return $this;
    }

    /**
     * Returns the value of field article_id
     *
     * @return integer
     */
    public function getArticleId()
    {
        return $this->article_id;
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
     * Returns the value of field article_url
     *
     * @return string
     */
    public function getArticleUrl()
    {
        return $this->article_url;
    }

    /**
     * Returns the value of field article_show
     *
     * @return integer
     */
    public function getArticleShow()
    {
        return $this->article_show;
    }

    /**
     * Returns the value of field article_position
     *
     * @return integer
     */
    public function getArticlePosition()
    {
        return $this->article_position;
    }

    /**
     * Returns the value of field article_sort
     *
     * @return integer
     */
    public function getArticleSort()
    {
        return $this->article_sort;
    }

    /**
     * Returns the value of field article_title
     *
     * @return string
     */
    public function getArticleTitle()
    {
        return $this->article_title;
    }

    /**
     * Returns the value of field article_content
     *
     * @return string
     */
    public function getArticleContent()
    {
        return $this->article_content;
    }

    /**
     * Returns the value of field article_time
     *
     * @return integer
     */
    public function getArticleTime()
    {
        return $this->article_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'article';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Article[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Article
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
