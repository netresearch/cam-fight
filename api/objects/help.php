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
    protected $arYml;

    public function __construct()
    {
        $strYmlPath = '../config/help.yml';
        $strYml = file_get_contents($strYmlPath);
        $this->arYml = yaml_parse($strYml);
    }

    public function show()
    {
        return $this->arYml;
    }
}