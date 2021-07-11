<?php

namespace App\Contracts;

use App\Models\Url;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

interface ShortenUrlInterface
{

    /**
     * @param int $perPage
     * @param bool $isSimple
     * @return LengthAwarePaginator|Paginator
     */
    public function paginate(int $perPage = 10, bool $isSimple = true);

    /**
     * @param array $data
     * @return  Url|Model
     */
    public function create(array $data);

    /**
     * @param string $url
     * @return  Url|Model
     */
    public function findByUrl(string $url);

    /**
     * @param string $shortUrl
     * @return mixed
     */
    public function delete(string $shortUrl);
}
