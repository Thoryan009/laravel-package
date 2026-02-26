<?php

namespace App\Modules\Reports\Application\Reports;

use App\Modules\Reports\Application\Contracts\ApplicationReportContract;
use App\Modules\Reports\Application\Repositories\ApplicationReportRepository;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\Modules\Reports\Application\Resources\ApplicationReportResource;

class ApplicationReport implements ApplicationReportContract
{
    public function __construct(
        protected ApplicationReportRepository $repository
    ) {}

    public function generate(array $filters): AnonymousResourceCollection
    {
        $query = $this->repository->baseQuery($filters);
        // $query = $this->repository->filterByApplication($query, 'application');

        return ApplicationReportResource::collection(
            $query->get()
        );
    }
}

