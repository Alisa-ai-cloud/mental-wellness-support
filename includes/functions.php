<?php
/**
 * Helper Functions
 */

function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function sanitize_email($email) {
    return filter_var($email, FILTER_SANITIZE_EMAIL);
}

function validate_phone($phone) {
    $phone = preg_replace('/[^0-9\+\-]/', '', $phone);
    return strlen($phone) >= 10 ? $phone : false;
}

function get_file_extension($filename) {
    return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
}

function generate_slug($string) {
    return strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $string), '-'));
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function send_email($to, $subject, $message, $headers = []) {
    $default_headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=UTF-8\r\n";
    $default_headers .= "From: " . SUPPORT_EMAIL . "\r\n";
    
    $headers = array_merge(['From' => SUPPORT_EMAIL], $headers);
    $header_string = $default_headers;
    
    foreach ($headers as $key => $value) {
        if ($key !== 'From') {
            $header_string .= $key . ": " . $value . "\r\n";
        }
    }

    return mail($to, $subject, $message, $header_string);
}

function handle_file_upload($file, $upload_dir, $allowed_types = ['jpg', 'jpeg', 'png', 'pdf']) {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'Upload error'];
    }

    if ($file['size'] > MAX_UPLOAD_SIZE) {
        return ['success' => false, 'message' => 'File too large'];
    }

    $ext = get_file_extension($file['name']);
    if (!in_array($ext, $allowed_types)) {
        return ['success' => false, 'message' => 'Invalid file type'];
    }

    $filename = uniqid() . '.' . $ext;
    $filepath = $upload_dir . $filename;

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        return ['success' => true, 'filename' => $filename, 'path' => $filepath];
    }

    return ['success' => false, 'message' => 'Upload failed'];
}

function get_all_doctors($db) {
    $result = $db->query("SELECT id, full_name, specialty, experience_years, consultation_fee, rating, profile_image, bio FROM doctors WHERE status = 'active' ORDER BY rating DESC");
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function get_services($db) {
    $result = $db->query("SELECT * FROM services WHERE status = 'active' ORDER BY id ASC");
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function get_testimonials($db) {
    $result = $db->query("SELECT * FROM testimonials WHERE status = 'active' ORDER BY created_at DESC LIMIT 6");
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function get_faqs($db, $category = null) {
    if ($category) {
        $stmt = $db->prepare("SELECT * FROM faqs WHERE status = 'active' AND category = ? ORDER BY id ASC");
        $stmt->bind_param("s", $category);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    $result = $db->query("SELECT * FROM faqs WHERE status = 'active' ORDER BY id ASC");
    return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function format_date($date) {
    return date('M d, Y', strtotime($date));
}

function format_time($time) {
    return date('h:i A', strtotime($time));
}

function get_specialty_label($specialty) {
    $specialties = [
        'psychologist' => 'Psychologist',
        'psychiatrist' => 'Psychiatrist',
        'counselor' => 'Counselor',
        'general_physician' => 'General Physician',
        'wellness_coach' => 'Wellness Coach'
    ];
    return $specialties[$specialty] ?? $specialty;
}
