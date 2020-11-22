<?php
$servername = "localhost";
$username = "";
$password = "";
$database = "";


// Create connection
$conn = new mysqli($servername, $username, $password, $database);


if (isset($_GET['make_transfer'])) {
    session_start();
    
    $transferring_account = $_SESSION['transfer_account'];
    $transfer_account = mysqli_real_escape_string($conn, $transferring_account);
    $sql = "select * from customers where name='$transfer_account'";
    $result = mysqli_query($conn, $sql);
    $row= mysqli_fetch_array($result);
    
    $transfer_account_balance = (int)$row['balance'];
    $transfered_amount = $_GET['transferred_amount'];
    $updated_transfer_balance = $transfer_account_balance - $transfered_amount;
    
    $sql_update = "UPDATE customers SET balance=$updated_transfer_balance WHERE name='$transfer_account'";
    
    if (mysqli_query($conn,$sql_update) === TRUE) {
        echo "Record Updated successfully";
    } else {
        printf("Error Updating record: %s\n ", mysqli_error($conn));
    }


    $recipient = $_GET['recipient'];    
    $sql = "select * from customers where name='$recipient'";
    $result = mysqli_query($conn, $sql);
    $row= mysqli_fetch_array($result);     
    
    $recipient_account_balance = (int)$row['balance'];
    $transferred_amount = (int)$_GET['transferred_amount'];
    $updated_balance = $recipient_account_balance + $transferred_amount;
    
    $sql_update = "UPDATE customers SET balance=$updated_balance WHERE name='$recipient'";
    if (mysqli_query($conn,$sql_update) === TRUE) {
        echo "Record Updated successfully";
    } else {
        printf("Error Updating record: %s\n ", mysqli_error($conn));
    }

    // Update transaction database

    $sql = "INSERT INTO transactions (transfer, recipient, amount)  VALUES ('$transfer_account','$recipient', '$transferred_amount')";
    if (mysqli_query($conn, $sql)) {
        echo "Record Updated successfully";
    } else {
        printf("Error Updating record: %s\n ", mysqli_error($conn));
    }    
    
    //Display Updated Table

    $sql = 'select * from customers';
    $result = mysqli_query($conn,$sql);
    echo "<table border=1>";
    echo "<tr>";
    echo "<th>"; echo 'id'; echo '</th>';
    echo '<th>'; echo 'name'; echo '</th>';
    echo '<th>'; echo 'email'; echo '</th>'; 
    echo '<th>'; echo 'balance'; echo '</th>';
    echo "</tr>";
    
    while ($row=mysqli_fetch_array($result)){
        echo '<tr>';
        echo '<td>'; echo $row['id']; echo '</td>';
        echo '<td>'; echo $row['name']; echo '</td>';
        echo '<td>'; echo $row['email']; echo '</td>';
        echo '<td>'; echo $row['balance']; echo '</td>';
        echo '</tr>';
    }
    echo "</table>";

}

?>
