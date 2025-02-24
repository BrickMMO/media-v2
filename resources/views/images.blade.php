<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
    <title>Image Gallery</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/gallery-images.css')}}">
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
        <div class="about-video">
            <img src="{{ asset('images/city-hotel-6.jpg.jpg') }}" type="video/mp4">
    </div>
        <div class="about-overlay">
            <h2 class="about-title">IMAGE GALLERY</h2>
        </div>
    </section>
    <section class="image-grid">
        @foreach($data as $index => $item)
            <div class="image-container" onclick="openModal({{ $index }})">
                <img src="https://lh3.googleusercontent.com/d/{{ $item->google_id }}=w500-h500" alt="{{ $item->name }}">
                <div class="overlay">
                    <p>{{ $item->name }}</p>
                    <div class="circle">+</div>
                </div>
            </div>
        @endforeach
    </section>
    <section class="modal" id="imageModal">
        <button class="close" onclick="closeModal()">&times;</button>
        <button class="prev" onclick="prevImage()">&#10094;</button>
        <div class="modal-content">
            <img id="modalImage" src="" alt="">
            <div class="modal-details">
                <h2 id="modalTitle" class="modal-title"></h2>
                <p id="modalDetails"></p><br><br>
                <a id="downloadLink" class="download-btn" download>DOWNLOAD</a>
            </div>
        </div>
        <button class="next" onclick="nextImage()">&#10095;</button>
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
        let images = @json($data);
    let currentIndex = 0;
    function openModal(index) {
        currentIndex = index;
        document.getElementById('modalImage').src = `https://lh3.googleusercontent.com/d/${images[index].google_id}=w800-h600`;
        document.getElementById('modalTitle').innerText = images[index].name;
        document.getElementById('modalDetails').innerHTML = `
            <div class="modal-info">
                <p><strong>Approval Status:</strong> ${images[index].approved == 1 ? '✅ Approved' : '❌ Not Approved'}</p>
                <p><strong>Type:</strong> ${images[index].type}</p>
                <p><strong>Uploaded By:</strong> ${images[index].first} ${images[index].last}</p>
                <p><strong>Email:</strong> <a href="mailto:${images[index].email}">${images[index].email}</a></p>
                <p><strong>Uploaded On:</strong> ${new Date(images[index].created_at).toLocaleDateString()}</p>
            </div>
        `;

        let imageUrl = `https://lh3.googleusercontent.com/d/${images[index].google_id}`;
        let imageName = `${images[index].name.replace(/\s+/g, '_')}.jpg`; 
        let downloadBtn = document.getElementById('downloadLink');

        // Remove any existing event listeners to prevent duplicate downloads
        downloadBtn.replaceWith(downloadBtn.cloneNode(true));
        downloadBtn = document.getElementById('downloadLink');

        // Attach a single event listener for download tracking and execution
        downloadBtn.addEventListener('click', function(event) {
            event.preventDefault();

            let mediaId = images[currentIndex].id; // Get media ID

            // Track download in the database before downloading
            fetch('/track-download', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ media_id: mediaId })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.message); // Log response

                // Proceed with downloading the file
                fetch(imageUrl)
                    .then(response => response.blob())
                    .then(blob => {
                        let link = document.createElement('a');
                        link.href = URL.createObjectURL(blob);
                        link.download = imageName;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    })
                    .catch(error => console.error('Download failed:', error));
            })
            .catch(error => console.error('Error tracking download:', error));
        });

        document.getElementById('imageModal').style.display = 'flex';
    }
        function closeModal() { document.getElementById('imageModal').style.display = 'none'; }
        function prevImage() { if (currentIndex > 0) openModal(currentIndex - 1); }
        function nextImage() { if (currentIndex < images.length - 1) openModal(currentIndex + 1); }
    </script>
</body>
</html>
