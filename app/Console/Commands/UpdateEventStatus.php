<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Program;

class UpdateEventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updated event status from Active to Deactive daily';

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
     * @return int
     */
    public function handle()
    {
        $date = Carbon::today();
        $end = Program::where('date_end','<',$date)->get();
        foreach($end as $change){
            $change->status = 'Deactive';
            $change->updated_at = date("Y-m-d H:i:s");
            $change->save();
        }

        $this->info('Successfully update status.');
    }
}
