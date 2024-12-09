<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="pico-main/css/pico.min.css">
    <style>
         body {
            display: flex;
            flex-direction: column;
            align-items: center; 
            justify-content: center; 
        }
         h1 , h2 {
          --pico-font-family: Pacifico, cursive;
          --pico-font-weight: 400;
          --pico-typography-spacing-vertical: 0.5rem;
        }
        table {
            margin-top:2rem;
            width:100%;
            text-align:center;
        }
        form{
            display: inline;
            margin:0 0.5rem;
        }

    </style>
</head>
<body>
    <main class="container">
        <h1>Admin Panel</h1>

        <!--Add Room Form -->
        <section>
            <h2>Add Room</h2>
            <form action="managing.php" method="POST">
                <input type="hidden" name="action" value="add">
                <label for="room_name">Room Name</label>
                <input type="text" id="room_name" name="room_name" placeholder="Room Name" required>

                <label for="capacity">Capacity</label>
                <input type="number" id="capacity" name="capacity" placeholder="Capacity" required>

                <label for="equipment">Equipment</label>
                <input type="text" id="equipment" name="equipment" placeholder="Equipment">

                <button type="submit">Add Room</button>
            </form>
        </section>

        <!--Manage Rooms -->
        <section>
            <h2>Manage Rooms</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Capacity</th>
                        <th>Equipment</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require 'db/connection.php';
                    $result = $conn->query("SELECT * FROM rooms");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['room_id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['capacity']}</td>
                            <td>{$row['equipment']}</td>
                            <td>
                                <form action='managing.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='action' value='edit'>
                                    <input type='hidden' name='room_id' value='{$row['room_id']}'>
                                    <button type='submit'>Edit</button>
                                </form>
                                <form action='managing.php' method='POST' style='display:inline;'>
                                    <input type='hidden' name='action' value='delete'>
                                    <input type='hidden' name='room_id' value='{$row['room_id']}'>
                                    <button type='submit' class='contrast'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
  </section>
 </main>
</body>
</html>
