<?php
include "header.php";
include_once("../../model/conect/DBConnection.php");
include_once("../../model/dto/FornecedorDTO.php");
include_once("../../model/dao/FornecedorDAO.php");

$FornecedorDAO = new FornecedorDAO();
$FornecedorDTO = new FornecedorDTO();
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
            <h5>Add new supplier</h5>
            </div>
        <div class="widget-content nopadding">
            <form name="form1" action="../../controller/FornecedorController.php" method="post" class="form-horizontal">
            <div class="control-group">
                <label class="control-label">name:</label>
                <div class="controls">
                <input type="text" class="span11" placeholder="name" name="nome" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">email:</label>
                <div class="controls">
                <input type="email"  class="span11" placeholder="email" name="email" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">phone:</label>
                <div class="controls">
                <input type="text"  class="span11" placeholder="phone" name="telefone" />
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" name="cadastrarfornecedor" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>

        <div class="widget-content nopadding">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>email</th>
                    <th>phone</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($FornecedorDAO->getAll())): ?>
                <?php foreach ($FornecedorDAO->getAll() as $row): ?>
                    <tr>
                        <td><?php echo $row["idfornecedor"]; ?></td>
                        <td><?php echo $row["nome"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["telefone"]; ?></td>
                        <td><a href="edit_supplier.php?idfornecedor=<?php echo $row["idfornecedor"]; ?>">Edit</a></td>
                        <td><a href="delete_supplier.php?idfornecedor=<?php echo $row["idfornecedor"]; ?>">Delete</a></td>
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