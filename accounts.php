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

if (isset($_GET['display'])){
    $sql = 'select * from customers';
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
    unset($_GET['display']);
    
}
?>
<html>
    <table>
        <tr>
            <td>
                <form action="transfer.php" method="POST">
                <input type='text' id='textbox' name='transfer_from' placeholder="Who wants to transfer">
                <input type='submit' id='button' name="transfer" value="Submit">
                </form>
               
            </td>
        </tr>
              
    </table>
</html>


