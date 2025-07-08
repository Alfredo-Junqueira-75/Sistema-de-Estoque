<?php
include_once "header.php";
include_once "../../model/conect/DBConnection.php";
include_once "../../model/dto/ProdutoDTO.php";
include_once "../../model/dao/ProdutoDAO.php";
include_once __DIR__ . "/../../controller/ProdutoController.php";

$id = $_GET['idproduto'];
$produto = $ProdutoController->getProdutoById($id);

$nome = "";
$descricao = "";
$preco = "";
$quant_em_estoque = "";
$idfornecedor = "";
$idcategoria = "";



if ($produto) {
    $id = $produto->getIdProduto();;
    $nome = $produto->getNome();
    $descricao = $produto->getDescricao();
    $preco = $produto->getPreco();
    $quant_em_estoque = $produto->getQuantEmEstoque();
    $idfornecedor = $produto->getIdfornecedor();
    $idcategoria = $produto->getIdcategoria();
}

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
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">name:</label>
                <div class="controls">
                    <input type="text" class="span11" placeholder="name" name="nome" value="<?php echo $nome; ?>" readonly />
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
                    <input type="text"  class="span11" placeholder="price($)" name="preco" value="<?php echo $descricao; ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">quantity in stock:</label>
                <div class="controls">
                    <input type="text" class="span11" placeholder="quantity in stock" name="quant_em_estoque" value="<?php echo $quant_em_estoque; ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">supplier id:</label>
                <div class="controls">
                    <input type="text"  class="span11" placeholder="supplier id" name="idfornecedor" value="<?php echo $idfornecedor; ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Select category id</label>
                <div class="controls">
                    <select name="idcategoria" class="span11" >
                        <option <?php if ($produto->getIdcategoria() == "0"){echo "selected";} ?>>0</option>
                        <option <?php if ($produto->getIdcategoria() == "2"){echo "selected";} ?>>2</option>
                        <option <?php if ($produto->getIdcategoria() == "3"){echo "selected";} ?>>3</option>
                        <option <?php if ($produto->getIdcategoria() == "1"){echo "selected";} ?>>1</option>
                        <option <?php if ($produto->getIdcategoria() == "4"){echo "selected";} ?>>4</option>
                        <option <?php if ($produto->getIdcategoria() == "5"){echo "selected";} ?>>5</option>
                        <option <?php if ($produto->getIdcategoria() == "6"){echo "selected";} ?>>6</option>
                        <option <?php if ($produto->getIdcategoria() == "7"){echo "selected";} ?>>7</option>
                        <option <?php if ($produto->getIdcategoria() == "8"){echo "selected";} ?>>8</option>
                        <option <?php if ($produto->getIdcategoria() == "9"){echo "selected";} ?>>9</option>
                        <option <?php if ($produto->getIdcategoria() == "10"){echo "selected";} ?>>10</option>
                    </select>
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" name="submit2" class="btn btn-success">Update</button>
            </div>
            </form>
        </div>
    
            </div>
        </div>
    </div>


    <?php
include __DIR__ . '/../includes/footer.php';
?>

