<div class="row">

<div class="col-lg-12">

    <h1><?=h($post->title)?></h1>

    <p class="lead">
        by <span><?=h($post->author->getFullName())?></span>
    </p>

    <hr>

    <p><span class="glyphicon glyphicon-time"></span> Posted on <?=$post->created?></p>

    <hr>

    <p><?=h($post->content)?></p>

    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        <form role="form" action="" method="post">
            <div class="form-group">
                <textarea name="comment" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <hr>

    <?php foreach($post->comments as $comment) { ?>
        <div class="media">
            <div class="media-body">
                <h4 class="media-heading"><?=$comment->author ? h($comment->author->getFullName()) : 'Anonymous'; ?>
                    <small><span class="glyphicon glyphicon-time"></span> <?=$comment->created?></small>
                </h4>
                <?=h($comment->content)?>
            </div>
        </div>
    <?php } ?>
</div>
</div>