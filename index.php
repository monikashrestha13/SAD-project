<?php
include 'dbconnection/connection.php';

// Handle search query
$searchResults = [];
if (isset($_GET['search'])) {
    $searchQuery = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT * FROM art WHERE title LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $searchResults[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Portfolio for Artist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <ul>
            <li><a href="#home" class="nav_link active">Home</a></li>
            <li><a href="#about" class="nav_link">About</a></li>
            <li><a href="#gallery" class="nav_link">Gallery</a></li>
            <li><a href="#contact" class="nav_link">Contact</a></li>
            <label class="switch">
                <input type="checkbox">
                <span class="slider"></span>
            </label>
        </ul>
    </nav>
    <header>
        <section id="home" class="content">
            <h1> <span style="color: red;">Moon</span>ika Shrestha</h1>
            <p>Discover the best Artist in the World</p>
            <div class="header-image">
                <img src="public/pexels-photo-1988681.jpeg" alt="image-1">
                <img src="public/pexels-photo-3094218.jpeg" alt="image-2">
                <img src="public/pexels-photo-3299386.jpeg" alt="image-3">
                <img src="public/pexels-photo-595747.jpeg" alt="image-4">
            </div>
        </section>
    </header>
    <section id="about" class="about">
        <h2>About Me</h2>
        <div class="artist-detail">
            <div class="artist-image">
                <img src="public/pexels-photo-3778361.webp" alt="artist-image">
            </div>
            <div class="artist-description">
                <p>Moonika Shrestha was a famous Nepali painter. She painted pictures of herself and used lots of bright
                    colors. Her paintings showed how she felt inside and what she thought about the world around her.
                    People still love her paintings today because they are unique and full of emotions.</p>
                <button id="downloadBtn"> <a href="">Download Resume</a></button>
            </div>
        </div>
    </section>
    <section id="gallery" class="gallery">
        <h2>Gallery</h2>
        <div class="search-bar">
            <form action="index.php#gallery" method="get">
                <input type="text" name="search" placeholder="Search for art..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="gallery-container">
            <?php
            if (!empty($searchResults)) {
                foreach ($searchResults as $art) {
                    echo '<div class="gallery-item">';
                    echo '<img src="' . $art['image_path'] . '" alt="' . $art['title'] . '">';
                    echo '<h3>' . $art['title'] . '</h3>';
                    echo '<p>' . $art['description'] . '</p>';
                    echo '</div>';
                }
            } else {
                $sql = "SELECT * FROM art";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="gallery-item">';
                        echo '<img src="' . $row['image_path'] . '" alt="' . $row['title'] . '">';
                        echo '<h3>' . $row['title'] . '</h3>';
                        echo '<p>' . $row['description'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="no-results">No art found. Please try a different search.</p>';
                }
            }
            ?>
        </div>
    </section>
    <section id="contact" class="contact">
        <div class="primarycenter">Contact Us</div>
        <div class="contact-box">
            <form action="submission.php" method="POST">
                <div class="form-group">
                    <label for="description">Message:</label>
                    <textarea name="description" id="description" cols="30" rows="10" required></textarea>
                </div>
                <input type="submit" value="Send" name="submit">
            </form>
        </div>
    </section>
    <section class="footer">
        <div class="first">
            <div class="contactus">
                <b>Contact Us</b>
                <p>Chhabdi Barahi Temple</p>
                <p>+9779829182166</p>
                <p>monikabict@gmail.com</p>
            </div>
            <div class="social">
                <h4>Social links</h4>
                <a href="https://www.facebook.com/monika.stha.549"><i class="fa-brands fa-facebook"
                        style="color: blue;font-size: 1.3rem;"></i></a>
                <a href="https://www.instagram.com/riko_amanai.0/"> <i class="fa-brands fa-square-instagram"
                        style="color:rgb(242, 92, 117);font-size: 1.3rem;"></i></a>
                <a href="https://github.com/moonikastha"> <i class="fa-brands fa-github"
                        style="color:black;font-size: 1.3rem;"> </i></a>

            </div>
        </div>
        <div class="second">
            <div class="resources">
                <h4>Resources</h4>
                <p>Portfolio</p>
                <p>Home</p>
                <p>Gallery</p>
                <p>Services</p>
                <p>Contact Us</p>
                <p>Projects</p>
                <p>Artist</p>
            </div>
        </div>
        <div class="third">
            <h4>Locate Us</h4>
            <p>Sitemaps</p>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"
        integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="script.js"></script>
</body>
</html>