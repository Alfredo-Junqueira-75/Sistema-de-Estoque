<?php
include_once "header.php";
include_once "../../model/conect/DBConnection.php";
include_once "../../model/dto/FornecedorDTO.php";
include_once "../../model/dao/FornecedorDAO.php";
include_once (__DIR__ . "/../../controller/FornecedorController.php");

$id = $_GET['idfornecedor'];

$nome = "";
$email = "";
$telefone = "";

$fornecedor = $fornecedorController->getFornecedorById($id);

if ($fornecedor) {
    $id = $fornecedor->getId();
    $nome = $fornecedor->getNome();
    $email = $fornecedor->getEmail();
    $telefone = $fornecedor->getTelefone();
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
                    <h5>Edit Supplier</h5>
                </div>
                <div class="widget-content nopadding">
                    <form name="form1" action="../../controller/FornecedorController.php" method="post" class="form-horizontal">
                        <div class="control-group">
                            <div class="controls">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Supplier Name:</label>
                            <div class="controls">
                                <input type="text" class="span11" placeholder="Supplier Name" name="nome"
                                    value="<?php echo $nome; ?>" readonly />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Supplier Email:</label>
                            <div class="controls">
                                <input type="text" class="span11" placeholder="Supplier Email" name="email"
                                    value="<?php echo $email; ?>" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Supplier Telephone:</label>
                            <div class="controls">
                                <input type="text" class="span11" placeholder="Supplier Telephone" name="telefone"
                                    value="<?php echo $telefone; ?>" />
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="submit" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php
include "footer.php"
?>

