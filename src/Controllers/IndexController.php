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

        return redirect($shorter->url);
    }
}
