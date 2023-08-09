<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Model\Table\DescriptionTable;

/**
 * Description Controller
 *
 * @property DescriptionTable $Description
 */
class DescriptionController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->fetchTable("Description");
        $this->RequestHandler->renderAs($this, 'json');
    }


    public function addDescription(): void
    {
        $this->request->allowMethod(["post"]);
        $customer = $this->request->getData('customer');
        $description_value = $this->request->getData('description_value');
        $saveResponse = null;

        if ($customer && $description_value) {
            $patchData = [
                    "customer_id" => $customer,
                    "description" => $description_value
            ];
            $descriptionEntity = $this->Description->newEmptyEntity();
            $descriptionEntity = $this->Description->patchEntity($descriptionEntity, $patchData);
            $saveResponse = $this->Description->save($descriptionEntity);
        }

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

    public function listDescriptions(): void
    {
        $this->request->allowMethod(["get"]);

        $description = $this->Description->find()->toList();

        $this->set([
            "status" => true,
            "message" => "All available descriptions",
            "data" => $description
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    public function updateDescription()
    {
        $this->request->allowMethod(["put", "post"]);

        $description_id = $this->request->getParam("id");
        $description = $this->Description->get($description_id);
        $isEmpty = empty($description);

        if (!$isEmpty) {
            $customer = $this->request->getData('customer');
            $description_value = $this->request->getData('description_value');

            $descriptionInfo = [
                "customer_id" => $customer ?? $description['customer_id'],
                "description" => $description_value ?? $description['description'],
            ];

            $description = $this->Description->patchEntity($description, $descriptionInfo);
            $saveResponse = $this->Description->save($description);

            if ($saveResponse) {
                $message = "Update success";
                $status = true;
            } else {
                $message = "Update failed";
                $status = false;
            }
        } else {
            $message = "Description Not Found";
            $status = false;
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    public function deleteDescription(): void
    {
        $this->request->allowMethod(["delete"]);

        $description_id = $this->request->getParam("id");

        $description = $this->Description->get($description_id);
        $isEmpty = empty($description);

        if (!$isEmpty) {
            if ($this->Description->delete($description)) {
                $message = "Delete success";
                $status = true;
            } else {
                $message = "Delete Failed";
                $status = false;
            }
        } else {
            $message = "Description not found";
            $status = false;
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }
}
