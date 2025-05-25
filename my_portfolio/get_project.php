<?php
header('Content-Type: application/json');
require_once 'includes/db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $project = getProjectDetailsForAjax($_GET['id']);
    
    if ($project) {
        echo json_encode($project);
    } else {
        echo json_encode(['error' => 'Project not found']);
    }
} else {
    echo json_encode(['error' => 'Invalid project ID']);
}
?>