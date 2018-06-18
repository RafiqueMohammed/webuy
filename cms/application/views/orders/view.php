<!doctype html>
<html lang="en">
<head>
    <?php $this->load->view('template/head'); ?>
</head>

<body>
<?php $this->load->view('template/navbar'); ?>
<!-- Begin page content -->
<main role="main" class="container-fluid">
    <div class="row" style="margin-top:80px">
        <div class="col-md-5">
            <h5>USER INFORMATION</h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>FULL NAME</th>
                        <td><?= $order['fullname']; ?></td>
                    </tr>
                    <tr>
                        <th>MOBILE</th>
                        <td><?= $order['mobile']; ?></td>
                    </tr>
                    <tr>
                        <th>EMAIL</th>
                        <td><?= $order['email']; ?></td>
                    </tr>
                    <tr>
                        <th>ADDRESS</th>
                        <td><?= $order['address']; ?></td>
                    </tr>

                </table>
            </div>

        </div>
        <div class="col-md-7">
            <h5>PRODUCT INFORMATION</h5>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Sr.</th>
                        <th>PRODUCT NAME</th>
                        <th></th>
                    </tr>
                    <?php

                    if (count($order['products']) > 0) {
                        $i = 0;
                        foreach ($order['products'] as $product) {
                            $i++;
                            echo "<tr><td class='text-center'>{$i}</td>
<td>{$product['product_title']}</td>
<td><a href='" . base_url("/products/view/{$product['product_id']}?back=/orders/view/{$order['order_id']}") . "'>VIEW</a></td>
</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' class='text-center text-warning'>No Products Available</td></tr>";
                    }
                    ?>
                </table>
            </div>

        </div>
    </div>
</main>

</body>
</html>
