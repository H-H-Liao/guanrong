<?php

namespace TypiCMS\Modules\Portfolios\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Portfolios\Models\Portfolio;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Portfolio::class)
            ->selectFields($request->input('fields.portfolios'))
            ->allowedSorts(['status_translated', 'title_translated','position'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Portfolio $portfolio, Request $request)
    {
        foreach ($request->only('status','position') as $key => $content) {
            if ($portfolio->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $portfolio->setTranslation($key, $lang, $value);
                }
            } else {
                $portfolio->{$key} = $content;
            }
        }

        $portfolio->save();
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
    }
}
