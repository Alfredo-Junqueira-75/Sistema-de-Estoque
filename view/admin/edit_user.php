<?php
include "header.php";
include_once "../../model/conect/DBConnection.php";
include_once "../../controller/UsuarioController.php";

$id = $_GET['id'];
$usuarioController = new UsuarioController();
$usuario = $usuarioController->getUsuarioById($id);

?>

<div id="content">
    <!-- breadcrumbs -->
    <div id="content-header">
        <div id="breadcrumb"><a href="index.html" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
    </div>
    <!-- End-breadcrumbs -->

    <!-- Action boxes -->
    <div class="container-fluid">
        <div class="row-fluid" style="background-color: white; min-height: 1000px; padding:10px;">
            <div class="widget-box">
                <div class="widget-title">
                    <span class="icon">
                        <i class="icon-align-justify"></i>
                    </span>
                    <h5>Edit user</h5>
                </div>
                <div class="widget-content nopadding">
                    <form name="form1" action="../../controller/UsuarioController.php" method="post" class="form-horizontal">
                        <div class="control-group">
                            <div class="controls">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">User name:</label>
                            <div class="controls">
                                <input type="text" class="span11" placeholder="User name" name="username"
                                    value="<?php echo $usuario->getUsername(); ?>" readonly />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"> New Password:</label>
                            <div class="controls">
                                <input type="password" class="span11" placeholder="Enter New Password"
                                    name="password" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Select Role</label>
                            <div class="controls">
                                <select name="role" class="span11">
                                    <option <?php if ($usuario->getRole() == "user") {
                                                echo "selected";
                                            } ?>>user</option>
                                    <option <?php if ($usuario->getRole() == "admin") {
                                                echo "selected";
                                            } ?>>admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Select Status</label>
                            <div class="controls">
                                <select name="status" class="span11">
                                    <option <?php if ($usuario->getStatus() == "active") {
                                                echo "selected";
                                            } ?>>active</option>
                                    <option <?php if ($usuario->getStatus() == "inactive") {
                                                echo "selected";
                                        } ?>>inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="submit4" class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
include "footer.php";
?>
