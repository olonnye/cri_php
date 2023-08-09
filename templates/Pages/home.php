<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        $connection = ConnectionManager::get($name);
        $connected = $connection->connect();
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
    }

    return compact('connected', 'error');
};

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

function mapArrayContents($descriptionObject) {
    return $descriptionObject['description'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        CRI Interview
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'home']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <main class="main">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="column">
                        <div class="customer-display-container">
                            <div class="kit-display-container">
                                <h1>Kit: <span id="customer-kit-content"></span></h1>
                            </div>

                            <div class="customer-info-container">
                                <span>Name: </span>
                                <span id="customer-name-content" class="wrap-text-content"></span>
                            </div>
                            <div class="customer-info-container">
                                <span>Description: </span>
                                <span id="customer-description-content" class="wrap-text-content"></span>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <table>
                            <thead>
                            <tr>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($customersList as $customer): ?>
                                <tr class="enable-click">
                                    <td
                                        data-name="<?= $customer['customer_name']; ?>"
                                        data-kit="<?= $customer['kit']['kit_id']; ?>"
                                        data-description="<?= implode('<hr/>', array_map("mapArrayContents", $customer['description'])); ?>"
                                        onclick="setCurrentCustomer(this)"
                                    >
                                        <?= $customer['customer_name']; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script>
        function setCurrentCustomer(element) {
            const customerName = element.dataset['name'];
            const customerKitId = element.dataset['kit'];
            const customerDescription = element.dataset['description'];

            const kitContentElement = document.getElementById('customer-kit-content');
            kitContentElement.innerHTML = customerKitId;

            const nameContentElement = document.getElementById('customer-name-content');
            nameContentElement.innerHTML = customerName;

            const descriptionContentElement = document.getElementById('customer-description-content');
            descriptionContentElement.innerHTML = customerDescription;
        }
</script>
</html>
