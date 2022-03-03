<?php include('partials/menu.php');  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br>
        <br>
        <?php
            //1. get the id of selected admin to update
            $id = $_GET['id'];

            //2. create sql query to get the details
            $sql = "SELECT * FROM tbl_admin WHERE id = $id";

            //Execute the query
            $res = mysqli_query($conn, $sql);

            //check whether the query executed sucessfully or not
            if($res==true)
            {
                //check whethter the data is avaliable or not
                $count = mysqli_num_rows($res); 
                //chech wheter we have admin data or not
                if($count==1)
                {
                    //get the detailes
                    //echo "admin avaliable";
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //redirect to manage admin page
                    header('location:'.SITEURL.'admin/manage-admin.php');    
                }
            }
        ?>

        <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>Full Name:</td>
                <td><input type="text" name="full_name" value="<?php echo $full_name;?>"></td>
            </tr>

            <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?php echo $username;?>"></td>
            </tr>
            
            <tr>
                <td colspan="2">
                    <br>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="update Admin" class="btn-secondary">
                </td>
            </tr>
        </table>    
        </form>
    </div>
</div>

<?php
    //check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //echo "button clicked";
        //get all the values from form to update 
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        
        //create sql query to update admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id = $id
        ";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the query executer sucessfully or not
        if($res==true)
        {
            //query executer and admin updated
            $_session['update'] = "<div class='success'>Admin Updates Sucessfully</div>"; 
            //redirect to manage-admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            $_session['update'] = "<div class='success'>Admin Updates Unsucessfully</div>"; 
            //redirect to manage-admin page
            header('location:'.SITEURL.'admin/manage-admin.php');    
        }
    }
?>

<?php include('partials/footer.php'); ?>