<?php

namespace Hirossyi73\UrlShorter\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Hirossyi73\UrlShorter\Model\Shorter;


class IndexController extends BaseController
{
    /**
     * not key, return not found.
     *
     */
    public function notFound(Request $request)
    {
        return trans('url_shorter::url_shorter.errors.not_found');
    }

    /**
     * decode
     *
     */
    public function redirect(Request $request, $key)
    {
        $shorter = Shorter::find($key);
        if(empty($shorter)){
            return trans('url_shorter::url_shorter.errors.not_found');
        }

        if(boolval(config('url_shorter.use_preview', false))){
            return view('url_shorter::preview.preview', ['url' => $shorter->url, 'info' => $this->getPageInfo($shorter)]);
        }

        return redirect($shorter->url);
    }

    
    protected function getPageInfo($shorter){
        // 
        $fp = file_get_contents($shorter->url);
        if (!$fp) 
            return [];

        return [
            'title' => $this->getPageItem($fp, 'title'),
            'description' => $this->getPageItem($fp, 'description'),
        ];
    }

    protected function getPageItem($res, $key){
        $res = preg_match("/<$key>(.*)<\/$key>/siU", $res, $matches);
        if (!$res) 
            return null; 

        // Clean up title: remove EOL's and excessive whitespace.
        $item = preg_replace('/\s+/', ' ', $matches[1]);
        $item = trim($item);
        return $item;
    }
}
