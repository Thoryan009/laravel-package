<?php

namespace App\Modules\Reports\ATS\Reports;
use App\Modules\Reports\ATS\Contracts\ATSReportContract;
use App\Modules\Reports\ATS\Repositories\ATSReportRepository;
use App\Modules\Reports\ATS\Resource\ATSResource;
use Illuminate\Database\Eloquent\Builder;

class ActiveProcessReport implements ATSReportContract
{
      public function __construct(protected ATSReportRepository $repository) {

     }

    public function generate(array $filters)
{
    $query = $this->repository->baseQuery($filters);
    $query = $this->repository->filterByDuration($query, 0, 50);

    return ATSResource::collection(
        $query->get() 
    );
}
}
