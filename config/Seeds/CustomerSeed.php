<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * Customer seed.
 */
class CustomerSeed extends AbstractSeed
{
    public function run(): void
    {
        $table = $this->table('customer');

        $data = [];
        $csvFile = fopen(WWW_ROOT . "data/customer.csv", "r");

        while (($row = fgetcsv($csvFile)) !== FALSE) {
            $kit_id = $row[1] ?? null;
            $customer_name = $row[2] ?? null;

            if (!$customer_name || $customer_name === "customer_name") continue;

            $data[] = [
                "kit_id" => (int) $kit_id,
                "customer_name" => $customer_name,
            ];
        }

        fclose($csvFile);

        $table->insert($data)->save();
    }
}
