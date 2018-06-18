<!doctype html>
<html lang="en">
<head>
    <?php $this->load->view('template/head'); ?>
</head>

<body>
<?php $this->load->view('template/navbar'); ?>
<!-- Begin page content -->
<main role="main" class="container-fluid">

    <div class="mb-3">
        <a href="<?=($back=='')?base_url("/products"):$back;?>" class="btn btn-warning btn-sm">&laquo; BACK</a></div>
    <?php if(count($product)>0){ ?>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-striped table-bordered">
                <tr><th>PRODUCT NAME</th><td><?=$product['product_title'];?></td> </tr>
                <tr><th>DESCRIPTION</th><td><?=$product['product_description'];?></td></tr>
                <tr><th>PRICE</th><td><?=$product['product_price'];?></td></tr>
                <tr><th>CATEGORY NAME</th><td><?=$product['category_name'];?></td></tr>
                <tr><th>ADDED ON</th><td><?=$product['product_added_on'];?></td></tr>
            </table>
        </div>
        <div class="col-md-6">
            <img style="width: 100%" src="<?=base_url('/../webservice/uploads/'.$product['product_image']);?>"/>
        </div>


    </div>
    <?php } else{ echo "<div class='alert alert-danger'>NO PRODUCT FOUND</div>"; } ?>

</main>

<?php $this->load->view('template/footer'); ?>

</body>
</html>
