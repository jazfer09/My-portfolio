<?php
$pageTitle = "Contact Me";
include 'includes/db.php';
include 'includes/header.php';

$message = '';
$messageType = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $userMessage = htmlspecialchars($_POST['message']);
    
    // Basic validation
    if (empty($name) || empty($email) || empty($userMessage)) {
        $message = "Please fill in all fields";
        $messageType = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address";
        $messageType = "error";
    } else {
        // Save message to database
        if (saveMessage($name, $email, $userMessage)) {
            $message = "Thank you, $name! Your message has been sent successfully.";
            $messageType = "success";
            // Clear form data after successful submission
            $name = $email = $userMessage = '';
        } else {
            $message = "Sorry, there was an error sending your message. Please try again.";
            $messageType = "error";
        }
    }
}
?>

<main>
    <section class="contact-section">
        <h2>Contact Me</h2>
        
        <?php if (!empty($message)): ?>
            <div class="message <?php echo $messageType; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <div class="contact-container">
            <div class="contact-info">
                <h3>Get In Touch</h3>
                <p>I'm always interested in new projects and opportunities. Feel free to reach out to me with any questions or inquiries.</p>
                
                <div class="contact-details">
                    <div class="contact-item">
                        <img src="assets/images/gmail.png" alt="Email" class="contact-icon">
                        <span class="text">jazferjohnemnace@gmail.com</span>
                    </div>
                    <div class="contact-item">
                        <img src="assets/images/phone-call.png" alt="Phone" class="contact-icon">
                        <span class="text">+993 436 9169</span>
                    </div>
                    <div class="contact-item">
                        <img src="assets/images/gps.png" alt="Location" class="contact-icon">
                        <span class="text">Zone 1 Block 10, Barangay Fatima, General Santos City, Philippines</span>
                    </div>
                </div>
                
                <!-- Single Map Section -->
                <div class="maps-section">
                    <h3>Find Us</h3>
                    <p>We are located at Zone 1 Block 10, Barangay Fatima, General Santos City, Philippines.</p>
                    
                    <!-- Single Map for Specific Location -->
                    <div class="map-container">
                        <div class="map-item">
                            <h4>Our Location</h4>
                            <div class="map">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.000143555683!2d125.17213567398535!3d6.261694093749258!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f8003ea77308e7%3A0x5bb3f9f6232f55ea!2sFatima%2C%20General%20Santos%20City%2C%20South%20Cotabato!5e0!3m2!1sen!2sph!4v1716298166384!5m2!1sen!2sph" 
                                    width="100%" 
                                    height="400" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="contact-form">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" 
                               value="<?php echo isset($name) ? $name : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" 
                               value="<?php echo isset($email) ? $email : ''; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required><?php echo isset($userMessage) ? $userMessage : ''; ?></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </section>
</main>

<style>
.contact-section {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.contact-container {
    display: flex;
    gap: 2rem;
    margin-top: 2rem;
}

.contact-info {
    flex: 1;
    padding: 1rem;
}

.contact-form {
    flex: 1;
    padding: 1rem;
}

.contact-details {
    margin: 2rem 0;
}

.contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 1.5rem;
}

.contact-icon {
    width: 24px;
    height: 24px;
    margin-right: 15px;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: bold;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 1rem;
}

.btn-primary {
    background-color: #007bff;
    color: white;
    padding: 0.8rem 1.5rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1rem;
    transition: background-color 0.3s;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.message {
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: 4px;
}

.message.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.message.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.maps-section {
    margin-top: 2rem;
}

.map-container {
    margin-top: 1rem;
}

.map-item {
    border: 1px solid #ddd;
    border-radius: 5px;
    overflow: hidden;
}

.map-item h4 {
    background-color: #f8f8f8;
    padding: 10px 15px;
    margin: 0;
    border-bottom: 1px solid #ddd;
}

.map {
    width: 100%;
    height: 400px;
}

@media (max-width: 768px) {
    .contact-container {
        flex-direction: column;
    }
}
</style>

<?php include 'includes/footer.php'; ?>