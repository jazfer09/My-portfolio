<?php
$pageTitle = "Home";
include 'includes/header.php';
?>

<main>
    <section class="hero">
        <div class="hero-content">
            <h2>Welcome to my Portfolio</h2>
            <p>Hello! I'm <span class="highlight">Jazfer John Emnace</span>, a passionate web developer.</p>
            <p>I create modern, responsive web applications using PHP, MySQL, HTML, CSS, and JavaScript.</p>
            <div class="cta-buttons">
                <a href="projects.php" class="btn btn-primary">View My Projects</a>
                <a href="contact.php" class="btn btn-secondary">Contact Me</a>
            </div>
        </div>
    </section>

    <section class="skills">
        <div class="container">
            <h2>My Skills</h2>
            <div class="skills-container">
                <div class="skill-item" id="frontend-card">
                    <div class="skill-image">
                        <img src="assets/images/frontend.png" alt="Front-end Development">
                    </div>
                    <h3>Front-end</h3>
                    <ul>
                        <li>HTML5</li>
                        <li>CSS3</li>
                        <li>JavaScript</li>
                        <li>Responsive Design</li>
                    </ul>
                </div>
                <div class="skill-item" id="backend-card">
                    <div class="skill-image">
                        <img src="assets/images/backend.png" alt="Back-end Development">
                    </div>
                    <h3>Back-end</h3>
                    <ul>
                        <li>PHP</li>
                        <li>MySQL</li>
                        <li>RESTful APIs</li>
                        <li>Server Management</li>
                    </ul>
                </div>
                <div class="skill-item" id="tools-card">
                    <div class="skill-image">
                        <img src="assets/images/tools.png" alt="Development Tools">
                    </div>
                    <h3>Tools</h3>
                    <ul>
                        <li>Git</li>
                        <li>VS Code</li>
                        <li>XAMPP</li>
                        <li>Figma</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Image Modal for Zoom -->
    <div id="imageModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img id="modalImage" src="" alt="">
            <div class="modal-caption"></div>
        </div>
    </div>
</main>

<style>
/* Additional styles for skill cards with images */
.skill-item {
    position: relative;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    transition: transform 0.6s ease, box-shadow 0.3s ease;
    overflow: hidden;
    margin: 15px;
    perspective: 1000px;
    transform-style: preserve-3d;
}

.skill-image {
    position: relative;
    width: 100%;
    height: 160px;
    margin-bottom: 15px;
    overflow: hidden;
    border-radius: 5px;
    cursor: pointer;
}

.skill-image img {
    width: 100%;
    height: 100%;
    object-fit: contain; /* Changed from cover to contain to preserve aspect ratio */
    object-position: center;
    transition: transform 0.3s ease;
    background-color: #f8f9fa; /* Light background to fill empty space */
}

.skill-image:hover img {
    transform: scale(1.05);
}

/* Zoom overlay that appears on hover */
.zoom-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.skill-image:hover .zoom-overlay {
    opacity: 1;
}

.zoom-text {
    color: white;
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.skills-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

/* Modal styles for image zoom */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    animation: fadeIn 0.3s ease;
}

.modal-content {
    position: relative;
    margin: auto;
    padding: 20px;
    width: 90%;
    max-width: 800px;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.modal-content img {
    max-width: 100%;
    max-height: 80%;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
}

.close {
    position: absolute;
    top: 20px;
    right: 30px;
    color: #fff;
    font-size: 40px;
    font-weight: bold;
    cursor: pointer;
    z-index: 1001;
    transition: color 0.3s ease;
}

.close:hover {
    color: #ccc;
}

.modal-caption {
    color: white;
    text-align: center;
    margin-top: 20px;
    font-size: 18px;
    font-weight: 500;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes fadeOut {
    from { opacity: 1; }
    to { opacity: 0; }
}

.modal.fade-out {
    animation: fadeOut 0.3s ease;
}

@media (max-width: 768px) {
    .skills-container {
        flex-direction: column;
    }
    
    .skill-item {
        width: 100%;
        margin: 10px 0;
    }
    
    .modal-content {
        width: 95%;
        padding: 10px;
    }
    
    .close {
        top: 10px;
        right: 20px;
        font-size: 30px;
    }
    
    .modal-caption {
        font-size: 16px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all skill cards
    const cards = document.querySelectorAll('.skill-item');
    
    // Add 3D tilt effect to each card
    cards.forEach(card => {
        // Mouse enter event
        card.addEventListener('mousemove', handleMouseMove);
        
        // Mouse leave event - reset card position
        card.addEventListener('mouseleave', function() {
            card.style.transform = 'rotateY(0deg) rotateX(0deg)';
            card.style.transition = 'transform 0.6s ease';
            
            // Reset image transform
            const image = card.querySelector('.skill-image img');
            if (image) {
                image.style.transform = '';
            }
        });
    });
    
    function handleMouseMove(e) {
        const card = this;
        const cardRect = card.getBoundingClientRect();
        
        // Calculate mouse position relative to card center
        const cardCenterX = cardRect.left + cardRect.width / 2;
        const cardCenterY = cardRect.top + cardRect.height / 2;
        
        // Calculate distance from center (as percentage)
        const deltaX = (e.clientX - cardCenterX) / (cardRect.width / 2);
        const deltaY = (e.clientY - cardCenterY) / (cardRect.height / 2);
        
        // Maximum rotation angle
        const maxRotation = 10;
        
        // Apply rotation based on mouse position
        card.style.transition = 'transform 0.1s ease';
        card.style.transform = `rotateY(${deltaX * maxRotation}deg) rotateX(${-deltaY * maxRotation}deg)`;
    }
    
    // Image zoom functionality
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    const captionText = document.querySelector('.modal-caption');
    const closeBtn = document.querySelector('.close');
    const zoomableImages = document.querySelectorAll('.zoomable-image');
    
    // Add click event to all zoomable images
    zoomableImages.forEach(img => {
        img.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent event bubbling
            modal.style.display = 'block';
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        });
    });
    
    // Close modal when clicking the X
    closeBtn.addEventListener('click', closeModal);
    
    // Close modal when clicking outside the image
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display === 'block') {
            closeModal();
        }
    });
    
    function closeModal() {
        modal.classList.add('fade-out');
        setTimeout(() => {
            modal.style.display = 'none';
            modal.classList.remove('fade-out');
        }, 300);
    }
});
</script>

<?php include 'includes/footer.php'; ?>