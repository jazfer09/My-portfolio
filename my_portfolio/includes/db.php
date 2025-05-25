<?php
require_once 'config.php';

// Get all projects from database
function getAllProjects() {
    global $conn;
    $projects = [];
    
    $stmt = $conn->prepare("SELECT * FROM projects ORDER BY created_at DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    
    while($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
    
    $stmt->close();
    return $projects;
}

// Get a single project by ID
function getProjectById($id) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $project = $result->fetch_assoc();
    $stmt->close();
    
    return $project ?: null;
}

// Save contact message to database
function saveMessage($name, $email, $message) {
    global $conn;
    
    $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $message);
    $result = $stmt->execute();
    $stmt->close();
    
    return $result;
}

// Get project details for AJAX request
function getProjectDetailsForAjax($id) {
    $project = getProjectById($id);
    
    if ($project) {
        return [
            'title' => htmlspecialchars($project['title']),
            'description' => nl2br(htmlspecialchars($project['description'])),
            'image' => $project['image'] ? 'assets/images/projects/' . htmlspecialchars($project['image']) : 'assets/images/default-project.jpg',
            'url' => $project['url'] ? htmlspecialchars($project['url']) : null
        ];
    }
    
    return null;
}
?>