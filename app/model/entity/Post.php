<?php

namespace app\model\entity;

use app\core\Entity;

class Post extends Entity
{
    public function getContentPreview()
    {
        return mb_substr($this->content, 0, 200) . ' ...';
    }
}