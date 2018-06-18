<!doctype html>
<html lang="en">
<head>
    <?php $this->load->view('template/head'); ?>
</head>

<body>
<?php $this->load->view('template/navbar'); ?>
<!-- Begin page content -->
<main role="main" class="container-fluid">

    <div class="col-md-6 offset-md-3">
        <div class="mb-3">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createCategoryModal">
                + ADD NEW
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Sr. No.</th>
                    <th>CATEGORY</th>
                    <th>ADDED ON</th>
                </tr>
                <?php
                if (count($categories) > 0) {
                    $i = 0;
                    foreach ($categories as $category) {
                        $i++;
                        echo "<tr><td class='text-center'>{$i}</td>
<td>{$category['category_name']}</td>
<td>" . date("d-m-Y", strtotime($category['category_created_on'])) . "</td>
</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center text-warning'>No Categories Added</td></tr>";
                }
                ?>
            </table>
        </div>

    </div>

</main>
<div id="createCategoryModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="category_name">Name</label>
                        <input type="text" name="category_name" class="form-control" id="category_name">
                    </div>
                    <div class="display"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btn_add_category" class="btn btn-primary">Add Category</button>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('template/footer'); ?>
<script>
    var base_url = "/webuy/webservice/public/cms";
    $(function () {

        $('#createCategoryModal').on('hidden.bs.modal', function (e) {
            $("#category_name").val("");
            $(".display").html("");

        });
        $('#btn_add_category').on('click', function () {
            var _c_name = $("#category_name").val();

            //quick validation
            if (_c_name === "") {
                $(".display").html("<div class='alert alert-danger'>Enter category name</div>");
            } else {
                $(".display").html("");
               $.post(base_url+"/categories",{category_name:_c_name},function (res) {
                   console.log(res,"bfr");
                 
                   if(res.success===true){
                       window.location.reload();
                   }else{
                       $(".display").html("<div class='alert alert-danger'>"+res.message+"</div>");

                   }

               })
            }
        });
    })
</script>

</body>
</html>
