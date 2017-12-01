<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 01.12.17
 * Time: 14:15
 */

class Challenge
{
    /**
     *
     * @var integer
     */
    protected $nId;

    protected $strTitle;

    protected $strDescription;

    protected $strBgColor;

    protected $connection;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function show()
    {
        return $this->arYml;
    }
}