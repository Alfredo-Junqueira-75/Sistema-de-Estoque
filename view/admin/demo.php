<?php
include "header.php";
?>

<?php
    include_once(__DIR__ . "/../../controller/ProdutoController.php");
    $produto = new ProdutoController();
    $totalValue = "";
    $totalProduct = "";
    $totalValue = $produto->getTotalValue();
    $totalProduct = $produto->getTotalProduct();
?>

<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" class="tip-bottom"><i class="icon-home"></i>
            Home</a></div>
    </div>
    <!--End-breadcrumbs-->

    <!--Action boxes-->
    <div class="container-fluid">

        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
        <h1>Dashboard</h1>

            <!-- widget start -->
            <div class="card-body color1">
                <div class="float-left">
                    <h3>
                    <span class="currancy">$</span>
                    <span class="count">0</span>
                    </h3>
                    <p>revenue</p>
                </div>
                <div class="float-right">
                    <i class="pe-7s-cart"></i>
                </div>
            </div>
            <!-- widget end -->
            <!-- widget start -->
            <div class="card-body color2">
                <div class="float-left">
                    <h3>
                    <span class="currancy">$</span>
                    <span class="count" ><?php echo "$totalValue"; ?></span>
                    </h3>
                    <p>Total Stock Value</p>
                </div>
                <div class="float-right">
                    <i class="pe-7s-graph3"></i>
                </div>
            </div>
            <!-- widget end -->    
            <!-- widget start -->
            <div class="card-body color3">
                <div class="float-left">
                    <h3>
                    <span class="currancy"></span>
                    <span class="count"><?php echo "$totalProduct"; ?></span>
                    </h3>
                    <p>Quantity of products</p>
                </div>
                <div class="float-right">
                    <i class="pe-7s-cart"></i>
                </div>
            </div>
            <!-- widget end -->    


        </div>

    </div>
</div>


<?php
include "footer.php"
?>