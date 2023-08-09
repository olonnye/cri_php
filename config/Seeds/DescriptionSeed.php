<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Description seed.
 */
class DescriptionSeed extends AbstractSeed
{
    public function run(): void
    {
        $table = $this->table('description');

        $data = [];
        $csvFile = fopen(WWW_ROOT . "data/description.csv", "r");

        while (($row = fgetcsv($csvFile)) !== FALSE) {
            $customer_id = $row[1] ?? null;
            $description = $row[2] ?? null;

            if (!$customer_id || !$description || $description === "description") continue;

            $data[] = [
                "customer_id" => $customer_id,
                "description" => $description
            ];
        }

        fclose($csvFile);

        $table->insert($data)->save();
    }
}
