<?php 
require_once('config.php');
require_once('includes/public_functions.php'); 
require_once('includes/head_section.php'); 

if(isset($_GET["posts-slug"])){
    $post_slug =$_GET["post-slug"];
    $post = getPost($post_slug);
    $topics = getAllTopics();
    var_dump($opics);}
?>
        <title>LifeBlog | <?= $post[0]['title'] ?> </title>
</head>
<body>
<?php require_once('includes/header.php');?>



<div class="container">
    <div class="content">
        <div class="post-wrapper">
            <div class="full-post-div">
                <?php if($post['published'] == false){?>
                    <h2 class="post-title">Sorry...This post has not been published</h2>
                <?php } else{ ?>
                    <h2 class="post title"><?=$post['title']?></h2>
                    <div class="post-body-div"><?=$post['body']?></div>
                    <?php } ?>
            </div>
        </div>
        <div class="post-sidebar">
            <div class="card">
                <div class="card-header">
                    <h2>Topics</h2>
                </div>
                <div class="card-content">
                    <?php foreach($topics as $topic) : ?>
                        <a href="<?= BASE_URL . 'filtered_posts.php?topics=' .$topic["id"] ?>"></a>
                        <?php $topic['name']?>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require_once('includes/footer.php'); ?>
</body>
</html>