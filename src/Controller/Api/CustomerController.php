<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Model\Table\CustomerTable;

/**
 * Customer Controller
 *
 * @property CustomerTable $Customer
 */
class CustomerController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->fetchTable("Customer");
        $this->RequestHandler->renderAs($this, 'json');
    }


    public function addCustomer(): void
    {
        $this->request->allowMethod(["post"]);
        $name = $this->request->getData('name');
        $kit = $this->request->getData('kit');

        $patchData = [
            "customer_name" => $name,
            "kit_id" => $kit,
        ];

        $customerEntity = $this->Customer->newEmptyEntity();
        $customerEntity = $this->Customer->patchEntity($customerEntity, $patchData);
        $saveResponse = $this->Customer->save($customerEntity);

        if ($saveResponse) {
            $message = "Create success";
            $status = true;
        } else {
            $message = "Create failed";
            $status = false;
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    public function listCustomers(): void
    {
        $this->request->allowMethod(["get"]);

        $customers = $this->Customer->find('all', array(
            'contain' => array('Kit', 'Description'),
        ))->toList();

        $this->set([
            "status" => true,
            "message" => "All available customers",
            "data" => $customers
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    public function findAllCustomers(): string
    {
        $this->request->allowMethod(["get"]);

        $customers = $this->Customer->find('all', array(
            'contain' => array('Kit', 'Description')
        ))->toArray();

        return json_encode($customers);
    }

    public function updateCustomer()
    {
        $this->request->allowMethod(["put", "post"]);

        $customer_id = $this->request->getParam("id");
        $customer = $this->Customer->get($customer_id);
        $isEmpty = empty($customer);

        if (!$isEmpty) {
            $name = $this->request->getData('name');
            $kit = $this->request->getData('kit');
            $customerInfo = [
                "customer_name" => $name ?? $customer['customer_name'],
                "kit_id" => $kit ?? $customer['kit_id'],
            ];

            $customer = $this->Customer->patchEntity($customer, $customerInfo);
            $saveResponse = $this->Customer->save($customer);

            if ($saveResponse) {
                $message = "Update success";
                $status = true;
            } else {
                $message = "Update failed";
                $status = false;
            }
        } else {
            $message = "Customer Not Found";
            $status = false;
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    public function deleteCustomer(): void
    {
        $this->request->allowMethod(["delete"]);

        $customer_id = $this->request->getParam("id");

        $customer = $this->Customer->get($customer_id);
        $isEmpty = empty($customer);

        if (!$isEmpty) {
            if ($this->Customer->delete($customer)) {
                $message = "Delete success";
                $status = true;
            } else {
                $message = "Delete Failed";
                $status = false;
            }
        } else {
            $message = "Customer not found";
            $status = false;
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }
}
