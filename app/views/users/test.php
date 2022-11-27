<?php

//var_dump($posts);die;
foreach ($posts as $post){
    echo $post->getUser();
    echo $post->getId();
}