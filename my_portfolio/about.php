<?php $pageTitle = "About Me"; include 'includes/header.php'; ?>

<main>
    <section class="about-section">
        <h2>About Me</h2>
        <div class="about-content">
            <div class="about-image">
    <!-- Professional image with proper sizing -->
    <img src="assets/images/jazz.jpg" alt="Jazfer John Emnace" 
         onerror="this.src='assets/images/default-profile.jpg'"
         style="max-width: 300px; width: 100%; height: auto; object-fit: cover; border-radius: 5px; box-shadow: 0 3px 10px rgba(0,0,0,0.2);">
    <!-- Name and title centered below image -->
    <div style="text-align: center; margin-top: 15px; width: 100%; max-width: 300px;">
        <h4 style="margin-bottom: 5px; font-weight: 600;">Jazfer John Emnace</h4>
        <p style="margin-top: 0; color: #555;">Software & Web Developer</p>
    </div>
</div>
            <div class="about-text">
                <p>Hello! I'm a Software & Web Developer with expertise in creating dynamic and responsive websites and applications. I specialize in PHP, MySQL, HTML, CSS, JavaScript, and WordPress development.</p>
                
                <p>I'm passionate about creating clean, efficient code and providing intuitive user experiences through thoughtful design and robust functionality.</p>
                
                <h3>Education</h3>
                <p>Bachelor of Science in Information Technology<br>
                Stratford International School, General Santos City</p>
                
                <h3>Experience</h3>
                <ul>
                    <li>Software Developer (2024 - 2025)</li>
                    <li>WordPress Developer (2023 - 2024)</li>
                    <li>Web Developer (2022 - 2023)</li>
                </ul>
                
                <div class="professional-footer" style="margin-top: 30px; padding-top: 15px; border-top: 1px solid #eee;">
                    <a href="contact.php" class="btn btn-primary">Get In Touch</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>