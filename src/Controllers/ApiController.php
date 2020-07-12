<?php

namespace Hirossyi73\UrlShorter\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Hirossyi73\UrlShorter\Model\Shorter;


class ApiController extends BaseController
{
    public function get(Request $request)
    {
        $generate_url = $request->get('generate_url');
        $shorter = Shorter::findByGenerateUrl($generate_url);
        if (empty($shorter)) {
            return response()->json(['error' => trans('url_shorter::url_shorter.errors.not_found')], 400);
        }

        return $shorter;
    }


    public function getWithKey(Request $request, $key)
    {
        $shorter = Shorter::find($key);
        if (empty($shorter)) {
            return response()->json(['error' => trans('url_shorter::url_shorter.errors.not_found')], 400);
        }

        return $shorter;
    }

    public function make(Request $request)
    {
        $validator = Shorter::validateUrl($request->all());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $url = $request->get('url');
        return Shorter::create([
            'url' => $url
        ]);
    }
}
