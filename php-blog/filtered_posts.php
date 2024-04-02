<?php 
require_once('config.php');
require_once('includes/public_functions.php'); 
require_once('includes/head_section.php'); 

if(isset($_GET["topic"])){
    $topic_id =$_GET["topic"];
    $posts = getPublishedPostsByTopic($topic_id);
}
?>

        <title>LifeBlog | Home </title>
</head>
<body>
<?php require_once('includes/header.php');
 ?>
<div class="container">
    <div class="content">
        <h2 class="content-title">All articles in <?php getTopicNameById($topic_id) ?> </h2>
        <?php foreach($posts as $post): ?>
                                        <div class="post">
                                                        <img src="<?= BASE_URL . 'static/images/' . $post['image']; ?>" alt="<?= $post['title']; ?>" class="post_image"> 
                                                <a href="single_post.php?post-slug=<?= $post['slug']; ?>">
                                                        <h3><?= $post['title']; ?></h3>
                                                        <div class="info">
                                                                <span><?= date( 'F j, Y ' , strtotime($post['created_at'])); ?></span>
                                                                <span class="read_more">Read more...</span>
                                                        </div>
                                                </a>
                                        </div>
                                <?php endforeach; ?>
    </div>
</div>


<?php require_once('includes/footer.php'); ?>
</body>
</html>