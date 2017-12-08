<?php
/**
 * Created by PhpStorm.
 * User: tsc
 * Date: 30.11.17
 * Time: 16:32
 */

class Help
{
    /**
     *
     * @var string
     */
    protected $strYml;

    public function __construct()
    {
        $strYmlPath = '../config/help.txt';
        $this->strYml = file_get_contents($strYmlPath);
    }

    public function show()
    {
        return $this->strYml;
    }
}