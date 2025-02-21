<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
    <title>About Page</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/about.css')}}">
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuIcon = document.querySelector(".menu-icon");
        const sideMenu = document.querySelector(".side-menu");
        const closeMenu = document.querySelector(".close-menu");

        menuIcon.addEventListener("click", function(event) {
            event.stopPropagation();
            sideMenu.classList.add("active");
        });

        closeMenu.addEventListener("click", function() {
            sideMenu.classList.remove("active");
        });

        document.addEventListener("click", function(event) {
            if (!sideMenu.contains(event.target) && !menuIcon.contains(event.target)) {
                sideMenu.classList.remove("active");
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

    <!-- About Us Section with Background Video -->
    <section class="about-section">
        <video autoplay muted loop playsinline class="about-video">
            <source src="{{ asset('videos/train-2.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="about-overlay">
            <h2 class="about-title">ABOUT US</h2>
        </div>
    </section>

     <!-- Who We Are Section -->
     <section class="who-we-are-section">
        <div class="who-we-are-container">
            <!-- Left Side: Images -->
            <div class="who-we-are-images">
                <img class="image1" src="{{ asset('images/city-5.jpg.jpg') }}" alt="Image 1">
                <img class="image2" src="{{ asset('images/hallway-01-jpg.jpg') }}" alt="Image 2">
                <img class="image3" src="{{ asset('images/about3.jpg') }}" alt="Small Image">
                <img class="image4" src="{{ asset('images/about4.jpg') }}" alt="Image 4">
            </div>

            <!-- Right Side: Text Content -->
            <div class="who-we-are-content">
                <h2 class="who-we-are-title">WHO WE ARE?</h2>
                <p class="who-we-are-text">
                    Your ultimate destination for discovering and sharing high-quality media content related to the BrickMMO project. 
                    This platform serves as a central repository for images, videos, and audio that capture the essence of BrickMMO’s creative community.
                    Whether you're a participant, an organization, or an enthusiast, our media hub ensures that you have easy access to a rich collection of visual and audio content 
                    that highlights the innovation, collaboration, and fun behind BrickMMO.
                </p>
                <p class="who-we-are-mission">br>
                    At BrickMMO Media Hub, our goal is to provide a seamless and efficient way to store, search, and download media related to BrickMMO. 
                    We aim to bridge the gap between creators and the community by making it easier to find and utilize project-related media for presentations, promotions, or simply for inspiration.
                </p>
            </div>
        </div>
    </section>
        <!-- Key Features Section -->
    <section class="key-features-section">
        <div class="key-features-container">
            <!-- Background Image -->
            <img class="key-features-bg" src="{{ asset('images/pixy-trees.jpeg.jpg') }}" alt="Key Features Background">

            <!-- Content -->
            <div class="key-features-content">
                <h2 class="key-features-title">Key Features</h2>
                <br>
                <ul class="key-features-list">
                    <li>✅ <strong>Extensive Media Library:</strong> Browse a vast collection of photos, videos, and audio files from BrickMMO events, creations, and collaborations.</li>
                    <li>✅ <strong>Easy Search & Filters:</strong> Find exactly what you need using keyword search, category filters, and sorting options.</li>
                    <li>✅ <strong>Direct Google Drive Integration:</strong> All media is securely stored in Google Drive, ensuring high availability and accessibility.</li>
                    <li>✅ <strong>Quick Downloads:</strong> Instantly download media with a single click—no login or registration required.</li>
                    <li>✅ <strong>Endless Scrolling & Smooth Navigation:</strong> Enjoy a user-friendly interface with seamless browsing through infinite scrolling.</li>
                </ul>
            </div>
        </div>
    </section>
        <!-- How It Works Section -->
    <section class="how-it-works-section">
        <div class="how-it-works-container">
            <h2 class="how-it-works-title">How It Works</h2><br>
            <p class="how-it-works-description">
                <strong>Browse & Search</strong> – Use keywords, tags, or categories to find media content.<br>
                <strong>Preview Media</strong> – Click on an image, video, or audio file to see full details, including file size, date, and source.<br>
                <strong>Download Instantly</strong> – Get high-quality files directly from Google Drive with a simple click.<br>
                <strong>Discover More</strong> – Check out related media to explore similar content.
            </p>
        </div>
    </section>
    <!-- Why BrickMMO Media Hub? Section -->
    <section class="why-brickmmo-section">
        <div class="why-brickmmo-container">
            <!-- Background Image -->
            <img class="why-brickmmo-bg" src="{{ asset('images/city-square-1.jpg.jpg') }}" alt="Why BrickMMO Background">

            <!-- Content -->
            <div class="why-brickmmo-content">
                <h2 class="why-brickmmo-title">Why BrickMMO Media Hub?</h2>
                <p class="why-brickmmo-description">
                    BrickMMO is a dynamic and innovative project that brings together LEGO® enthusiasts, digital builders, and organizations worldwide. 
                    This media hub is designed to support, promote, and archive the incredible work of our community by offering easy access to official and user-submitted media.
                </p>
                <ul class="why-brickmmo-features">
                    <li>🔹 <strong>No Account Required</strong> – Browse and download without the hassle of signing up.</li>
                    <li>🔹 <strong>Regular Updates</strong> – Fresh media is added continuously to ensure the latest BrickMMO moments are available.</li>
                    <li>🔹 <strong>Completely Free</strong> – All media is accessible at no cost, making it easy for everyone to enjoy and share.</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Join the Community Section -->
    <section class="join-community-section">
        <div class="join-community-container">
            <!-- Background Image -->
            <img class="join-community-bg" src="{{ asset('images/about5.jpg') }}" alt="Join the Community Background">

            <!-- Content -->
            <div class="join-community-content">
                <h2 class="join-community-title">Join the Community</h2>
                <br>
                <p class="join-community-description">
                    BrickMMO Media Hub is more than just a media library—it’s a celebration of creativity, teamwork, and digital building.
                    Whether you’re looking for inspiration, project materials, or simply want to relive memorable moments, this is the place to be!
                </p>
                <p class="join-community-contact">
                    📢 <strong>Have Questions?</strong> Feel free to reach out to us for support or media requests. Let's keep building and sharing together! 🚀
                </p>
            </div>
        </div>
    </section>


    <!-- Contact Section -->
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

    <!-- Footer -->
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
