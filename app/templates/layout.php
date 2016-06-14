<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Simple blog</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/base.css" rel="stylesheet">

</head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><?=(!empty($blogName)) ? $blogName : ''?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="/posts">Posts List</a></li>

                    <?php if (empty($loggedUser)) { ?>
                        <li><a href="/users/login">Login</a></li>
                    <?php } else { ?>
                        <li><a href="/posts/add">Add Post</a></li>
                        <li class="separator"><a>|</a></li>

                        <li><a><?=h($loggedUser['firstname'].' '.$loggedUser['lastname'])?></a></li>
                        <li><a href="/users/logout">Logout</a></li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <div class="container">

    <?php include $contentTemplate; ?>

    </div>

    <hr>


</body>
</html>