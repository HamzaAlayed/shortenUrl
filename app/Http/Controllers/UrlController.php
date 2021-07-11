<?php

namespace App\Http\Controllers;

use App\Contracts\ShortenUrlInterface;
use App\Http\Requests\UrlRequest;
use App\Http\Resources\UrlResource;
use Illuminate\Http\JsonResponse;

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
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(UrlResource::collection($this->shortenUrl->paginate()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UrlRequest $request
     * @return JsonResponse
     */
    public function store(UrlRequest $request): JsonResponse
    {
        $shorten = $this->shortenUrl->findByUrl($request->url);
        $code = 200;
        if (!$shorten) {
            $code = 201;
            $shorten = $this->shortenUrl->create($request->all());
        }

        return response()->json(new UrlResource($shorten), $code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UrlRequest $request
     * @return JsonResponse
     */
    public function destroy(UrlRequest $request): JsonResponse
    {
        $isDeleted = $this->shortenUrl->delete($request->url);
        if ($isDeleted === null) {
            return response()->json(['message' => 'URL not found'], 404);
        }

        $message = $isDeleted ? 'URL deleted' : 'URL not deleted, please try again later!';
        return response()->json(['message' => $message]);
    }
}
