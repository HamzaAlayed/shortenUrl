<?php

namespace App\Http\Controllers;

use App\Contracts\ShortenUrlInterface;
use App\Http\Requests\UrlRequest;
use Illuminate\Http\Response;

class UrlController extends Controller
{
    /**
     * @var ShortenUrlInterface
     */
    private $shortenUrl;

    /**
     * UrlController constructor.
     * @param ShortenUrlInterface $shortenUrl
     */
    public function __construct(ShortenUrlInterface $shortenUrl)
    {
        $this->shortenUrl = $shortenUrl;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UrlRequest $request
     * @return Response
     */
    public function store(UrlRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UrlRequest $request
     * @param int $id
     * @return Response
     */
    public function update(UrlRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
