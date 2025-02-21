<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <title>Home Page</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Background Image Rotation
        const images = [
            '{{ asset('images/hallway-01-jpg.jpg') }}',
            '{{ asset('images/foundation-1.jpg.jpg') }}',
            '{{ asset('images/pixy-trees.jpeg.jpg') }}'
        ];

        function changeBackgroundImage() {
            const randomIndex = Math.floor(Math.random() * images.length);
            document.querySelector('.hero-section').style.backgroundImage = `url('${images[randomIndex]}')`;
        }

        setInterval(changeBackgroundImage, 5000);
        changeBackgroundImage();

        // Sidebar Menu Toggle
        const menuIcon = document.querySelector(".menu-icon");
        const sideMenu = document.querySelector(".side-menu");
        const closeMenu = document.querySelector(".close-menu");

        // Open menu when clicking the menu icon
        menuIcon.addEventListener("click", function(event) {
            event.stopPropagation(); // Prevents click from bubbling up
            sideMenu.classList.add("active");
        });

        // Close menu when clicking the close button
        closeMenu.addEventListener("click", function() {
            sideMenu.classList.remove("active");
        });

        // Close menu when clicking outside of it
        document.addEventListener("click", function(event) {
            if (!sideMenu.contains(event.target) && !menuIcon.contains(event.target)) {
                sideMenu.classList.remove("active");
            }
        });

        const categoryDropdown = document.getElementById("categoryDropdown");
        const selectedCategory = document.getElementById("selectedCategory");
        const categoryOptions = document.getElementById("categoryOptions");
        const dropdownArrow = document.getElementById("dropdownArrow");

        // Toggle dropdown menu when clicking the category box
        categoryDropdown.addEventListener("click", function (event) {
            event.stopPropagation();
            categoryOptions.style.display = categoryOptions.style.display === "block" ? "none" : "block";
        });

        // Handle category selection
        categoryOptions.addEventListener("click", function (event) {
            if (event.target.classList.contains("dropdown-item")) {
                selectedCategory.textContent = event.target.getAttribute("data-value");
                categoryOptions.style.display = "none";
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", function (event) {
            if (!categoryDropdown.contains(event.target)) {
                categoryOptions.style.display = "none";
            }
        });

    });
</script>

</head>
<body>
    <header class="navbar">
    <div class="logo">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
        </div>
        <div class="menu-icon">
            <img src="{{ asset('images/menus.png') }}" alt="Menu Icon">
        </div>
        <!-- Side Menu -->
        <div class="side-menu">
            <div class="close-menu">&times;</div>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/about">About</a></li>
                <li><a href="/image-gallery">Image-Gallery</a></li>
                <li><a href="/video-gallery">Video-Gallery</a></li>
                <li><a href="/audio-gallery">Audio-Gallery</a></li>
            </ul>
        </div>

    </header>

    <section class="hero-section">
    <div class="hero-overlay"></div> <!-- Overlay Added -->
    <h1>BrickMMO Media Hub: <br> Building Smart Cities, One Innovation at a Time!</h1>
    <p class="scroll-text">Scroll for more</p>
    <div class="arrow">
        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="31" viewBox="0 0 21 31" fill="none">
            <path d="M10.5013 30.375V1M10.5013 30.375C7.81706 30.375 2.80216 24.5167 0.917969 23.0313M10.5013 30.375C13.1855 30.375 18.2004 24.5167 20.0846 23.0312" 
            stroke="#FFFBFB" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
</section>


    <section class="media-section">
    <div class="overlay">
    </div>
    <div class="media-content">
        <h2>Discover the Perfect Media</h2>
        <p>Search, Filter, and Find with Ease!</p>
        
        <!-- Search Form -->
        <form action="{{ route('search') }}" method="GET" class="search-bar">
            <!-- Media Type Selector -->
            <select name="type" id="mediaTypeSelect" class="media-type-selector" style="padding: 12px 20px; font-size: 18px; min-width: 150px; margin-right: 10px; border: none;">
                <option value="image">Images</option>
                <option value="video">Videos</option>
                <option value="audio">Audios</option>
            </select>

            <!-- Tag Dropdown -->
            <select name="tag" id="tagDropdown" class="search-category" style="padding: 12px 20px; font-size: 18px; min-width: 150px; margin-right: 10px;">
                <option value="">Select Category</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>

            <!-- Search Button -->
            <button type="submit" class="search-button" style="padding: 12px 25px; font-size: 18px;">Search</button>
        </form>
    </div>
</section>


<section class="about-section">
        <div class="overlay">
            <img src="{{ asset('images/mini-me-2.jpg.jpg') }}" alt="About Us Background">
        </div>
        <div class="about-content">
            <h2>EXPLORE & DOWNLOAD,<br>INSPIRE & CONNECT</h2>
            <p>Welcome to BrickMMO Media Hub, your go-to platform <br> for accessing high-quality media related to the <br> BrickMMO project. Our mission is to provide an extensive <br> library of images, videos, and audio that showcase the <br> creativity and impact of BrickMMO participants and <br>organizations. Explore, download, and share these <br> moments to inspire and connect with the community!</p>
            <a href="{{ url('/about') }}" style="text-decoration: none; color: inherit;">
                <div class="about-button">
                    <div class="about">About us</div>
                </div>
            </a>
                        
        </div>
    </section>
    <section class="explore-section">
        <div class="explore-container">
        <img src="{{ asset('images/city-5.jpg.jpg') }}" alt="Explore Content Background">
            <div class="explore-content">
            <h2>EXPLORE THE <br>CONTENT</h2>
<div class="explore-options">
    <a href="/image-gallery" class="explore-link">
        <div class="explore-item">Images</div>
    </a>
    <a href="/video-gallery" class="explore-link">
        <div class="explore-item">Videos</div>
    </a>
    <a href="/audio-gallery" class="explore-link">
        <div class="explore-item">Audios</div>
    </a>
</div>

            </div>
        </div>
    </section>
        <section class="contact-section">
        <div class="contact-container">
            <h2>Like to know more?</h2>
            <p class="email">thomasadam83@hotmail.com</p>
            <div class="contact-details">
                <p class="contact-title">Humber College</p>
                <p class="contact-info">North Campus, Toronto, M8V 1K8</p>
            </div>
        </div>
    </section>
    <footer class="footer-section">
        <div class="footer-container">
        <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Footer Logo" class="footer-logo">
            </a>
            <nav class="footer-nav">
                <a href="/" class="footer-link">Home</a>
                <a href="/about" class="footer-link">About</a>
                <a href="#contact-section" class="footer-link">Contact</a>
            </nav>
            <div class="footer-copy">© 2025 BrickMMO</div>
        </div>
    </footer>
</body>
</html>
