<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br>
        <br>

        <?php
                if(isset($_SESSION['add'])) //checking whether the session is set or not
                {
                    echo $_SESSION['add']; //displaying session message
                    unset($_SESSION['add']); //removing session message
                }
         ?>
         <br>
         <br>       
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your Name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter your Username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter your Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
    //process the value from form and save it in database
    //check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Buttton clicked
        //echo "button clicked";

        //1. get the data from form
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = md5($_POST['password']);  //password Encryption with md5

        //2. sql querry to save the data to database
        $sql = "INSERT INTO tbl_admin SET
            full_name = '$full_name',
            username = '$username',
            password = '$password'
        ";

        // 3. executing querry and saving data into database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        // 4. whether the (querry is executed) data is insserted or not and display appropriate message
        if ($res==TRUE) 
        {
            // data inserted
            // create a variable to diaplay a message 
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully</div>";
            // redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            // failed to insert data
            // create a variable to diaplay a message 
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin</div>";
            // redirect page to add manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }


    }
?>

