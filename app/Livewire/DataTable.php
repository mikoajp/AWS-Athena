<?php

namespace App\Livewire;

use Aws\Athena\AthenaClient;
use Livewire\Component;

class DataTable extends Component
{
    public $query = '';
    public array $results = [];

    public function executeQuery(): void
    {
        $client = new AthenaClient(config('aws'));

        try {
            $result = $client->startQueryExecution([
                'QueryString' => $this->query,
                'QueryExecutionContext' => [
                    'Database' => 'your_database_name',
                ],
                'ResultConfiguration' => [
                    'OutputLocation' => 's3://your-query-results-bucket/',
                ],
            ]);

            $queryExecutionId = $result['QueryExecutionId'];
            sleep(3);

            $results = $client->getQueryResults([
                'QueryExecutionId' => $queryExecutionId,
            ]);

            $this->results = $results['ResultSet']['Rows'];

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.data-table', [
            'results' => $this->results,
        ]);
    }
}
