<?php
$pageTitle = "Projects";
include 'includes/db.php';
include 'includes/header.php';

// Get all projects from database
$projects = getAllProjects();

// Function to get tech stack logos based on description
function getTechStackLogos($description) {
    $description = strtolower($description);
    $techStack = [];
    
    // Check for different technologies in description
    if (strpos($description, 'php') !== false) {
        $techStack[] = ['name' => 'PHP', 'logo' => 'php.png'];
    }
    if (strpos($description, 'mysql') !== false) {
        $techStack[] = ['name' => 'MySQL', 'logo' => 'mysql.png'];
    }
    if (strpos($description, 'python') !== false) {
        $techStack[] = ['name' => 'Python', 'logo' => 'python.png'];
    }
    if (strpos($description, 'tkinter') !== false) {
        $techStack[] = ['name' => 'Tkinter', 'logo' => 'tkinter.png'];
    }
    if (strpos($description, 'wordpress') !== false) {
        $techStack[] = ['name' => 'WordPress', 'logo' => 'wordpress.png'];
    }
    if (strpos($description, 'javascript') !== false || strpos($description, 'js') !== false) {
        $techStack[] = ['name' => 'JavaScript', 'logo' => 'js.png']; // Changed to match your file
    }
    if (strpos($description, 'html') !== false) {
        $techStack[] = ['name' => 'HTML', 'logo' => 'html.png'];
    }
    if (strpos($description, 'css') !== false) {
        $techStack[] = ['name' => 'CSS', 'logo' => 'css.png'];
    }
    if (strpos($description, 'bootstrap') !== false) {
        $techStack[] = ['name' => 'Bootstrap', 'logo' => 'bootstrap.png'];
    }
    if (strpos($description, 'react') !== false) {
        $techStack[] = ['name' => 'React', 'logo' => 'react.png'];
    }
    if (strpos($description, 'node') !== false) {
        $techStack[] = ['name' => 'Node.js', 'logo' => 'nodejs.png'];
    }
    if (strpos($description, 'gmail') !== false || strpos($description, 'email') !== false) {
        $techStack[] = ['name' => 'Gmail', 'logo' => 'gmail.png'];
    }
    if (strpos($description, 'maps') !== false || strpos($description, 'gps') !== false) {
        $techStack[] = ['name' => 'Maps', 'logo' => 'gps.png'];
    }
    if (strpos($description, 'tools') !== false) {
        $techStack[] = ['name' => 'Tools', 'logo' => 'tools.png'];
    }
    
    // If no specific tech found, add generic ones based on project type
    if (empty($techStack)) {
        $techStack[] = ['name' => 'Web', 'logo' => 'backend.png']; // Using existing image as default
    }
    
    return $techStack;
}
?>

<main>
    <section class="projects-section">
        <h2>My Projects</h2>
        <div class="projects-grid">
            <?php if (!empty($projects)): ?>
                <?php foreach ($projects as $project): ?>
                    <div class="project-card" data-id="<?php echo $project['id']; ?>">
                        <div class="project-image">
                            <?php 
                            // Determine which image to use based on project title or ID
                            $imageFile = '';
                            if (!empty($project['image']) && $project['image'] !== 'NULL') {
                                $imageFile = $project['image'];
                            } else {
                                // Set default images based on project title or ID
                                $projectTitle = strtolower($project['title']);
                                if (strpos($projectTitle, 'tourism') !== false) {
                                    $imageFile = 'tourism.png';
                                } elseif (strpos($projectTitle, 'billing') !== false) {
                                    $imageFile = 'billing.png';
                                } elseif (strpos($projectTitle, 'jrhch') !== false || strpos($projectTitle, 'techcore') !== false) {
                                    $imageFile = 'jrhch.png';
                                } elseif (strpos($projectTitle, 'frontend') !== false) {
                                    $imageFile = 'frontend.png';
                                } elseif (strpos($projectTitle, 'backend') !== false) {
                                    $imageFile = 'backend.png';
                                } else {
                                    $imageFile = 'backend.png'; // Using existing image as default
                                }
                            }
                            ?>
                            <img src="assets/images/<?php echo $imageFile; ?>" 
                                 alt="<?php echo htmlspecialchars($project['title']); ?>"
                                 onerror="this.src='assets/images/backend.png'">
                        </div>
                        <div class="project-info">
                            <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                            
                            <!-- Tech Stack Display -->
                            <div class="tech-stack">
                                <?php 
                                $techStack = getTechStackLogos($project['description']);
                                foreach ($techStack as $tech): 
                                ?>
                                    <div class="tech-item" title="<?php echo $tech['name']; ?>">
                                        <img src="assets/images/<?php echo $tech['logo']; ?>" 
                                             alt="<?php echo $tech['name']; ?>"
                                             onerror="this.src='assets/images/tools.png'">
                                        <span><?php echo $tech['name']; ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <div class="project-actions">
                                <?php if (!empty($project['url']) && $project['url'] !== 'NULL'): ?>
                                    <a href="<?php echo htmlspecialchars($project['url']); ?>" class="btn btn-small btn-primary" 
                                       target="_blank">Visit Project</a>
                                <?php endif; ?>
                                <button class="btn btn-small btn-secondary view-details" 
                                        data-id="<?php echo $project['id']; ?>"
                                        data-title="<?php echo htmlspecialchars($project['title']); ?>"
                                        data-description="<?php echo htmlspecialchars($project['description']); ?>"
                                        data-image="<?php echo htmlspecialchars($imageFile); ?>"
                                        data-url="<?php echo htmlspecialchars($project['url'] ?? ''); ?>"
                                        data-tech="<?php echo htmlspecialchars(json_encode($techStack)); ?>">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="no-projects">No projects found. Check back soon!</p>
            <?php endif; ?>
        </div>
    </section>
    
    <!-- Project Details Modal -->
    <div id="projectModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div id="projectDetails">
                <div class="project-detail-header">
                    <h2 id="modalTitle"></h2>
                </div>
                <div class="project-detail-image">
                    <img id="modalImage" src="" alt="" />
                </div>
                <div class="project-detail-content">
                    <div class="project-description">
                        <h3>Description</h3>
                        <p id="modalDescription"></p>
                    </div>
                    <div class="project-tech-stack">
                        <h3>Technologies Used</h3>
                        <div id="modalTechStack" class="tech-stack-modal">
                            <!-- Tech stack will be loaded here via JavaScript -->
                        </div>
                    </div>
                    <div class="project-links" id="modalLinks" style="display: none;">
                        <a id="modalProjectLink" href="" target="_blank" class="btn btn-primary">Visit Project</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
/* Projects Grid */
.projects-section {
    padding: 40px 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.projects-section h2 {
    text-align: center;
    margin-bottom: 40px;
    font-size: 2.5em;
    color: #333;
}

.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 30px;
    padding: 20px 0;
}

.project-card {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

.project-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.project-image {
    height: 200px;
    overflow: hidden;
    background: #f8f9fa;
}

.project-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.project-card:hover .project-image img {
    transform: scale(1.05);
}

.project-info {
    padding: 20px;
}

.project-info h3 {
    margin: 0 0 15px 0;
    font-size: 1.3em;
    color: #333;
    font-weight: 600;
}

/* Tech Stack Styles */
.tech-stack {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 20px;
    min-height: 60px;
    align-items: flex-start;
}

.tech-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 8px;
    background: #f8f9fa;
    border-radius: 8px;
    border: 1px solid #e9ecef;
    transition: all 0.3s ease;
    min-width: 60px;
}

.tech-item:hover {
    background: #e9ecef;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.tech-item img {
    width: 24px;
    height: 24px;
    object-fit: contain;
    margin-bottom: 4px;
}

.tech-item span {
    font-size: 0.7em;
    color: #666;
    font-weight: 500;
    text-align: center;
    line-height: 1.2;
}

/* Tech Stack in Modal */
.tech-stack-modal {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 20px;
}

.tech-stack-modal .tech-item {
    min-width: 80px;
    padding: 12px;
}

.tech-stack-modal .tech-item img {
    width: 32px;
    height: 32px;
    margin-bottom: 6px;
}

.tech-stack-modal .tech-item span {
    font-size: 0.8em;
}

.project-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.btn {
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    text-decoration: none;
    font-size: 0.9em;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-block;
    text-align: center;
}

.btn-small {
    padding: 6px 12px;
    font-size: 0.85em;
}

.btn:hover {
    transform: translateY(-1px);
}

.btn-primary {
    background: #007bff;
    color: white;
}

.btn-primary:hover {
    background: #0056b3;
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #545b62;
}

.no-projects {
    text-align: center;
    color: #666;
    font-size: 1.1em;
    grid-column: 1 / -1;
    padding: 40px;
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.8);
    animation: fadeIn 0.3s ease;
}

.modal-content {
    background-color: #fff;
    margin: 2% auto;
    padding: 0;
    border-radius: 12px;
    width: 90%;
    max-width: 800px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    animation: slideIn 0.3s ease;
}

.close-modal {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    right: 20px;
    top: 15px;
    z-index: 1001;
    cursor: pointer;
    background: rgba(255, 255, 255, 0.9);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.close-modal:hover,
.close-modal:focus {
    color: #000;
    background: rgba(255, 255, 255, 1);
    transform: scale(1.1);
}

.project-detail-header {
    padding: 30px 30px 20px;
    border-bottom: 1px solid #eee;
}

.project-detail-header h2 {
    margin: 0;
    color: #333;
    font-size: 2em;
    font-weight: 600;
}

.project-detail-image {
    padding: 0;
    text-align: center;
    background: #f8f9fa;
}

.project-detail-image img {
    width: 100%;
    height: 300px;
    object-fit: cover;
    display: block;
}

.project-detail-content {
    padding: 30px;
}

.project-description,
.project-tech-stack {
    margin-bottom: 25px;
}

.project-detail-content h3 {
    color: #333;
    font-size: 1.3em;
    margin-bottom: 15px;
    font-weight: 600;
    border-bottom: 2px solid #007bff;
    padding-bottom: 8px;
}

.project-detail-content p {
    color: #666;
    line-height: 1.6;
    font-size: 1em;
}

.project-links {
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.project-links .btn {
    display: inline-block;
    padding: 12px 24px;
    background: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-weight: 500;
    transition: background 0.3s ease;
}

.project-links .btn:hover {
    background: #0056b3;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { 
        opacity: 0;
        transform: translateY(-50px);
    }
    to { 
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .projects-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .project-card {
        margin: 0 10px;
    }
    
    .tech-stack {
        gap: 6px;
    }
    
    .tech-item {
        min-width: 50px;
        padding: 6px;
    }
    
    .tech-item img {
        width: 20px;
        height: 20px;
    }
    
    .tech-item span {
        font-size: 0.65em;
    }
    
    .modal-content {
        width: 95%;
        margin: 5% auto;
        max-height: 85vh;
    }
    
    .project-detail-header,
    .project-detail-content {
        padding: 20px;
    }
    
    .project-detail-header h2 {
        font-size: 1.5em;
    }
    
    .project-detail-image img {
        height: 200px;
    }
    
    .tech-stack-modal {
        gap: 8px;
    }
    
    .tech-stack-modal .tech-item {
        min-width: 60px;
        padding: 8px;
    }
    
    .tech-stack-modal .tech-item img {
        width: 24px;
        height: 24px;
    }
}

@media (max-width: 480px) {
    .projects-section {
        padding: 20px 10px;
    }
    
    .projects-section h2 {
        font-size: 2em;
    }
    
    .project-actions {
        flex-direction: column;
    }
    
    .btn {
        text-align: center;
    }
    
    .tech-stack {
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('projectModal');
    const closeModal = document.querySelector('.close-modal');
    const viewDetailsButtons = document.querySelectorAll('.view-details');
    
    // Open modal when "View Details" is clicked
    viewDetailsButtons.forEach(button => {
        button.addEventListener('click', function() {
            const title = this.getAttribute('data-title');
            const description = this.getAttribute('data-description');
            const image = this.getAttribute('data-image');
            const url = this.getAttribute('data-url');
            const techData = this.getAttribute('data-tech');
            
            // Update modal content
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalDescription').textContent = description;
            
            // Set image
            const modalImage = document.getElementById('modalImage');
            if (image && image.trim() !== '' && image !== 'NULL') {
                modalImage.src = `assets/images/${image}`;
                modalImage.alt = title;
                modalImage.onerror = function() {
                    this.src = 'assets/images/backend.png';
                };
            } else {
                modalImage.src = 'assets/images/backend.png';
                modalImage.alt = title;
            }
            
            // Set tech stack
            const modalTechStack = document.getElementById('modalTechStack');
            modalTechStack.innerHTML = '';
            
            if (techData) {
                try {
                    const techStack = JSON.parse(techData);
                    techStack.forEach(tech => {
                        const techItem = document.createElement('div');
                        techItem.className = 'tech-item';
                        techItem.title = tech.name;
                        
                        techItem.innerHTML = `
                            <img src="assets/images/${tech.logo}" 
                                 alt="${tech.name}"
                                 onerror="this.src='assets/images/tools.png'">
                            <span>${tech.name}</span>
                        `;
                        
                        modalTechStack.appendChild(techItem);
                    });
                } catch (e) {
                    console.error('Error parsing tech data:', e);
                }
            }
            
            // Show/hide project link
            const linksSection = document.getElementById('modalLinks');
            const projectLink = document.getElementById('modalProjectLink');
            if (url && url.trim() !== '' && url !== 'NULL') {
                projectLink.href = url;
                linksSection.style.display = 'block';
            } else {
                linksSection.style.display = 'none';
            }
            
            // Show modal
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });
    });
    
    // Close modal when X is clicked
    closeModal.addEventListener('click', function() {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    });
    
    // Close modal when clicking outside of it
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && modal.style.display === 'block') {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });
});
</script>

<?php include 'includes/footer.php'; ?>