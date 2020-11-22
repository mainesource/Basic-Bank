<?php
session_start();
$servername = "localhost";
$username = "id15309496_admin";
$password = "ASDFGHzxcvbnm12!@";
$database = "id15309496_bank_db";


// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['transfer'])){    
    $_SESSION['transfer_account'] = $_POST['transfer_from'];
    $transfer_account = $_SESSION['transfer_account']; 
    $transfer_account = mysqli_real_escape_string($conn, $transfer_account);
    $sql = "select * from customers where name='$transfer_account'";
    
    $result = mysqli_query($conn, $sql);
    $row= mysqli_fetch_array($result);
            
    echo "<table border=1>";
    echo "<tr>";    
    echo "<th>";echo 'name'; echo '</th>';     
    echo "<th>"; echo 'balance'; echo '</th>';
    echo "</tr>";
    echo "<tr>";    
    echo "<td>";echo $row['name']; echo '</td>';     
    echo "<td>"; echo $row['balance']; echo '</td>';
    echo "</tr>";
    echo "</table>";      

    echo "<form action = 'updated_balance.php' method='GET'>";
    echo "<input type='text' name='recipient' placeholder='Recipient'>"; echo "<br>";
    echo "<input type='text' name='transferred_amount' placeholder='Transfer Amount'>"; echo"<br>";
    echo "<input type='submit' name='make_transfer' value='Transfer'>"; echo "<br>";
    echo "</form>";

    if (isset($_GET['transferred_amount'])) {
        $transfer_account_balance = (int)$row['balance'];
        $transfered_amount = $_GET['transferred_amount'];
        $updated_transfer_balance = $transfer_account_balance - $transfered_amount;
        echo "$updated_transfer_balance";
    }    

    $sql = "select * from customers where  name != '$transfer_account' ";
    $result = mysqli_query($conn,$sql);
    echo "<table border=1>";
    echo "<tr>";
    echo "<th>"; echo 'id'; echo '</th>';
    echo '<th>';echo 'name'; echo '</th>';
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


