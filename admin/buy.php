<?php include('adminHeader.php')?>



<div class="addNewProduct">
        <div class="div1 div1Up">
            <h2>Product Details</h2>

            <div class="productDetails">
                <form action="#" method="post">
                    <input type="text" placeholder="Product Name"><br>
                    <textarea name="" id="" placeholder="Summary (short description)"></textarea><br>
                    <textarea name="" id="" placeholder="Description" class="textarea2"></textarea>
                </form>
            </div>

            <div class="div1">
                <h2>Pricing</h2>
    
                <div class="productDetails">
                    <form action="#" method="post">
                        <input type="text" placeholder="Product Name"><br><br>
                    </form>
                </div>
                
            </div>
        </div>

        <div class="div1 div1Up">
            <h2>Product Details</h2>

            <div class="productDetails">
                <form action="#" method="post">
                    <br>
                    <div class="uploadPicturesSec">
                        <p><i class="fa fa-file"></i> Upload A Photo</p>
                    </div>
                    <br>
                    <p class="picUploadNote">
                        Upload photos of your Product (first photo will be set as main feature image).
                         Be sure to upload high quality & focused images in good lighting where possible. Max file size per image  is 2 MB <br><br><br><br>
                    </p>
                </form>
            </div>

            <div class="div1">
                <h2>Shipping</h2>
    
                <div class="productDetails">
                    <form action="#" method="post">
                        <input type="text" placeholder="Shipping from (Your country)*"><br>
                        <input type="text" placeholder="Domestic Price"><br>
                        <input type="text" placeholder="International Price"><br>
                    </form>
                </div>
                
            </div>
        </div>
    </div>















    <?php include('adminFooter.php') ?>