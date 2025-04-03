<?php

namespace App\Jobs;

use App\Models\Property;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class DemoJob implements ShouldQueue
{
    use Queueable;

    public $deleteWhenMissingModels = true;
    private $property;

    /**
     * Create a new job instance.
     */
    public function __construct(Property $property)
    {
        $this->property = $property->withoutRelations();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        echo $this->property->title;
    }
}
