<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Http\Controllers\Controller;
use DB;

use PDO;
use App\Traits\SunatTraits;

class Operacion extends Command
{
    use SunatTraits;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'operacion:total';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consulta el tipo de cambio de la Pagina de la Sunat del Peru https://www.sunat.gob.pe/a/txt/tipoCambio.txt';

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
        $this->sut_traer_data_sunat();
        $this->sunatarchivos();
    }
}
