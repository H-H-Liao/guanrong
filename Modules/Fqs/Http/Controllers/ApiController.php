<?php

namespace TypiCMS\Modules\Fqs\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Fqs\Models\Fq;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Fq::class)
            ->selectFields($request->input('fields.fqs'))
            ->allowedSorts(['status_translated', 'title_translated','position'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Fq $fq, Request $request)
    {
        foreach ($request->only('status','position') as $key => $content) {
            if ($fq->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $fq->setTranslation($key, $lang, $value);
                }
            } else {
                $fq->{$key} = $content;
            }
        }

        $fq->save();
    }

    public function destroy(Fq $fq)
    {
        $fq->delete();
    }
}
