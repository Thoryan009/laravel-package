<?php
namespace App\Modules\Reports\Controller;

use App\Http\Controllers\Controller;
use App\Modules\Reports\Services\ClientDbService;
use App\Modules\Reports\Services\CountryDbService;
use App\Modules\Reports\Services\JobListDbService;
use App\Modules\Reports\Services\WorkOrderDbService;
use App\Modules\Reports\Services\ProcessDbService;
use App\Modules\Reports\Services\TransactionDbService;

class ReportController extends Controller
{
    public function __construct(
      private readonly  JobListDbService $jobListDbService,
      private readonly  WorkOrderDbService $workOrderDbService,
      private readonly  ProcessDbService $processDbService,
      private readonly  TransactionDbService $transactionDbService,
      private readonly ClientDbService $clientDbService,
      private readonly CountryDbService $countryDbService
    )
    {
    }
    public function getCountryReport()
    {
        return $this->countryDbService->getCountries();
    }
    public function getClientReport()
    {
        return $this->clientDbService->getClients();
    }

    public function getProcessReport()
    {
        return $this->processDbService->getProcesses();
    }

    public function getWorkOrderReport()
    {
        return $this->workOrderDbService->getWorkOrders();
    }

    public function getJobReport()
    {
        return $this->jobListDbService->getJobs();
    }

    public function getTransactionPaymentMethodReport()
    {
        return $this->transactionDbService->getPaymentMethods();
    }

     public function getTransactionStatusReport()
    {
        return $this->transactionDbService->getStatuses();
    }
}
