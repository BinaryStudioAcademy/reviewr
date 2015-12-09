<?php

namespace App\Services\RemoteDataGrabber;

use App\Services\RemoteDataGrabber\Contracts\DataGrabberInterface;
use App\Services\RemoteDataGrabber\Exceptions\RemoteServerException;
use App\Services\RemoteDataGrabber\Exceptions\JsonDecodingException;
use RuntimeException;

class CurlDataGrabber implements DataGrabberInterface
{
    /**
     * @param string $link
     * @param array $options
     * @return string
     */
    public function getRaw($link, $options = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,            $link);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR,    1);
        curl_setopt($ch, CURLOPT_TIMEOUT,        30);

        foreach ($options as $option => $value) {
            curl_setopt($ch, $option,  $value);
        }

        $response = curl_exec($ch);
        $errno = curl_errno($ch);

        if ($errno) {
            $errorMessage = curl_strerror($errno);
            $exeptionMessage = "cURL error ({$errno}):\n {$errorMessage}";
            throw new RemoteServerException($exeptionMessage);
        } elseif (curl_error($ch) !== '') {
            throw new RemoteServerException('Cannot get an information');
        }

        return $response;
    }

    /**
     * @param string $link
     * @param array $options
     * @return object
     */
    public function getFromJson($link, $options = [])
    {
        $resultBody = $this->getRaw($link, $options);
        $result = @json_decode($resultBody);

        if ($result === null && json_last_error() !== JSON_ERROR_NONE) {
            throw new JsonDecodingException('Cannot get an information');
        };

        return $result;
    }

    /**
     * @param string $link
     * @param array $options
     * @return string
     */
    public function getHtmlHead($link, $options = [])
    {
        $resultBody = $this->getRaw($link);
        $result = substr(
            $resultBody,
            0,
            strpos($resultBody, '</head>') + 7
        );

        return $result;
    }
}