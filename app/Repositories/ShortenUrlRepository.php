<?php

namespace App\Repositories;

use App\Contracts\ShortenUrlInterface;
use App\Models\Url;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ShortenUrlRepository implements ShortenUrlInterface
{
    /**
     * @var Url
     */
    private $url;

    /**
     * ShortenUrlRepository constructor.
     * @param Url $url
     */
    public function __construct(Url $url)
    {
        $this->url = $url;
    }

    /**
     * @param int $perPage
     * @param bool $isSimple
     * @return LengthAwarePaginator|Paginator
     */
    public function paginate(int $perPage = 10, bool $isSimple = true)
    {
        return $isSimple ? $this->url->simplePaginate($perPage) : $this->url->paginate($perPage);
    }

    /**
     * @param string $url
     * @return Url|Builder|Model|object|null
     */
    public function findByUrl($url)
    {
        return $this->url->whereUrl($url)->first();
    }

    /**
     * @param string $code
     * @return Url|Builder|Model|object|null
     */
    public function findByShortCode($code)
    {
        return $this->url->whereShorter($code)->first();
    }

    /**
     * @param array $data
     * @return Url|Model
     */
    public function create(array $data)
    {
        $data['shorter'] = $this->shorter();
        $data['user_id'] = auth()->guard('api')->id();
        return $this->url->create($data);
    }

    /**
     *
     * @return false|string
     */
    private function shorter()
    {
        $hash = substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 6);
        $check = $this->url->whereShorter($hash)->exists();
        if ($check) {
            $this->shorter();
        }
        return $hash;
    }

    /**
     * @param string $shortUrl
     * @return bool|null
     */
    public function delete(string $shortUrl): ?bool
    {
        $shortCode = parse_url($shortUrl);
        $code = str_replace('/', '', $shortCode['path'] ?? '');

        $url = $this->url->whereShorter($code)->first();
        if ($url) {
            return $url->delete();
        }

        return null;
    }
}
