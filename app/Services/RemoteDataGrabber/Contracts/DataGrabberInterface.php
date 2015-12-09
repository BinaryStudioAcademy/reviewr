<?php

namespace App\Services\RemoteDataGrabber\Contracts;

interface DataGrabberInterface
{
    /**
     * @param $link string
     * @param array $options
     * @return string
     */
    public function getRaw($link, $options = []);

    /**
     * @param $link string
     * @param array $options
     * @return object
     */
    public function getFromJson($link, $options = []);

    /**
     * @param $link string
     * @param array $options
     * @return string
     */
    public function getHtmlHead($link, $options = []);
}