<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 04.12.17
 * Time: 09:02
 */
require('../../vendor/autoload.php');
class Image
{
    /**
     *
     * @var integer
     */
    public $nId;

    public $nTeam;

    public $strName;

    public $nVotes;

    public $strTmpPath;

    public $strPath;

    public $nChallenge;

    protected $connection;

    protected $strTableName = 'Images';

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
        $this->nTeam = $row['team'];
        $this->nVotes = $row['votes'];
        $this->strPath = $row['path'];
    }

    public function list($strExcludeTeam = null, $strTeam = null, $nChallengeId = null)
    {
        $strQuery = 'SELECT * FROM ' . $this->strTableName . ' WHERE 1';

        if (!empty($strExcludeTeam)) {
            $strQuery = $strQuery . ' AND team != "' . $strExcludeTeam . '"';
        }

        if (!empty($strTeam)) {
            $strQuery = $strQuery . ' AND team = "' . $strTeam . '" ';
        }

        if (!empty($nChallengeId)) {
            $strQuery = $strQuery . ' AND challenge = ' . $nChallengeId;
        }

        // prepare query statement
        $stmt = $this->connection->prepare($strQuery);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    public function add()
    {
        $s3 = Aws\S3\S3Client::factory(
            array(
                //aws access key
                'key'    => $_ENV['AWS_ACCES_KEY_ID'],
                //aws secret key
                'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
                'region' => 'eu-central-1',

            ));
        $bucket = $_ENV['S3_BUCKET']?: die('No "S3_BUCKET" config var found in env!');

        try {
            $upload = $s3->upload($bucket, $this->strName, fopen($this->strTmpPath, 'rb'), 'public-read');
        } catch (Exception $e) {
        }
        $this->strPath = $upload->get('ObjectURL');


        $strQuery = 'INSERT INTO ' .$this->strTableName
            . ' (team, challenge, path ) VALUES ("' . $this->nTeam . '", ' . $this->nChallenge . ', "' . $this->strPath .'")'
            . ' ON DUPLICATE KEY UPDATE path="' . $this->strPath . '"';


        $stmt = $this->connection->prepare($strQuery);


        $stmt->execute();
    }

    public function getUpvotes()
    {
        $strQuery = 'SELECT * FROM Votes WHERE image=' . $this->nId;

        error_log(serialize($strQuery));
        $stmt = $this->connection->prepare($strQuery);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function upvote($nUserId)
    {
        $strQuery = 'INSERT INTO Votes (challenge, user, image) '
            . 'VALUES (' . $this->nChallenge . ', ' . $nUserId . ', ' . $this->nId . ')'
            . ' ON DUPLICATE KEY UPDATE image=' . $this->nId;


        error_log(serialize($strQuery));
        $stmt = $this->connection->prepare($strQuery);


        $stmt->execute();
    }
}