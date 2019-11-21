<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    
    function show(){
        include '../sql.php';
            $showCmd = "SELECT * FROM hanghoa";
            $show = mysqli_query($con, $showCmd);
            if ($show->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($show)) {
                    if ($row['SOLUONGHANG'] > 0){
                        $GIA = number_format($row['GIA'], 0)."đ";
                        $THUOCTINH = "green";
                    }else{
                        $GIA = "HẾT HÀNG";
                        $THUOCTINH = 'red';
                    }
                ?>
                <div class="col-md-3">
                    <div class="card mb-4 shadow-sm" style="display: inline-block">
                        <img class="card-img-top" src="<?php echo $row['HINH']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo substr($row['TENHH'], 0, 30); ?></h5>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted" style="color: red;"><?php echo substr($row['MOTAHH'], 0, 30); ?></small>
                            </div>
                            <p class="card-text" id="currency" style="color: <?php echo $THUOCTINH; ?>; font-weight: bold; font-size: 20px;"><?php echo $GIA; ?></p>
                            <form class="row" method="POST" action="add_to_cart.php">
                                <div class="col-9">
                                    <input type="number" name="quantity" id="quantity" min="1" max="1000" class="form-control" placeholder="Còn <?php echo $row['SOLUONGHANG']; ?> sản phẩm">
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary" name="addToCart" value="<?php echo $row['MSHH']; ?>"><i class="fas fa-cart-plus"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                }
            }
    }
?>