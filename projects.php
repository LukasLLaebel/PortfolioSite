<?php 
include "./lib/database.php";
include "./github_request.php";

// counter start
$inserted_rows = 0;
// checking every dataset giving from github
foreach ((array)$data as $value) {

    // setting up data collecting structure
    $sql_get = "SELECT * FROM `github_data` WHERE `repo_name`=?";
    // prepareing the connection to database
    $stmt_get = $connect->prepare($sql_get);
    // confirming the value name as a string
    $stmt_get->bind_param("s", $value['name']);
    // executing the request
    $stmt_get->execute();
    // getting stmt results
    $result = $stmt_get->get_result();

    // checking if the data already is in the database
    if ($result->num_rows > 0) {
        // setting update struckture
        $sqlUpdate = "UPDATE `github_data` SET `description`=?, `updated_at`=?, `stars`=?, `language`=? WHERE `repo_name`=?";
        // prepareing conection to database for update
        $stmt_update = $connect->prepare($sqlUpdate);
        // setting values 
        $stmt_update->bind_param("ssiss", $value['description'], $value['updated_at'], $value['stargazers_count'], $value['language'], $value['name']);
        // executing update
        $stmt_update->execute();
        //echo "Data Updated\n";
    }else {
        // taking data from the specific location and store it to database
        $stmt->bind_param(
            "sssssiss", $value['description'], $value['name'], $value['created_at'], $value['updated_at'], 
            $value['language'], $value['stargazers_count'], $value['visibility'], $value['html_url']
        );
        // sending to data to database
        $stmt->execute();

    }
    // counting rows
    $inserted_rows ++;
}

// finding errors when executing sql
if ($stmt->error) {
    echo $stmt->error;
}

// counter checker for every foreach
/* ********************** *
if (count((array)$data) == $inserted_rows) {
    echo "Success";
} else {
    echo "ERROR";
}
* *********************** */
//echo $inserted_rows;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/projects.css">
    <link rel="stylesheet" href="./css/projectTables.css">
    <title>Projects</title>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo"><a href="/">Portfolio</a></div>
            <ul class="links">
                <li><a href="about.php">About</a></li>
                <li><a href="projects.php">Projects</a></li>
            </ul>
            <a href="#" class="action_btn">Get CV</a>
            <div class="toggle_btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="dropdown_menu">
            <li><a href="about.php">About</a></li>
            <li><a href="projects.php">Projects</a></li>
            <a href="#" class="action_btn">get CV</a>
        </div>
    </header>


    <main>
        <h1>Projects</h1>

        <?php 
        $data_repo="SELECT * FROM `github_data`";
        $repos=mysqli_query($connect,$data_repo);
        if ($repos) {
            while($row=mysqli_fetch_assoc($repos)) {
                $id = $row['id'];
                $name = $row['repo_name'];
                $description = $row['description'];
                $created_at = $row['created_at'];
                $updated_at = $row['updated_at'];
                $stars = $row['stars'];
                $language = $row['language'];
                $visibility = $row['visibility'];
                $url = $row['url'];
                
                echo '<table '.($id % 2 == 0 ? 'class="left"' : 'class="right"'). 'style="width:40%">
                <tr>
                    <th>'.$name .'</th>
                </tr>
                <tr>
                    <td>'.$description.'</td>
                </tr>
                <tr>
                    <td>Created at:  '.$created_at.'</td>
                </tr>
                <tr>
                    <td>Last updated:  '.$updated_at.'</td>
                </tr>
                <tr>
                    <td>'.$stars.'</td>
                </tr>
                <tr>
                    <td>'.$language.'</td>
                </tr>
                <tr>
                    <td>'.$visibility.'</td>
                </tr>
                <tr>
                    <td><a href="'.$url.'" target="_blank">github</a></td>
                </tr>
                </table>';
            }
        } 
        ?>
    </main>

    <script>
        const toggleBtn = document.querySelector('.toggle_btn')
        const toggleBtnIcon = document.querySelector('.toggle_btn i')
        const dropDownMenu = document.querySelector('.dropdown_menu')

        toggleBtn.onclick = function() {
            dropDownMenu.classList.toggle('open')
            const isOpen = dropDownMenu.classList.contains('open')
            toggleBtnIcon.classList = isOpen 
                ? 'fa-solid fa-xmark'
                : 'fa-solid fa-bars'
            }
    </script>
</body>
</html>

<?php 
$stmt->close();
$connect->close();
?>