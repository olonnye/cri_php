<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Kit seed.
 */
class KitSeed extends AbstractSeed
{
    public function run(): void
    {
        $table = $this->table('kit');

        $data = [];
        $csvFile = fopen(WWW_ROOT . "data/kit.csv", "r");

        while (($row = fgetcsv($csvFile)) !== FALSE) {
            $kit_id = $row[1] ?? null;

            if (!$kit_id || $kit_id === "kit_id") continue;

            $data[] = [
                "kit_id" => $kit_id,
            ];
        }

        fclose($csvFile);

        $table->insert($data)->save();
    }
}
