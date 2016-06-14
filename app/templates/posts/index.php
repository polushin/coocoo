<?php foreach($posts as $post) { ?>
    <div class="row">
        <div class="col-md-7">
            <h3><?=h($post->title)?></h3>
            <h4><?=h($post->author->getFullName())?></h4>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?=$post->created?></p>
            <p><?=h($post->getContentPreview())?></p>
            <a class="btn btn-primary" href="/posts/view/<?=$post->id?>">View Post <span class="glyphicon glyphicon-chevron-right"></span></a>
        </div>
    </div>

    <hr>
<?php } ?>