 <!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=PT+Serif:wght@700&display=swap" rel="stylesheet">
    <title>Our Collections</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/search-results.css')}}">
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
            <source src="{{ asset('videos/about-video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="about-overlay">
            <h2 class="about-title">OUR COLLECTIONS</h2>
        </div>
    </section>
    <section class="video-grid">
        <div class="media-grid">
            @forelse ($mediaItems as $index => $media)
                <div class="media-container" onclick="openModal({{ $index }})">
                    @if($media->type === 'video')
                        <div class="loader"></div>
                        <iframe id="video{{ $index }}" width="320" height="240" 
                            src="https://drive.google.com/file/d/{{ $media->google_id }}/preview" 
                            frameborder="0" 
                            allowfullscreen 
                            onload="hideLoader(this)"></iframe>
                    @elseif($media->type === 'audio')
                        <audio controls oncanplaythrough="hideLoader(this)">
                            <source src="https://drive.google.com/uc?export=view&id={{ $media->google_id }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    @else
                        <img src="https://lh3.googleusercontent.com/d/{{ $media->google_id }}=w1200-h800" alt="{{ $media->name }}">
                    @endif
                    <div class="overlay">
                        <p>{{ $media->name }}</p>
                        <div class="circle">+</div>
                    </div>
                </div>
                @empty
    <div class="no-media-container">
        <div class="no-media-image"></div>
        <h2 class="no-media-title">Oops! No media available.</h2>
        <p class="no-media-text">
            It looks like there are no items in this category right now. <br>
            Check back later or explore other galleries!
        </p>
        <a href="/" class="back-home-btn">Go Back to Home</a>
    </div>
@endforelse

        </div>
    </section>
    
    <section class="modal" id="mediaModal">
        <button class="close" onclick="closeModal()">&times;</button>
        <button class="close" onclick="closeModal()">&times;</button>
        <button class="prev" onclick="prevMedia()">&#10094;</button>
        <button class="next" onclick="nextMedia()">&#10095;</button>
        <div class="modal-content" style="display: flex; align-items: center; gap: 20px;">
            <div class="modal-preview">
                <iframe id="modalVideo" width="800" height="450" frameborder="0" allowfullscreen style="display: none;"></iframe>
                <audio id="modalAudio" controls style="display: none;"></audio>
                <img id="modalImage" src="" alt="Preview" style="max-width: 800px; max-height: 600px; display: none;">
            </div>
            <div class="modal-details">
                <h2 id="modalTitle"></h2>
                <p id="modalDetails"></p>
                <a id="downloadLink" class="download-btn" download onclick="downloadMedia(event)">DOWNLOAD</a>
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
    let mediaItems = @json($mediaItems);
    let currentIndex = 0;

    function hideLoader(element) {
        let loader = element.closest('.media-container')?.querySelector('.loader');
        if (loader) loader.style.display = 'none';
    }

    function openModal(index) {
        currentIndex = index;
        const mediaItem = mediaItems[index];

        document.getElementById('modalTitle').innerText = mediaItem.name;
        document.getElementById('modalDetails').innerHTML = `
            <div class="modal-info">
                <p><strong>Type:</strong> ${mediaItem.type}</p>
                <p><strong>Uploaded By:</strong> ${mediaItem.user ? `${mediaItem.user.first} ${mediaItem.user.last}` : 'Unknown'}</p>
                <p><strong>Email:</strong> <a href="mailto:${mediaItem.user ? mediaItem.user.email : ''}">${mediaItem.user ? mediaItem.user.email : 'N/A'}</a></p>
                <p><strong>Uploaded On:</strong> ${new Date(mediaItem.created_at).toLocaleDateString()}</p>
            </div>
        `;

        // Reset modal display
        document.getElementById('modalVideo').style.display = 'none';
        document.getElementById('modalAudio').style.display = 'none';
        document.getElementById('modalImage').style.display = 'none';

        let mediaUrl;

        if (mediaItem.type === 'image') {
            mediaUrl = `https://lh3.googleusercontent.com/d/${mediaItem.google_id}=w1200-h800`;
            document.getElementById('modalImage').src = mediaUrl;
            document.getElementById('modalImage').style.display = 'block';
        } 
        else if (mediaItem.type === 'video') {
            mediaUrl = `https://drive.google.com/file/d/${mediaItem.google_id}/preview`;
            let videoElement = document.getElementById('modalVideo');
            videoElement.src = mediaUrl;
            videoElement.style.display = 'block';

           
        } 
        else if (mediaItem.type === 'audio') {
            mediaUrl = `https://drive.google.com/uc?export=view&id=${mediaItem.google_id}`;
            let audioElement = document.getElementById('modalAudio');
            audioElement.src = mediaUrl;
            audioElement.style.display = 'block';

            
        }

        document.getElementById('downloadLink').onclick = function(event) {
            event.preventDefault();
            downloadMedia(mediaItem.google_id, mediaItem.name, mediaItem.type);
        };

        document.getElementById('mediaModal').style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('modalVideo').src = "";
        document.getElementById('modalAudio').src = "";
        document.getElementById('modalImage').src = "";
        document.getElementById('mediaModal').style.display = 'none';
    }
    function prevMedia() { if (currentIndex > 0) openModal(currentIndex - 1); }
        function nextMedia() { if (currentIndex < mediaItems.length - 1) openModal(currentIndex + 1); }

        function downloadMedia(fileId, fileName, fileType) {
    let formattedFileName = fileName.replace(/\s+/g, '_') + '.' + (fileType === 'image' ? 'jpg' : fileType === 'video' ? 'mp4' : 'mp3');
    let mediaUrl = `https://drive.google.com/uc?export=download&id=${fileId}`;
    
    let mediaId = mediaItems[currentIndex]?.id;
    if (!mediaId) {
        console.error('Error: No media ID found.');
        return;
    }

    // Prevent multiple tracking requests
    if (downloadMedia.called) return;
    downloadMedia.called = true; // Flag to prevent duplicate calls

    // Track download in the database
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
        console.log(`Download tracked for ${fileType}: ${fileName}`);

        // Proceed with downloading the file
        let link = document.createElement('a');
        link.href = mediaUrl;
        link.download = formattedFileName;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        // Reset flag after short delay (prevents duplicate downloads on multiple modal openings)
        setTimeout(() => {
            downloadMedia.called = false;
        }, 1000);
    })
    .catch(error => {
        console.error(`Error tracking ${fileType} download:`, error);
        downloadMedia.called = false; // Reset flag if an error occurs
    });
}

// Ensure the download button is only bound ONCE
document.addEventListener('DOMContentLoaded', function() {
    let downloadBtn = document.getElementById('downloadLink');

    // Remove existing event listeners before adding a new one (prevents duplication)
    downloadBtn.replaceWith(downloadBtn.cloneNode(true));
    downloadBtn = document.getElementById('downloadLink');

    downloadBtn.addEventListener('click', function(event) {
        event.preventDefault();
        let mediaItem = mediaItems[currentIndex];
        if (!mediaItem) {
            console.error('Error: No media item found.');
            return;
        }
        downloadMedia(mediaItem.google_id, mediaItem.name, mediaItem.type);
    });
});

    
</script>




</body>
</html>
