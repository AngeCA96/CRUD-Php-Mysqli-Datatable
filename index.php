<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.11.4/datatables.min.css"/>

        <title>CRUD</title>
    </head>
    <body>
        <br>
        <h1 align="center">DataTables &amp; CRUD</h1>
        <br>
        <?php require_once 'process.php';?>
        
        <?php if(isset($_SESSION['message'])): ?>
        
        <div class="alert alert-<?=$_SESSION['msg_type']?> alert-dismissible fade show"> 
            
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>    
        <?php endif ?>
        <div class="container-fluid">
        
            <?php 
                $mysqli = new mysqli('localhost', 'root', '', 'ejemplo') or die (mysql_error($mysqli));
                $result = $mysqli->query("SELECT * FROM data") or die ($mysqli->error);
            ?>

            <div class="row justify-content-between">
                <div class="col-6">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <?php
                        while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['location']; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-outline-info">Edit</a>
                        </td>
                        <td>
                            <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-outline-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile;?>
                </table>
                </div>
                <div class="col-5">
                    <form action="process.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label>Location:</label>
                            <input type="text" name="location" class="form-control" value="<?php echo $location; ?>" placeholder="Enter your location">
                        </div>
                        <div class="form-group">
                            <?php
                                if($update == true):
                            ?>
                            <button type="submit" class="btn btn-info" name="update">Update</button>
                            <?php else: ?>
                            <button type="submit" class="btn btn-primary" name="save">Save</button>
                            <?php endif;?>
                        </div>
                    </form>
                </div>
            </div>            
        </div>
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
        
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.6.0/dt-1.11.4/datatables.min.js"></script>
        <script>
            $(document).ready( function () {
                $('#myTable').DataTable();
            } );
            
            var table = $('#myTable').DataTable({
                pageLength : 5,
                lengthMenu: [[5,10,20,-1], [5,10,20,'All']]
            });
        </script>
    </body>
</html>