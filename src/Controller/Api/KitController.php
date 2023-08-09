<?php
declare(strict_types=1);

namespace App\Controller\Api;

use App\Controller\AppController;
use App\Model\Table\KitTable;

/**
 * Kit Controller
 *
 * @property KitTable $Kit
 */
class KitController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->fetchTable("Kit");
        $this->RequestHandler->renderAs($this, 'json');
    }


    public function addKit(): void
    {
        $this->request->allowMethod(["post"]);
        $kit = $this->request->getData('kit');

        $patchData = [
            "kit_id" => $kit,
        ];

        $kitEntity = $this->Kit->newEmptyEntity();
        $kitEntity = $this->Kit->patchEntity($kitEntity, $patchData);
        $saveResponse = $this->Kit->save($kitEntity);

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

    public function listKits(): void
    {
        $this->request->allowMethod(["get"]);

        $kits = $this->Kit->find()->toList();

        $this->set([
            "status" => true,
            "message" => "All available kits",
            "data" => $kits
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message", "data"]);
    }

    public function updateKit()
    {
        $this->request->allowMethod(["put", "post"]);

        $kit_id = $this->request->getParam("id");
        $kit = $this->Kit->get($kit_id);
        $isEmpty = empty($kit);

        if (!$isEmpty) {
            $kitData = $this->request->getData('kit');
            $kitInfo = [
                "kit_id" => $kitData ?? $kit['kit_id'],
            ];

            $kit = $this->Kit->patchEntity($kit, $kitInfo);
            $saveResponse = $this->Kit->save($kit);

            if ($saveResponse) {
                $message = "Update success";
                $status = true;
            } else {
                $message = "Update failed";
                $status = false;
            }
        } else {
            $message = "Kit Not Found";
            $status = false;
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }

    public function deleteKit(): void
    {
        $this->request->allowMethod(["delete"]);

        $kit_id = $this->request->getParam("id");

        $kit = $this->Kit->get($kit_id);
        $isEmpty = empty($kit);

        if (!$isEmpty) {
            if ($this->Kit->delete($kit)) {
                $message = "Delete success";
                $status = true;
            } else {
                $message = "Delete Failed";
                $status = false;
            }
        } else {
            $message = "Kit not found";
            $status = false;
        }

        $this->set([
            "status" => $status,
            "message" => $message
        ]);

        $this->viewBuilder()->setOption("serialize", ["status", "message"]);
    }
}
