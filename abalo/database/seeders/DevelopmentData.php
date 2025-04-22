<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DevelopmentData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->importCSV('app/data/articles.csv', 'ab_article', ['id','ab_name','ab_price','ab_description','ab_creator_id','ab_createdate']);
        $this->importCSV('app/data/articlecategory.csv', 'ab_articlecategory', ['id','ab_name','ab_description','ab_parent']);

    }
    private function convertData($table, $row){
        // Datum konvertieren: "19.12.20 13:00" → "2020-12-19 13:00:00"
        if($table == 'ab_article'){
            // entfernt (.) in integer vor convert
            $row[2] = (int) str_replace('.', '', $row[2]);

            $row[5] = Carbon::createFromFormat('d.m.y H:i', $row[5])->format('Y-m-d H:i:s');
        }
        if($table == 'ab_articlecategory'){
            $row[3] = empty($row[3])? null : (int)$row[3];
        }
        return $row;
    }
    private function importCSV($filePath,$table, $columns){
        // Prüfen, ob Datei existiert
        if(!file_exists($filePath)){
            $this->command->error("File not found: $filePath");
        }

        // Datei öffnen
        $file = fopen($filePath, "r");
        if(!$file){
            $this->command->error("Cannot open file: $filePath");
        }

        //Erste Zeile (Header) überspringen
        fgetcsv($file);

        // CSV-Daten einlesen und in die Datenbank einfügen
        $data = [];
        while(($row = fgetcsv($file, 1000, ";")) !== false){
            $convertedRow = $this -> convertData($table, $row);
            $data[] = array_combine($columns, $convertedRow);
        }
        fclose($file);
        DB::table($table)->insert($data);
    }
}
