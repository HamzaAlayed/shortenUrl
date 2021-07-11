<?php


namespace App\Repositories;


use App\Contracts\ShortenUrlInterface;
use App\Models\Url;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
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

    public function findByUrl($url){
        return $this->url->whereUrl($url)->first();
    }

    /**
     * @param array $data
     * @return Url|Model
     */
    public function create(array $data)
    {
        $data['shorter'] = $this->shorter();
        return $this->url->create($data);
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
}
