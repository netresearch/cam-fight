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
    public $nId;

    public $strTitle;

    public $strDescription;

    public $strBgColor;

    protected $connection;

    protected $strTableName = 'Challenges';

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function setId($nId)
    {
        $this->nId = $nId;
    }

    public function show()
    {
        $strQuery = "SELECT * FROM " . $this->strTableName . " WHERE id = ?";

        // prepare query statement
        $stmt = $this->connection->prepare($strQuery);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->nId);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->strTitle = $row['title'];
        $this->strDescription = $row['description'];
        $this->strBgColor = $row['bgColor'];
    }
}