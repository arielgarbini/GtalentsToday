<?php

namespace Vanguard\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Vanguard\Vacancy;

class VacancyPendingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vacancy:verified';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = Carbon::now()->subDay(3);
        $vacancies = Vacancy::where(function($q){
            $q->where('vacancy_status_id', 1);
            $q->orWhere('vacancy_status_id', 5);
        })->where('file_employer', '')->where('created_at', '<', $date)->update(['vacancy_status_id' => 2]);
        echo "Vacantes actualizadas satisfactoriamente";
    }
}
