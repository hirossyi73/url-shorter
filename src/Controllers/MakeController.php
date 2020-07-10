<?php

namespace Hirossyi73\UrlShorter\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Hirossyi73\UrlShorter\Model\Shorter;


class MakeController extends BaseController
{
    /**
     * Make page index
     *
     */
    public function index(Request $request)
    {
        return view('url_shorter::make.index', [
            'action' => \UrlShorter::shorter_make_url()
        ]);
    }

    /**
     * create key
     *
     */
    public function make(Request $request)
    {
        Shorter::validateUrl($request->all())->validate();

        $url = $request->get('url');
        $shorter = Shorter::create([
            'url' => $url
        ]);

        return response()->json([
            'generate_url' => $shorter->generate_url,
        ]);
    }
}
