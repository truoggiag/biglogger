<?php


class MRS_CURL
{
    public $urlPost = '';
    public $urlGet = '';
    public $useragent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.86 Safari/537.36';
//  public $cookiePath;
    public $debug = 0;

    function ExecPOST($paramPost = array()) {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->urlPost);
        curl_setopt($ch, CURLOPT_USERAGENT, $this->useragent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
//    curl_setopt($ch, CURLOPT_COOKIEFILE, $this->getCookiePath());
//    curl_setopt($ch, CURLOPT_COOKIEJAR, $this->getCookiePath());

        curl_setopt($ch, CURLOPT_POST, 1);

        $postfields = array();
        $postfields = array_merge($postfields, $paramPost);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);


        $data = curl_exec($ch);
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';die();

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        echo $httpcode;die();
        curl_close($ch);
//        if ($httpcode >= 200 && $httpcode < 300)
        return $data;
//        else
//            return null;
    }


}