<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 01.12.17
 * Time: 14:15
 */

class Competition
{
    /**
     *
     * @var integer
     */
    public $nId;

    public $nStartChallenges;

    public $nStopChallenges;

    public $nStartVotes;

    public $nStopVotes;

    protected $connection;

    protected $strTableName = 'Competition';

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
        $this->nStartChallenges = $row['startChallenges'];
        $this->nStopChallenges = $row['stopChallenges'];
        $this->nStartVotes = $row['startVotes'];
        $this->nStopVotes = $row['stopVotes'];
    }
}