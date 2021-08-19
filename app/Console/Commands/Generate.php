<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use App\Models\Nofaro;
use PhpParser\NodeAbstract;

class Generate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nofaro:test {value} {--requests=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate and save hashes';

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

        $this->info('Looking for hashes...');

        $value = $this->argument('value');

        for($i = 0; $i < $this->option('requests'); $i++){

            $batch = date('Y-m-d h:i:s');
            $request = Request::create("/generate-hash/$value", 'GET');
            $response = app()->handle($request);
           
            if($response->status() == 429){
                $this->error('Too Many Attempts!');
                break;
            }
            else{
                $data = json_decode($response->getContent(), true);
                $this->line("Found " . $data['hash'] ."!!");
    
                $table = new Nofaro();
                $table->attempts = $data['attempts'];
                $table->input = $value;
                $table->hash = $data['hash'];
                $table->key = $data['key'];
                $table->batch = $batch;
                $table->save();
    
                $value = $data['hash'];
            }
                 

        }

        $this->info('The command was finished!');
    }
 
}
