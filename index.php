<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Bank</title>
</head>

<body>
<div>
    <h1>Welcome to Basic Banking System</h1>
</div>
    <h2>We Transfer stuff from here to there</h2>
<div>  
    <table>
        <tr>
            <td colspan='2'> 
                <form action='accounts.php' method=GET>
                <label for="submit">Press for Table</label>
                <input type='submit' id=button name='display' value='Display'>                    
                </form>
            </td>
        </tr>
        
    </table>    
</div>

</body>
</html>
<?php
if (isset($_GET['update'])){
    
    echo "<br>";
    echo "HELLO";
    echo "<form action='' method='GET'>";
    echo "<input type='text' id='text_box' name='transfer_name'>"; echo "<label for='transfer_name'>Transfer from:</label>";
    echo "</form>";
    
}
?>

