<?php

if ( ! function_exists('getRequest'))
{
    /**
     * Send HTTP Get Request.
     *
     * @param $url
     * @param bool|true $convertEncoding
     * @return string
     */
    function getRequest($url, $convertEncoding = true)
    {
        $request = new \GuzzleHttp\Client();

        $response = $request->get($url, ['cookies' => session('COOKIE'), 'verify' => storage_path('app/cert.pem')]);

        if ( ! $convertEncoding)
        {
            return $response->getBody()->getContents();
        }

        return mb_convert_encoding($response->getBody()->getContents(), 'UTF-8', 'BIG5');
    }
}

if ( ! function_exists('clearSession'))
{
    /**
     *  Clear user data in session.
     */
    function clearSession()
    {
        \Cache::forget(session()->pull('PHPSESSID'));

        session()->forget('COOKIE');

        session()->forget('courseLists');

        session()->forget('courseListsContent');
    }
}