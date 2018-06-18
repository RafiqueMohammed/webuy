<!doctype html>
<html lang="en">
<head>
    <?php $this->load->view('template/head'); ?>
</head>

<body>
<?php $this->load->view('template/navbar'); ?>
<!-- Begin page content -->
<main role="main" class="container-fluid">

    <div class="col-md-12">
        <div class="mb-3">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createProductModal">
                + ADD NEW
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Sr. No.</th>
                    <th>NAME</th>
                    <th>CATEGORY</th>
                    <th>PRICE</th>
                    <th>ADDED ON</th>
                    <th class="text-center">ACTION</th>
                </tr>
                <?php
                if (count($products) > 0) {
                    $i = 0;
                    foreach ($products as $product) {
                        $i++;
                        echo "<tr><td class='text-center'>{$i}</td><td>{$product['product_title']}</td>
<td>{$product['category_name']}</td>
<td>Rs.{$product['product_price']}</td>
<td>" . date("d-m-Y", strtotime($product['product_added_on'])) . "</td>
<td class='text-center'>
<a href='" . base_url("/products/view/{$product['product_id']}") . "' class='btn-sm btn-info'><i class='fa fa-eye'></i></a>
</td>
</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center text-warning'>No Products Added</td></tr>";
                }
                ?>
            </table>
        </div>

    </div>

</main>
<div id="createProductModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="form_add_product" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="product_name">Name</label>
                        <input type="text" name="product_title" class="form-control" id="product_name"
                               placeholder="Product name">
                    </div>
                    <div class="form-group">
                        <label for="product_price">Thumbnail</label>
                        <input type="file" class="form-control" name="product_image" id="product_img"/>
                    </div>
                    <div class="form-group">
                        <label for="product_price">Price (Rs.)</label>
                        <input type="text" class="form-control" name="product_price" id="product_price"
                               placeholder="ex. 535">
                    </div>
                    <div class="form-group">
                        <label for="product_desc">Description</label>
                        <textarea class="form-control" name="product_description" id="product_desc"
                                  placeholder="Enter your product description.."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="product_cat">Category</label>
                        <select class="form-control" name="product_category" id="product_cat">
                            <option value="">- SELECT CATEGORY -</option>
                        </select>
                    </div>
                    <div class="display"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btn_add_product" class="btn btn-primary">Add Product</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('template/footer'); ?>
<script>
    var base_url = "/webuy/webservice/public/cms";
    $(function () {
        $.getJSON(base_url + "/categories", function (result) {
            if (result.success === true) {
                $.each(result.data, function (k, v) {
                    $('#product_cat').append(`<option value='${v['category_id']}'>${v['category_name']}</option>`);
                });
            }
        });
        $('#createProductModal').on('hidden.bs.modal', function (e) {
            $("#form_add_product")[0].reset();
            $(".display").html("");

        });
        $('#btn_add_product').on('click', function () {
            var _p_name = $("#product_name").val();
            var _p_price = $("#product_price").val();
            var _p_desc = $("#product_desc").val();
            var _p_cat = $("#product_cat").val();

            //quick validation
            if ((_p_name && _p_price && _p_cat && _p_desc) === "") {
                $(".display").html("<div class='alert alert-danger'>All field required</div>");
            } else {
                $(".display").html("");
                var formData = new FormData($('#form_add_product')[0]);
                $.ajax({
                    url: base_url + '/products',
                    data: formData,
                    type: 'POST',
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        if (res.success === true) {
                            window.location.reload();
                        } else {
                            $(".display").html("<div class='alert alert-danger'>" + res.message + "</div>");

                        }
                    },
                    error: function (err) {
                        $(".display").html("<div class='alert alert-danger'>" + err + "</div>");
                    }
                });
            }
        });
    })
</script>

</body>
</html>
