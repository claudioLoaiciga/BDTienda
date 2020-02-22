<?php
  if (isset($_GET['Backup'])) {
    echo "<script language='JavaScript'>alert('BACKUP realizado correctamente"
      . "');</script>";
    echo "
    <script> 
    location.href = 'index.php?c=Seguridad'; 
    </script>
    ";
  }
  if (isset($_GET['Restauracion'])) {
    echo "<script language='JavaScript'>alert('RESTAURACIÓN realizada correctamente"
      . "');</script>";
    echo "
    <script> 
    location.href = 'index.php?c=Seguridad'; 
    </script>
    ";
  }
  if (isset($_GET['Error'])) {
    echo "<script language='JavaScript'>alert('Lo sentimos, se produjo un error. No se realizo correctamente"
      . "');</script>";
    echo "
    <script> 
    location.href = 'index.php?c=Seguridad'; 
    </script>
    ";
  }


?>

<div>
    <form method="post" action="" enctype="multipart/form-data">

        <div class="card">
            <div class="d-flex text-white" style=" display:block;margin:auto; padding-top: 30% ;width:80%">
                <div class="p-2 flex-fill ">
                    <img src="assets/images/b.svg" style="width:100px;">
                    <input name='a' title="Copia de Seguridad" type="submit" value="Backup" class="btn btn-primary" />
                </div>
                <div class="p-2 flex-fill ">Estó fue hecho por Mariel.</div>
                <div class="p-2 flex-fill ">
                    <img src="assets/images/r.svg" style="width:100px;">
                    <input name='a' title="Restaurar Base de Datos" type="submit" value="Restaurar" class="btn btn-primary" />
                </div>
            </div>
        </div>


    </form>
</div>