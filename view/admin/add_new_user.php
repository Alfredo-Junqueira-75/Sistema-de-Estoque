<?php
include "header.php";
include_once("../../model/conect/DBConnection.php");
include_once("../../model/dto/UsuarioDTO.php");
include_once("../../model/dao/UsuarioDAO.php");

$usuarioDAO = new UsuarioDAO();
$usuarioDTO = new UsuarioDTO();
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
              <h5>Add new user</h5>
            </div>
          <div class="widget-content nopadding">
            <form name="form1" action="../../controller/UsuarioController.php" method="post" class="form-horizontal">
              <div class="control-group">
                <label class="control-label">User name:</label>
                <div class="controls">
                  <input type="text" class="span11" placeholder="User name" name="username" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Password:</label>
                <div class="controls">
                  <input type="password"  class="span11" placeholder="Enter Password" name="password" />
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Select Role</label>
                <div class="controls">
                  <select name="role" class="span11" >
                      <option>user</option>
                      <option>admin</option>
                  </select>
                </div>
              </div>
              <div class="form-actions">
                <button type="submit" name="submit3" class="btn btn-success">Save</button>
              </div>
            </form>
          </div>

        <div class="widget-content nopadding">
          <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($usuarioDAO->getAllUsuarios())): ?>
                <?php foreach ($usuarioDAO->getAllUsuarios() as $row): ?>
                    <tr>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["role"]; ?></td>
                        <td><?php echo $row["status"]; ?></td>
                        <td><a href="edit_user.php?id=<?php echo $row["idusuario"]; ?>">Edit</a></td>
                        <td><a href="delete_user.php?id=<?php echo $row["idusuario"]; ?>">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Nenhum usuário encontrado.</td>
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