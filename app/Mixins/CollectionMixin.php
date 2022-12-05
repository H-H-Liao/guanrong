<?php
namespace App\Mixins;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class CollectionMixin
{
    public function paginate()
    {
        return function ($perPage = 15, $page = null, $options = []) {
            $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

            return (
                new LengthAwarePaginator(
                    $this->forPage($page, $perPage)->values(),
                    $this->count(),
                    $perPage,
                    $page,
                    $options
                )
            )->withPath('');
        };
    }
}
