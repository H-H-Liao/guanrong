<?php

namespace TypiCMS\Modules\Services\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use TypiCMS\Modules\Core\Filters\FilterOr;
use TypiCMS\Modules\Core\Http\Controllers\BaseApiController;
use TypiCMS\Modules\Services\Models\Service;

class ApiController extends BaseApiController
{
    public function index(Request $request): LengthAwarePaginator
    {
        $data = QueryBuilder::for(Service::class)
            ->selectFields($request->input('fields.services'))
            ->allowedSorts(['status_translated', 'title_translated','position'])
            ->allowedFilters([
                AllowedFilter::custom('title', new FilterOr()),
            ])
            ->allowedIncludes(['image'])
            ->paginate($request->input('per_page'));

        return $data;
    }

    protected function updatePartial(Service $service, Request $request)
    {
        foreach ($request->only('status','position') as $key => $content) {
            if ($service->isTranslatableAttribute($key)) {
                foreach ($content as $lang => $value) {
                    $service->setTranslation($key, $lang, $value);
                }
            } else {
                $service->{$key} = $content;
            }
        }

        $service->save();
    }

    public function destroy(Service $service)
    {
        $service->delete();
    }
}
