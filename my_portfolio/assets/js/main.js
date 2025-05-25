document.addEventListener('DOMContentLoaded', function() {
    console.log('Portfolio loaded!');
    
    // Add fade-in animation to sections
    const sections = document.querySelectorAll('section');
    sections.forEach((section, index) => {
        section.style.animation = `fadeIn 0.5s ease-out ${index * 0.2}s both`;
    });
    
    // Mobile navigation toggle
    const createMobileNav = () => {
        const header = document.querySelector('header');
        
        if (!document.querySelector('.mobile-toggle')) {
            const mobileToggle = document.createElement('div');
            mobileToggle.className = 'mobile-toggle';
            mobileToggle.innerHTML = '☰';
            const nav = document.querySelector('nav');
            
            header.querySelector('.container').insertBefore(mobileToggle, nav);
            
            mobileToggle.addEventListener('click', () => {
                nav.classList.toggle('active');
                mobileToggle.innerHTML = nav.classList.contains('active') ? '✕' : '☰';
            });
            
            const style = document.createElement('style');
            style.textContent = `
                @media screen and (max-width: 768px) {
                    .mobile-toggle {
                        display: block;
                        font-size: 24px;
                        cursor: pointer;
                        color: white;
                    }
                    header .container {
                        flex-direction: row;
                        justify-content: space-between;
                    }
                    nav {
                        display: none;
                        width: 100%;
                        margin-top: 20px;
                    }
                    nav.active {
                        display: block;
                    }
                    nav ul {
                        flex-direction: column;
                        align-items: center;
                    }
                    nav ul li {
                        margin: 10px 0;
                    }
                }
            `;
            document.head.appendChild(style);
        }
    };
    
    // Initialize mobile nav
    createMobileNav();
    
    // Project modal functionality
    const modal = document.getElementById('projectModal');
    const modalContent = document.querySelector('.modal-content');
    const closeModal = document.querySelector('.close-modal');
    
    if (modal) {
        // View details button click handler
        document.querySelectorAll('.view-details').forEach(button => {
            button.addEventListener('click', function() {
                const projectId = this.getAttribute('data-id');
                fetchProjectDetails(projectId);
            });
        });
        
        // Close modal when clicking X
        closeModal.addEventListener('click', () => {
            modal.style.display = 'none';
        });
        
        // Close modal when clicking outside content
        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    }
    
    // Fetch project details via AJAX
    function fetchProjectDetails(projectId) {
        fetch(`get_project.php?id=${projectId}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    const detailsContainer = document.getElementById('projectDetails');
                    detailsContainer.innerHTML = `
                        <h3>${data.title}</h3>
                        <img src="${data.image}" alt="${data.title}"
                             onerror="this.src='assets/images/default-project.jpg'">
                        <div class="project-description">${data.description}</div>
                        ${data.url ? `<div class="project-url">
                            <a href="${data.url}" class="btn btn-primary" target="_blank">Visit Project</a>
                        </div>` : ''}
                    `;
                    modal.style.display = 'block';
                }
            })
            .catch(error => console.error('Error fetching project details:', error));
    }
});