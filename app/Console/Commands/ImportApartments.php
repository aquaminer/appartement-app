<?php

namespace App\Console\Commands;

use App\Models\Apartment;
use Illuminate\Console\Command;
use League\Csv\Reader;
use function base_path;
use function iterator_to_array;
use function var_dump;

class ImportApartments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:apartments {file=resources/data.csv}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import apartments';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $filePath = base_path($this->argument('file'));

        $reader = Reader::createFromPath($filePath);
        $reader->setHeaderOffset(0);

        foreach ($reader->getIterator() as $row){
            Apartment::query()->create([
                'name' => $row['Name'],
                'price' => $row['Price'],
                'bedrooms' => $row['Bedrooms'],
                'bathrooms' => $row['Bathrooms'],
                'storeys' => $row['Storeys'],
                'garages' => $row['Garages'],
            ]);
        }
        return 0;
    }
}
