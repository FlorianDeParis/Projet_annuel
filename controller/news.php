<?php
include(dirname(__FILE__).'/../modele/news_class.php');

$news = new News();
$news->getTitre();

include(dirname(__FILE__).'/../vue/news.php');
