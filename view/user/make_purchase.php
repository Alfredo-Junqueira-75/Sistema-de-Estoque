<?php
include "header.php";
include_once("../../model/conect/DBConnection.php");
include_once("../../model/dto/CompraDTO.php");
include_once("../../model/dao/CompraDAO.php");
include_once("../../model/dao/ProdutoDAO.php");
include_once(__DIR__ . "/../../controller/ProdutoController.php");

$produto = new ProdutoController();


$CompraDAO = new CompraDAO();
$ProdutoDAO = new ProdutoDAO();
$CompraDTO = new CompraDTO();

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
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Purchase</h5>
            </div>
        <div class="widget-content nopadding">
            <form name="form1" action="../../controller/CompraController.php" method="post" class="form-horizontal" onsubmit="return confirmar()">
            <div class="control-group">
                <label class="control-label">Cliente:</label>
                <div class="controls">
                <input type="text" class="span11" placeholder="cliente" name="cliente" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Products:</label>
                <div class="controls">
                <?php if (!empty($ProdutoDAO->All())): ?>
                <?php foreach ($ProdutoDAO->All() as $row): ?>
                    
                    <label for="<?php echo $row["nome"]; ?>"><?php echo $row["nome"]; ?>:</label>
                    <input type="number" value="0" id="<?php echo $row["nome"]; ?>" name="<?php echo $row["nome"]; ?>" min="0" max="<?php echo $row["quant_em_estoque"]; ?>">

                <?php endforeach; ?>
                <?php else: ?>
                    <p colspan="6">Nenhum produto encontrado.</p>
                <?php endif; ?>
                </div>
            </div>
            
            
            <div class="form-actions">
                <button type="submit" name="finalizarComprar" class="btn btn-success">finalize purchase</button>
            </div>
            </form>
        </div>
        <!-- product table -->
        <div class="widget-content nopadding">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>client</th>
                    <th>products</th>
                    <th>date</th>
                    <th>id user</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($CompraDAO->getAll())): ?>
                <?php foreach ($CompraDAO->getAll() as $row): ?>
                    <tr>
                        <td><?php echo $row["idcompra"]; ?></td>
                        <td><?php echo $row["cliente"]; ?></td>
                        <td><?php echo $row["produtos"]; ?></td>
                        <td><?php echo $row["data"]; ?></td>
                        <td><?php echo $row["idusuario"]; ?></td>
                        <td><a href="delete_purchase.php?idcompra=<?php echo $row["idcompra"]; ?>">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr> 
                    <td colspan="6">Nenhuma compra realizada.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    </div>
        </div>

    </div>
</div>


<?php
include "footer.php"
?>