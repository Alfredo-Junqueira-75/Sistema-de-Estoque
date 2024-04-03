<?php
include "header.php";
include_once("../../model/conect/DBConnection.php");
include_once("../../model/dto/ProdutoDTO.php");
include_once("../../model/dao/ProdutoDAO.php");
include_once("../../model/dto/CategoriaDTO.php");
include_once("../../model/dao/CategoriaDAO.php");
include_once(__DIR__ . "/../../controller/ProdutoController.php");

$produto = new ProdutoController();

$ProdutoDAO = new ProdutoDAO();
$ProdutoDTO = new ProdutoDTO();
$CategoriaDAO = new CategoriaDAO();
$CategoriaDTO = new CategoriaDTO();

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
            <h5>Add new product</h5>
            </div>
        <div class="widget-content nopadding">
            <form name="form1" action="../../controller/ProdutoController.php" method="post" class="form-horizontal">
            <div class="control-group">
                    <div class="controls">
                        <input type="hidden" name="user" value="admin">
                    </div>
            </div>
            <div class="control-group">
                <label class="control-label">name:</label>
                <div class="controls">
                <input type="text" class="span11" placeholder="name" name="nome" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">description:</label>
                <div class="controls">
                <input type="text"  class="span11" placeholder="description" name="descricao" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">price:</label>
                <div class="controls">
                <input type="text"  class="span11" placeholder="price($)" name="preco" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">quantity in stock:</label>
                <div class="controls">
                <input type="text" class="span11" placeholder="quantity in stock" name="quant_em_estoque"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">supplier id:</label>
                <div class="controls">
                <input type="text"  class="span11" placeholder="supplier id" name="idfornecedor" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Select category id</label>
                <div class="controls">
                <select name="idcategoria" class="span11" >
                    <option>0</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <option>10</option>
                </select>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" name="cadastrarproduct" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
        <!-- product table -->
        <div class="widget-content nopadding">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>description</th>
                    <th>price</th>
                    <th>quantity in stock</th>
                    <th>barcode</th>
                    <th>supplier id</th>
                    <th>category id</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($ProdutoDAO->All())): ?>
                <?php foreach ($ProdutoDAO->All() as $row): ?>
                    <tr>
                        <td><?php echo $row["idproduto"]; ?></td>
                        <td><?php echo $row["nome"]; ?></td>
                        <td><?php echo $row["descricao"]; ?></td>
                        <td><?php echo $row["preco"]; ?></td>
                        <td><?php echo $row["quant_em_estoque"]; ?></td>
                        <td><?php echo $row["cod_de_barra"]; ?></td>
                        <td><?php echo $row["idfornecedor"]; ?></td>
                        <td><?php echo $row["idcategoria"]; ?></td>
                        <td><a href="edit_product.php?idproduto=<?php echo $row["idproduto"]; ?>">Edit</a></td>
                        <td><a href="delete_product.php?idproduto=<?php echo $row["idproduto"]; ?>">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhum fornecedor encontrado.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <br>
    <!-- category table -->
    <div class="widget-content nopadding">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>category</th>
                    <th>quantity of product</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($CategoriaDAO->All())): ?>
                <?php foreach ($CategoriaDAO->All() as $row): ?>
                    <tr>
                        <td><?php echo $row["idcategoria"]; ?></td>
                        <td><?php echo $row["nome_categoria"]; ?></td>
                        <td>
                            <?php  
                                if($produto->getSubTotalProduct($row["idcategoria"])){
                                    echo "" .$produto->getSubTotalProduct($row["idcategoria"]);
                                }else echo "0";
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhum fornecedor encontrado.</td>
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