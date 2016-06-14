<h3>Add New Post</h3>
<hr>

<?php if ($post->hasErrors()) { ?>
    <div class="form-error-message bottom20">Save post error</div>
<?php } ?>

<form method="post" action="">
    <div class="form-group">
        <label for="Title">Post Title</label>
        <input type="text" class="form-control <?=$post->isFieldError('title')? 'field-error':''?>" name="title" value="<?=$post->title?>">
        <p class="field-error-description"><?=$post->getFieldError('title')?></p>
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control  <?=$post->isFieldError('content')? 'field-error':''?>" name="content" rows="3"><?=$post->content?></textarea>
        <p class="field-error-description"><?=$post->getFieldError('content')?></p>
    </div>

    <button type="submit" class="btn btn-default">Submit</button>
</form>
