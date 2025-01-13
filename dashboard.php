<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signout'])) {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit();
}

// Handling the posting form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_submit'])) {
    $post_content = $_POST['post_content'];
    if (!empty($post_content)) {
        include('db_connect.php');
        $stmt = $conn->prepare("INSERT INTO posts (user_id, content) VALUES (?, ?)");
        $stmt->execute([$_SESSION['user_id'], $post_content]);
        header('Location: dashboard.php');
        exit();
    } else {
        echo "<script>alert('Post content cannot be empty!');</script>";
    }
}

// Fetch posts from the database
include('db_connect.php');
$stmt = $conn->prepare("SELECT * FROM posts WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$posts = $stmt->fetchAll();

// Handling post update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_post'])) {
    $updated_content = $_POST['edit_content'];
    $post_id = $_POST['post_id'];

    if (!empty($updated_content)) {
        $stmt = $conn->prepare("UPDATE posts SET content = ? WHERE id = ?");
        $stmt->execute([$updated_content, $post_id]);
        header('Location: dashboard.php');
        exit();
    } else {
        echo "<script>alert('Post content cannot be empty!');</script>";
    }
}

// Handling post delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_post'])) {
    $post_id = $_POST['post_id'];

    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$post_id]);
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Arial, sans-serif';
            background-color: rgb(0, 33, 48);
            text-align: center;
        }
        .dashboard-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            padding: 20px;
            flex-wrap: wrap;
        }
        .container {
            padding: 16px;
            background-color: rgb(255, 255, 255);
            width: 90%;  
            max-width: 400px; 
            margin: 20px auto;    
            border-radius: 8px;
        }
        .profile-container {
            padding: 16px;
            background-color: #f1f1f1;
            border-radius: 8px;
            width: 300px;
            text-align: center;
            height: 508px;
        }
        h1 {
            color: #2c56e0;
            margin-top: 20px;
        }
        
        .dashboardbtn, .player-info-btn {
            flex: 1;
            background-color: #458cdd;
            color: white;
            padding: 10px;
            border: none;
            width: 100px;
            margin-top: 10px;
            border-radius: 8px;
            cursor: pointer;
        }
        .dashboardbtn:hover, .player-info-btn:hover {
            background-color: #3578d4;
        }
        .profile-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #2c56e0;
            color: white;
            font-size: 30px;
            margin-bottom: 16px;
            display: inline-block;
            line-height: 60px;
            text-align: center;
        }
        .textarea {
            width: 100%;
            height: 100px;
            border-radius: 8px;
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 16px;
        }
        .post-submit-btn {
            display: block;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin: 10px auto 0;
        }
        .post-submit-btn:hover {
            background-color: #218838;
        }
        .post-container {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: left;
            max-height: 500px; /* Set a fixed height */
            overflow-y: auto;  /* Make it scrollable */
        }

        .posts-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        .post {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            width: 80%;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
        }

        .post-buttons {
            display: flex;
            gap: 10px;
        }

        .post-button {
            background-color: #4CAF50;
            color: white;
            height: 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .post-button:hover {
            background-color: #45a049;
        }

        .delete-button {
            background-color: #f44336;
        }

        .delete-button:hover {
            background-color: #e53935;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
        }

        .modal button {
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h1>Welcome to Your Dashboard</h1>

<div class="dashboard-container">
    <!-- Profile Info -->
    <div class="profile-container">
        <h3>Your Profile</h3>
        <div class="profile-icon">
            <?php echo strtoupper(substr($firstname, 0, 1)); ?>
        </div>
        <p><?php echo $firstname . " " . $lastname; ?></p>
        <div class="button-container">
            <button class="player-info-btn" onclick="window.location.href='player_info.php'">Player Info</button>
            <form method="POST" style="flex: 1;">
                <button type="submit" name="signout" class="dashboardbtn">Sign Out</button>
            </form>
        </div>
    </div>

    <!-- Post Container with Form and Post List -->
    <div class="post-container">
        <h3>Post Your Insights</h3>
        <form method="POST">
            <textarea name="post_content" placeholder="What's on your mind?"></textarea>
            <button type="submit" name="post_submit" class="post-submit-btn">Post</button>
        </form>

        <!-- Displaying All Posts in the Same Container -->
        <div class="posts-container">
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <p><?php echo htmlspecialchars($post['content']); ?></p>
                    <div class="post-buttons">
                        <button class="post-button" onclick="showEditModal(<?php echo $post['id']; ?>, '<?php echo htmlspecialchars($post['content']); ?>')">Update</button>
                        <form method="POST" style="display: inline;">
                            <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                            <button type="submit" name="delete_post" class="post-button delete-button">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Modal for editing post -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3>Edit Post</h3>
            <form method="POST">
                <textarea id="editPostContent" name="edit_content" placeholder="Edit your post here..."></textarea>
                <input type="hidden" id="post_id" name="post_id">
                <button type="submit" name="edit_post" class="post-submit-btn">Update Post</button>
            </form>
            <button onclick="closeModal()">Close</button>
        </div>
    </div>
</div>

<script>
    // Show the modal with the content for editing
    function showEditModal(postId, postContent) {
        document.getElementById('editModal').style.display = 'flex';
        document.getElementById('editPostContent').value = postContent;
        document.getElementById('post_id').value = postId;
    }

    // Close the modal
    function closeModal() {
        document.getElementById('editModal').style.display = 'none';
    }
</script>

</body>
</html>
