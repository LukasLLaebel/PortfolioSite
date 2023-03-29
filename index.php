<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/main.css">
    <title>Home</title>
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
        <section id="hero">
            <h1>Overskrift</h1>
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                Quaerat quod reprehenderit porro repudiandae sapiente architecto fugiat nostrum! 
                Deserunt, quis id?
            </p>
        </section>
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