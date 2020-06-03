<?php 
global $user;
$conn = mysqli_connect("localhost", "root", "", "todolist");
$data = mysqli_query($conn, "SELECT*FROM $user ORDER BY tanggal DESC");


 ?>

 <?php if (!isset($_GET['act'])): ?>
 	<?php header("Location: index.php?act=task") ;
    ?>
 <?php endif; ?>

 <!-- Tampil -->
 <?php if ($_GET['act'] == "task"): ?>
    <?php if (isset($_POST["mencari"])): 
        $cariTgl = $_POST["cariTanggal"];
        $cari = $_POST["cari"];
        ?>
          <?php if ($cariTgl == true): ?>
                <?php 
                    $dataCari = mysqli_query($conn,"SELECT*FROM $user WHERE  tanggal LIKE '%$cariTgl%'");
                    while ($row = mysqli_fetch_assoc($dataCari)) {
                        if ($row["tanggal"] == "0000-00-00") {
                            $row["tanggal"] = "-";
                        }

                        if ($row["waktu"] == "00:00:00") {
                            $row["waktu"] = "-";
                        }
                     ?>
                        

                    <div class="col d-inline-block" style="min-width: 379.995px;max-width: 379.995px;margin-top: 7px;margin-bottom: 4px;">
                        <div class="card" style="width: 356px;min-width: 356px;max-width: 356px;height: 186px;">
                            <div class="card-body" style="height:190px; max-height: 190px; overflow: auto;">
                                <p class="card-text"><?php echo $row["task"]; ?></p><p class="card-text"><?php echo $row["tanggal"]; ?> <b style="font-size: 20px;">|</b> <?php echo $row["waktu"]; ?></p>
                                <a class="card-link" href="?act=hapus&id=<?php echo $row["id"]; ?>" style="font-size: 23px;color: rgb(231,76,60);margin: 0px;margin-top: 0px;padding: 0px;padding-top: 0px;padding-bottom: 0px; position: relative;" onclick="return confirm ('Yakin?');"><i class="fa fa-trash" style="font-size: 23px;padding-top: 0px;margin: 0px;margin-top: 28px;"></i></a>
                                <a
                                    class="card-link" href="?act=edit&id=<?php echo $row["id"]; ?>" style=""><i class="fa fa-pencil" style="font-size: 23px;"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
            <?php endif; ?> 
            <?php if ($cari == true): ?>
                <?php 
                    $dataCari = mysqli_query($conn,"SELECT*FROM $user WHERE  task LIKE '%$cari%'");
                    while ($row = mysqli_fetch_assoc($dataCari)) {
                        if ($row["tanggal"] == "0000-00-00") {
                            $row["tanggal"] = "-";
                        }

                        if ($row["waktu"] == "00:00:00") {
                            $row["waktu"] = "-";
                        }
                     ?>
                        

                     <div class="col d-inline-block" style="min-width: 379.995px;max-width: 379.995px;margin-top: 7px;margin-bottom: 4px;">
                        <div class="card" style="width: 356px;min-width: 356px;max-width: 356px;height: 186px;">
                            <div class="card-body" style="height:190px; max-height: 190px; overflow: auto;">
                                <p class="card-text"><?php echo $row["task"]; ?></p><p class="card-text"><?php echo $row["tanggal"]; ?> <b style="font-size: 20px;">|</b> <?php echo $row["waktu"]; ?></p>
                                <a class="card-link" href="?act=hapus&id=<?php echo $row["id"]; ?>" style="font-size: 23px;color: rgb(231,76,60);margin: 0px;margin-top: 0px;padding: 0px;padding-top: 0px;padding-bottom: 0px; position: relative;" onclick="return confirm ('Yakin?');"><i class="fa fa-trash" style="font-size: 23px;padding-top: 0px;margin: 0px;margin-top: 28px;"></i></a>
                                <a
                                    class="card-link" href="?act=edit&id=<?php echo $row["id"]; ?>" style=""><i class="fa fa-pencil" style="font-size: 23px;"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
            <?php endif; ?>   
        
    <?php else: ?>    
        <?php 
        while ($row = mysqli_fetch_assoc($data)) {

            if ($row["tanggal"] == "0000-00-00") {
                $row["tanggal"] = "-";
            }

            if ($row["waktu"] == "00:00:00") {
                $row["waktu"] = "-";
            }
        ?>

        <div class="col d-inline-block" style="min-width: 379.995px;max-width: 379.995px;margin-top: 7px;margin-bottom: 4px;">
            <div class="card" style="width: 356px;min-width: 356px;max-width: 356px;height: 186px;">
                <div class="card-body" style="height:190px; max-height: 190px; overflow: auto;">
                    <p class="card-text"><?php echo $row["task"]; ?></p><p class="card-text"><?php echo $row["tanggal"]; ?> <b style="font-size: 20px;">|</b> <?php echo $row["waktu"]; ?></p>
                    <a class="card-link" href="?act=hapus&id=<?php echo $row["id"]; ?>" style="font-size: 23px;color: rgb(231,76,60);margin: 0px;margin-top: 0px;padding: 0px;padding-top: 0px;padding-bottom: 0px; position: relative;" onclick="return confirm ('Yakin?');"><i class="fa fa-trash" style="font-size: 23px;padding-top: 0px;margin: 0px;margin-top: 28px;"></i></a>
                    <a
                        class="card-link" href="?act=edit&id=<?php echo $row["id"]; ?>" style=""><i class="fa fa-pencil" style="font-size: 23px;"></i></a>
                </div>
            </div>
        </div>
        <?php  
        }
        ?>
    
    <?php endif; ?>
 	
 <?php endif; ?>
<!-- END -->

<!-- Edit -->
 <?php if ($_GET["act"] == "edit"): ?>
 	<?php
 	 $id = $_GET["id"];
 	 while ($row = mysqli_fetch_assoc($data)) {
        if ($row["waktu"] == "00:00:00") {
            $row["waktu"] = "-";
        }
 	 ?>
 	 <?php if ($id == $row["id"]): ?>
    <!-- back -->
    <?php 
    if (isset($_POST['edit'])) {
        $newtask = $_POST['newtask'];
        $tgl = $_POST['tanggal'];
        $wkt = $_POST['waktu'];
        $id = $_GET["id"];
        $oldtask = $_POST["oldtask"];
        if (!isset($newtask)) {
            $newtask = $oldtask; 
        }
        mysqli_query($conn, "UPDATE $user SET task='$newtask', tanggal='$tgl', waktu='$wkt' WHERE id=$id");
        if (mysqli_affected_rows($conn) > 0) {
            if (headers_sent()) {
                echo "<script> location.replace('index.php'); </script>";
            }
            else{
                exit(header("Location: index.php"));
            }
        } else {
            mysqli_query($conn,"UPDATE $user SET task='$oldtask', tanggal=now() WHERE id=$id");
             echo "<script> location.replace('index.php'); </script>";
        }
    }
    ?>
    <!-- UI -->
 	<div class="col d-inline-block" style="min-width: 379.995px;max-width: 379.995px;margin-top: 7px;margin-bottom: 4px;">
        <div class="card" style="height: 186px;margin: 0px;padding: 8px;opacity: 1;filter: blur(0px);width: 352px;">
            <div class="card-body" style="width: 337px; overflow: auto;"><form action="?act=edit&id=<?php echo $row["id"] ?>" method="post"><textarea class="border rounded-0 border-success" required="" autofocus="" autocomplete="off" style="width: 295px;height: 100px;margin-bottom: 10px;padding: 1px;background-color: rgb(48,48,48);color: rgb(255,255,255);max-width: 295px;" name="newtask"><?php echo $row["task"]; ?></textarea>
                <input type="hidden" name="oldtask" value="<?php echo $row["task"]; ?>">
                <input class="bg-light border rounded-0 border-success"type="date" name="tanggal" style="color: whitesmoke;" value="<?php echo $row["tanggal"]; ?>">
                <input class="bg-light border rounded-0 border-success" type="time" name="waktu" style="color: whitesmoke;" value="<?php echo $row["waktu"]; ?>">
                <button
                    class="btn btn-outline-success btn-block btn-sm text-center border rounded border-success ml-auto" type="submit" style="width: 30px;margin: 0px;height: 31px;" name="edit"><i class="fas fa-pen-square shadow-sm" style="font-size: 22px;margin: 0px;margin-left: -3px;"></i></button> </form>
            </div>
        </div>
    </div>
 	 <?php else: ?>
 	 <div class="col d-inline-block" style="min-width: 379.995px;max-width: 379.995px;margin-top: 7px;margin-bottom: 4px;">
        <div class="card" style="width: 356px;min-width: 356px;max-width: 356px;height: 186px;">
            <div class="card-body" style="height: 190px;">
                <p class="card-text"><?php echo $row["task"]; ?></p><p class="card-text"><?php echo $row["tanggal"]; ?></p>
                <a class="card-link" href="?act=hapus&id=<?php echo $row["id"]; ?>" style="font-size: 23px;color: rgb(231,76,60);margin: 0px;margin-top: 0px;padding: 0px;padding-top: 0px;padding-bottom: 0px;" onclick="alert ('Yakin?');"><i class="fa fa-trash" style="font-size: 23px;padding-top: 0px;margin: 0px;margin-top: 28px;"></i></a>
                <a
                    class="card-link" href="?act=edit&id=<?php echo $row["id"]; ?>"><i class="fa fa-pencil" style="font-size: 23px;"></i></a>
            </div>
        </div>
    </div>
 	 <?php endif ;?>

 	 <?php    
 	 }
 	 ?>
 <?php endif; ?>
<!-- END -->
 <?php 
 	if (isset($_POST['simpan'])) {
        global $user;
 		$task = $_POST["task"];
        $tgl = $_POST['tanggal'];
        $wkt = $_POST['waktu'];

        if ($tgl == true AND $wkt == true) {
            mysqli_query($conn, "INSERT INTO $user VALUES ('', '$task', '$tgl', '$wkt')");
        }elseif ($tgl == false AND $wkt == false) {
            mysqli_query($conn, "INSERT INTO $user VALUES ('', '$task', '', '' )");
        }elseif ($tgl == true AND $wkt == false) {
            mysqli_query($conn, "INSERT INTO $user VALUES ('', '$task', '$tgl', '' )");
        }elseif ($tgl == false AND $wkt == true) {
             mysqli_query($conn, "INSERT INTO $user VALUES ('', '$task', '', '$wkt' )");
        }
 		

 		if (mysqli_affected_rows($conn) > 0) {
                echo "<script> document.location.href ='index.php';</script>";
            
        }else {
		      return false;
		}

 	}
	if ($_GET['act'] == "hapus") {
        global $user;
		$id = $_GET['id'];

		mysqli_query($conn, "DELETE FROM $user WHERE id=$id");

		if (mysqli_affected_rows($conn) > 0) {
			header("Location: ?act=task");
		}
	}

    if ($_GET["act"] == "logout") {
        session_start();
        $_SESSION = [];
        session_unset();
        session_destroy();
        header("Location: log/login.php");
        exit;
    }

    

	 ?>




