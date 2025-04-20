<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Injection Data</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>NAME</th>
            <th>EMAIL_ID</th>
            <th>PASS</th>
        </tr>
        <?php
        session_start();
        $data = $_SESSION['injection_data'] ?? [];
        foreach ($data as $row) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['NAME']) . "</td>";
            echo "<td>" . htmlspecialchars($row['EMAIL_ID']) . "</td>";
            echo "<td>" . htmlspecialchars($row['PASS']) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
