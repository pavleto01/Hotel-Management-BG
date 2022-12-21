<?php
include ('view/header.php');    

$client_fname = $client_lname = $client_address = $client_phone = $client_email = '';

$errors = array('client_fname'=>'','client_lname'=>'','client_address'=>'','client_phone'=>'','client_email'=>'');

if(isset($_POST['submit'])){

    if(empty($_POST['client_fname'])){
            $errors['client_fname'] = "A first name title is required <br/>";
        } else {
            $client_fname = $_POST['client_fname'];
        }

    if(empty($_POST['client_lname'])){
            $errors['client_lname'] = "A last name is required <br/>";
        } else {
            $client_lname = $_POST['client_lname'];
        }

    if(empty($_POST['client_address'])){
            $errors['client_address'] = "An address is required <br/>";
        } else {
            $client_address = $_POST['client_address'];
        }

    if(empty($_POST['client_phone'])){
            $errors['client_phone'] = "A phone is required <br/>";
        } else {
            $client_phone = $_POST['client_phone'];
        }

    if(empty($_POST['client_email'])){
            $errors['client_email'] = "An email is required <br/>";
        } else {
            $client_email = $_POST['client_email'];
        }


    
    if(array_filter($errors)){
            
        } else{

            $client_fname  = mysqli_real_escape_string($conn, $_POST['client_fname']);
            $client_lname  = mysqli_real_escape_string($conn, $_POST['client_lname']);
            $client_address  = mysqli_real_escape_string($conn, $_POST['client_address']);
            $client_phone  = mysqli_real_escape_string($conn, $_POST['client_phone']);
            $client_email  = mysqli_real_escape_string($conn, $_POST['client_email']);


            $sql = "INSERT INTO client(client_fname, client_lname, client_address, client_phone, client_email) VALUES ('$client_fname', '$client_lname','$client_address','$client_phone','$client_email')";

            

            if(mysqli_query($conn, $sql)){
                header('Location: showclients.php');
            } else {
                echo 'query error: '. mysqli_error($conn);
            }
        }
        }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>
<table class="centertable2">
                        <div class="alert alert-success">
                            <h2 style="text-align:center; ">Добави клиент</h2>
                        </div>
                        
                    <form method="POST">
                    <tr>
                    <th> Първо име на клиент:
                    <br>
                    <input type = "text" name = "client_fname" value = "<?php echo htmlspecialchars($client_fname) ?>">
                    <div class = "red-text"> <?php echo $errors['client_fname']; ?> </div>
                    </th>
                    </tr>
                     <tr>
                    <th> Фамилия на клиент:
                    <br>
                    <input type = "text" name = "client_lname" value = "<?php echo htmlspecialchars($client_lname) ?>">
                    <div class = "red-text"> <?php echo $errors['client_lname']; ?> </div>
                    </th>
                    </tr>

                    <tr>
                    <th> Адрес:
                    <br>
                    <input type = "text" name = "client_address" value = "<?php echo htmlspecialchars($client_address) ?>">
                    <div class = "red-text"> <?php echo $errors['client_address']; ?> </div>
                    </th>
                    </tr>

                    <tr>
                    <th> Телефон на клиент:
                    <br>
                    <input type = "text" name = "client_phone" value = "<?php echo htmlspecialchars($client_phone) ?>">
                    <div class = "red-text"> <?php echo $errors['client_phone']; ?> </div>
                    </th>
                    </tr>

                    <tr>
                    <th> Имейл:
                    <br>
                    <input type = "text" name = "client_email" value = "<?php echo htmlspecialchars($client_email) ?>">
                    <div class = "red-text"> <?php echo $errors['client_email']; ?> </div>
                    </th>
                    </tr>
                    <tr>
                        <th>
                    <div class="center">
                        <input type="submit" name="submit" value = "ДОБАВИ" class = "btn brand z-deth-0">
                    </div>
                </th>
                </tr>
                </form>
            </table>
</body>
</html>