<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/managerDashboard.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/product.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
</head>

<body>
    <!-- Sidebar -->
    <?php
    $role = "Manager";
    require APPROOT . '/views/Pages/Dashboard/header.php';
    require APPROOT . '/views/Components/Side Bars/sideBar.php';
    ?>

    <!-- Content -->
    <section class="home">
        <section class="working-panel">
            <div class="fluid-panel">
                <h1 class="display-4">C&A INDOOR CRICKET SHOP</h1>
            </div>
            <div class="image-text">
                <span class="image">
                    <img src="http://localhost/C&A_Indoor_Project/images/Logo3.png" alt="logo">
                </span>
            </div>
            <hr>
        </section>
        <div class="header">
            <h2>Products</h2>
            <button type="button" id="addProduct" onclick="openModal()">Add New Product +</button>
            <div id="myModal" class="modal">
                <div class="modal-content">
                    <h2 class="modal-title">Add New Product</h2>
                    <!-- action="<?php echo URLROOT; ?>/Category/saveCategory ?>" -->
                    <form method="POST" id="productForm">
                            <!-- Product Title -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="productName">Product Name</label>
                                    <input type="text" id="productName" name="productName"
                                        placeholder="Enter Product name">
                                    <span class="form-invalid-1"></span>
                                </div>
                            </div>

                            <!-- Product Category Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_name">Category Name</label>
                                    <select name="category_name" id="category_name" class="form-control">
                                        <option value="0">Select Category</option>
                                        <?php foreach ($data['categories'] as $category): ?>
                                            <option value="<?php echo $category->category_id; ?>">
                                                <?php echo $category->category_name; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select><br>
                                    <span class="form-invalid-2"></span>
                                </div>
                            <!-- Product Brand Name -->
                                <div class="form-group">
                                    <label for="brand_name">Brand Name</label>
                                    <select name="brand_name" id="brand_name" class="form-control">
                                        <option value="0">Select a Category first</option>
                                    </select><br>
                                    <span class="form-invalid-2"></span>
                                </div>
                            </div>

                            <!-- Regular Price of the Product -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="regular_price">Regular Price</label>
                                    <input type="text" id="regular_price" name="regular_price"
                                        placeholder="Regular Price">
                                    <span class="form-invalid-1"></span>
                                </div>
                            <!-- Selling Price of the Product -->
                                <div class="form-group">
                                    <label for="selling_price">Selling Price</label>
                                    <input type="text" id="selling_price" name="selling_price"
                                        placeholder="Selling Price">
                                    <span class="form-invalid-1"></span>
                                </div>
                            </div>

                            <!-- thumbnail -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="product_thumbnail">Product Thumbnail</label>
                                    <input type="file" id="product_thumbnail" name="product_thumbnail">
                                    <span class="form-invalid-1"></span>
                                </div>
                            </div>

                            <!-- short Description -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                    <textarea class="form-control" name="short_description" id="short_description"
                                        rows="5" placeholder="Short Description"></textarea>
                                    <span class="form-invalid-1"></span>
                                </div>
                            </div>


                            <div class="btn">
                                <input type="hidden" id="form_type" name="form_type">
                                <button type="submit" id="submit">Save</button>
                                <button type="button" onclick="closeModal()">Cancel</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="table-container">
            <table id="coachTable">
                <!-- <thead>
                    <tr>
                        <th>Brand ID</th>
                        <th>Category Name</th>
                        <th>Brand Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="categoryTable">
                    <?php $i = 0; ?>
                    <?php foreach ($data['brands'] as $brand): ?>
                        <tr>
                            <td>
                                <?php echo $brand->brand_id; ?>
                            </td>
                            <td>
                                <?php
                                $matchedCategoryName = '';
                                foreach ($data['categories'] as $category) {
                                    if ($category->category_id == $brand->brand_category_name) {
                                        $matchedCategoryName = $category->category_name;
                                        break;
                                    }
                                }
                                echo $matchedCategoryName;
                                ?>
                            </td>
                            <td>
                                <?php echo $brand->brand_name; ?>
                            </td>
                            <td>
                                <button type="button" class="edit" id="<?php echo $brand->brand_id; ?>"><i
                                        class="fas fa-edit"></i></button>
                                <a href="<?php echo URLROOT; ?>/Brand/deleteBrand/<?php echo $brand->brand_id; ?>"><i
                                        class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    endforeach; ?>
                </tbody> -->
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-container">
            <ul class="pagination">
                <li><a href="#" class="page-link">&laquo; Prev</a></li>
                <li><a href="#" class="page-link">1</a></li>
                <li><a href="#" class="page-link">2</a></li>
                <li><a href="#" class="page-link">3</a></li>
                <li><a href="#" class="page-link">4</a></li>
                <li><a href="#" class="page-link">5</a></li>
                <li><a href="#" class="page-link">Next &raquo;</a></li>
            </ul>
        </div>
    </section>

    <!-- javascripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo URLROOT; ?>/js/sideBar.js"></script>
    <script src="<?php echo URLROOT; ?>/js/product.js"></script>
    <script>
        $(document).ready(function () {
            $('#productForm').submit(function (e) {
                e.preventDefault();
                var productName = $('#productName').val();
                var brandCatName = $('#category_name').val();
                if ($('#form_type').val() === "edit") {
                    var id = $('.edit').attr('id');
                }
                else {
                    var id = "";
                }

                if (productName == '') {
                    $('.form-invalid-1').html("Please enter Brand name");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo URLROOT; ?>/Brand/saveBrand",
                        data: {
                            form_type: $('#form_type').val(),
                            productName: productName,
                            brandId: id,
                            category_name: brandCatName
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 'success') {
                                $('#productForm')[0].reset();
                                closeModal();
                                location.reload();
                            } else {
                                $('.form-invalid-1').html(response.messageBrandName);
                                $('.form-invalid-2').html(response.messageBrandCategoryName);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX request failed:", error);
                        }
                    });
                }
            });

            $(".edit").click(function (e) {
                e.preventDefault();
                var id = $(this).attr('id');

                var btn = "edit";
                $('#myModal').css("display", "block");
                $('#form_type').val(btn);
                $('.modal-title').html("Edit Category");
                $('#submit').html("Update").css("background-color", "goldenrod");

                $.ajax({
                    type: "POST",
                    url: "<?php echo URLROOT; ?>/Brand/getBrandById",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function (response) {
                        $('#productName').val(response.brand_name)
                        $('#category_name').val(response.brand_category_name)
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX request failed:", error);
                    }
                });
            });

            $("#category_name").change(function (e) {
                e.preventDefault();
                var id = $("#category_name").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo URLROOT; ?>/Brand/getBrandCategoryById",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function (response) {
                        $("#brand_name").html(response.output);
                    }
                })
            });
        });
    </script>

</body>

</html>