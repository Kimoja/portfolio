<?php

$local = include($basePath . "local/$lang.php");
$config = json_decode(file_get_contents($basePath . 'config.json')); 

$langs = $lang == 'fr' ? array('pt', 'en') : ($lang == 'pt' ? array('fr', 'en')  : array('fr', 'pt'));
$missingKey = array();
 
function t($key){
    global $local;
    global $missingKey;
    if(isset($local[$key])){
        return $local[$key];
    }
    $missingKey[] = $key;
    return $key;
}

function addSkill($title, $skills){
    ?>
    <h4><?= t($title); ?></h4>
    <ul class="skills-list">
        <?php 
            foreach ($skills as $name => $percent){
                ?>
                <li class="skill-progress">
                    <span class="progress-type"><?= $name ?></span>
                    <span class="progress-completed pull-right"><?= $percent ?>%</span>
                    <div class="progress" title="<?= $name ?>">
                        <div class="progress-bar six-sec-ease-in-out" aria-valuenow="<?= $percent ?>" aria-valuemin="0" aria-valuemax="100" role="progressbar" data-percent="<?= $percent ?>%" style="width: 0%;">
                            <span class="sr-only"><?= $percent ?>%</span>
                        </div>
                    </div>
                </li>
                <?php 
            }
        ?>
    </ul>
    <?php
}


function addWork($img, $text, $link = null){
    ?>
    <div class="col-md-6 wow fadeInUp animated">
        <div class="folio-bg">
            <div class="tt-overlay"></div>
            <div class="open-gallery">
                <a class="link-popup" href="static/img/screen/<?= $img ?>">
                    <i class="fa fa-search text-white"></i>
                </a>
            </div>
            <img src="static/img/screen/<?= $img ?>" class="img-responsive" />
            <div class="folio-info">
                <?= /*$link ? "<a href='$link' target='_blank'>" :*/ '' ?>
                    <h5><?= $text ?></h5>
                <?= /*$link ? "</a>" :*/ '' ?>
            </div>
        </div>
    </div>
    <?php
}

?> 
<!DOCTYPE html>
<html lang="<?= $lang ?>">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="utf-8"/>
        <base href="<?= $config->base ?>" >  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Carrilho Joakim - <?= t('cv'); ?></title>
        <meta name="author" content="Joakim Carrilho">
        
        <link href="favicon.ico" type="image/x-icon" rel="icon"/>
        <link href="favicon.ico" type="image/x-icon" rel="shortcut icon"/>
      
        <link rel="stylesheet" href="static/build/css.css"/>
        <link rel="stylesheet" href="static/build/main.css"/>
          
        <script src='https://www.google.com/recaptcha/api.js?hl=<?= $lang ?>'></script>
    </head>
    <body data-spy="scroll" data-target=".navbar" data-offset="75">
        
        <div id="preloader" class="loader">
            <div id="loader-status" class="loader-content"></div>
        </div>
        
        <!-- ------------------------- PAGE COVER -------------------------- -->
        <div  id="home" class="cover">
            
            <div class="background-image-fixed cover-image" style="background-image : url('static/img/code_screenshot.jpg')"></div>
            <div class="background-image-fixed cover-image" style="background-color: rgba(0,0,0,0.3);"></div>
            
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center text-white wow fadeInUp animated">
                        <p class="name">Carrilho Joakim</p>
                        <h1 class="head-title-custom"><?= t('webdev title'); ?></h1>
                        <p></p>
                        <ol class="list-inline custom-li-box wow fadeInUp animated">
                            <li class="wow fadeIn">
                                <a target="_blank" href="https://github.com/Kimoja">
                                    <i class="fa fa-2x text-white fa-github"></i>
                                </a>
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="indicator text-center text-white">
                    <div><i class="fa fa-chevron-down slideOutDown"></i></div>
                </div>
            </div>
        </div>
        
        
        <header id="nav-header-resume" class="header">
            <nav class="navbar navbar-default navbar-fixed-top navbar-custom" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class=" navbar-toggle-button navbar-toggle collapsed" data-toggle="collapse" data-target="#custom-collapse" aria-expanded="false">
                            <span class="fa fa-bars"></span>
                        </button>
                        <a href="#home" class="navbar-brand">C<span>J</span></a>
                    </div>
                    <div id="custom-collapse" class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right custom-nav">
                            <li class="active">
                                <a href="#home">
                                    <i class="fa  fa-home"></i>
                                    <?= t('home'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#about">
                                    <i class="fa fa-info-circle"></i>
                                    <?= t('about'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#resume">
                                    <i class="fa fa-graduation-cap"></i>
                                    <?= t('resume'); ?>
                                </a>
                            </li> 
                            <li>
                                <a href="#skills">
                                    <i class="fa fa-gears"></i>
                                    <?= t('skills'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#works">
                                    <i class="fa fa-pencil-square-o"></i>
                                    <?= t('works'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#contact">
                                    <i class="fa fa-phone"></i>
                                    <?= t('contact'); ?>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-flag"></i>
                                    <?= t('lang'); ?> 
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php 
                                    foreach ($langs as $ln) {
                                        ?>
                                        <li>
                                            <a href="io/<?= $ln ?>/">
                                                <i class="fa fa-flag"></i>
                                                <?= t($ln) ?>
                                            </a>
                                        </li>
                                        <?php 
                                    }
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <section id="about" class="section">
            <div class="container">
                <h2 style="visibility: visible; animation-name: fadeInUp;" class="section-title wow fadeInUp animated"><?= t('about me'); ?></h2>
                <div class="row">
                    <div class="col-md-4 col-md-push-8 wow fadeInUp animated">
                        <div class="biography">
                            <ul>
                                <li><strong><?= t('first name'); ?>:</strong> Joakim</li>
                                <li><strong><?= t('name'); ?>:</strong> Carrilho</li>
                                <li><strong><?= t('birthday'); ?>:</strong> 11 Juillet 1982</li>
                                <li><strong><?= t('adresse'); ?>:</strong> <?= t('local_adresse'); ?></li>
                                <li><strong><?= t('phone'); ?>:</strong> <?= t('local_phone'); ?></li>
                                <li><strong><?= t('email'); ?>:</strong> carrilho_joakim@yahoo.fr</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8 col-md-pull-4 wow fadeInUp animated">
                        <h3><?= t('about me title'); ?></h3>
                        <div class="about_desc">
                            <?= t('about me description'); ?>
                        </div>
                        <div>
                            <a href="static/cv/<?= $lang ?>.txt"  class="btn btn-lg btn-default btn-custom" >
                                <i class="fa fa-graduation-cap"></i>
                                <?= t('mon cv'); ?>
                            </a>   
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="resume" class="section section-primary">
            <div class="container">
                <h2 style="visibility: visible; animation-name: fadeInUp;" class="section-title wow fadeInUp animated"><?= t('resume'); ?></h2>
                <div class="resume-title">
                    <h3><?= t('experiences'); ?></h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-badge"><i class="fa fa-building"></i></div>
                        <div class="timeline-panel wow fadeInUp animated">
                            <div class="timeline-heading">
                                <h4 class="timeline-title"><?= t('webdev fullstack'); ?></h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o"></i> 05/2011 - 01/2016 
                                        <i class="fa fa-map-marker"></i> Arociel - Le Mans, <?= t('france'); ?>
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <?= t('arociel description'); ?> 
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-badge"><i class="fa fa-building"></i></div>
                        <div class="timeline-panel wow fadeInUp animated">
                            <div class="timeline-heading">
                                <h4 class="timeline-title"><?= t('freedev'); ?></h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o"></i> 04/2009 - 02/2011
                                        <i class="fa fa-map-marker"></i> <?= t('dev'); ?> - Le Mans, <?= t('france'); ?>
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <?= t('freelancer description'); ?> 
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="resume-title">
                    <h3>Formations</h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-badge"><i class="fa fa-graduation-cap"></i></div>
                        <div class="timeline-panel wow fadeInUp animated">
                            <div class="timeline-heading">
                                <h4 class="timeline-title"><?= t('formation informatique'); ?></h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o"></i> 06/2007 - 06/2008
                                        <i class="fa fa-map-marker"></i> CCI Formation - Le Mans, <?= t('france'); ?>
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <?= t('formation informatique description'); ?> 
                            </div>
                        </div>
                    </li>
                    
                    <li class="timeline-inverted">
                        <div class="timeline-badge"><i class="fa fa-graduation-cap"></i></div>
                        <div class="timeline-panel wow fadeInUp animated">
                            <div class="timeline-heading">
                                <h4 class="timeline-title"><?= t('formation economie'); ?> </h4>
                                <p>
                                    <small class="text-muted">
                                        <i class="fa fa-clock-o"></i> 06/2002 - 06/2004
                                        <i class="fa fa-map-marker"></i> <?= t('universite maine'); ?> - Le Mans, <?= t('france'); ?>
                                    </small>
                                </p>
                            </div>
                            <div class="timeline-body">
                                <?= t('formation economie description'); ?> 
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <section id="skills" class="section">
            <div class="container">
                <h2 style="visibility: visible; animation-name: fadeInUp;" class="section-title wow fadeInUp animated"><?= t('skills'); ?></h2>
                <div class="row">
                    <div class="col-md-6 wow fadeInUp animated">
                        <?php
                            addSkill(
                                'skills front', array(
                                    'HTML5' => 80,
                                    'SEO' => 50,
                                    'CSS3' => 75,
                                    'Twitter Bootstrap' => 50,
                                    'LESS/SASS' => 60,
                                    'Javascript' => 90,
                                    'jQuery' => 80,
                                    'Lodash' => 40,
                                    'D3js' => 40,
                                    'jQuery UI' => 80,
                                    'Angularjs' => 25,
                                    'Bower' => 20,
                                    'Cordova' => 30,
                                    'API gMap' => 60,
                                    'Sencha ExtJS' => 40,
                                    'Gimp' => 50,
                                    'Photoshop' => 30
                                )
                            ); 
                            addSkill(
                                'skills langage system desktop', array(
                                    'Java' => 60,
                                    'Phyton' => 40,
                                    'C/C++' => 15,
                                    'Shell linux' => 30
                                )
                            ); 
                        ?>
                    </div>
                    <div class="col-md-6 wow fadeInUp animated">
                        <?php
                            addSkill(
                                'skills back', array(
                                    'PHP' => 80,
                                    'Symfony 2' => 20,
                                    'Laravel 5' => 40,
                                    'Worpress' => 50,
                                    'Drupal' => 40,
                                    'Modx' => 60,
                                    'NodeJs' => 70,
                                    'Grunt/Gulp' => 60,
                                    'Composer/NPM' => 40,
                                    'Apache 2' => 60,
                                    'Nginx' => 20,
                                    'MySql 5' => 80,
                                    'MongoDB' => 30,
                                    'SQLite' => 30
                                )
                            ); 
                            addSkill(
                                'skills other', array(
                                    'Windows' => 50,
                                    'Linux' => 50,
                                    'IDE (Netbeans, Webstorm)' => 75,
                                    'POO' => 100,
                                    'MVC/MVVM/MVW' => 80,
                                    'Design pattern' => 50,
                                    'Réseau' => 30,
                                    'Git' => 50,
                                    'Français' => 100,
                                    'English' => 50,
                                    'Português' => 50
                                )
                            ); 
                        ?>
                    </div>
                </div>
            </div>
        </section>
        
        
        <section id="works" class="section section-primary">
            <div class="container">
                <h2 style="visibility: visible; animation-name: fadeInUp;" class="section-title wow fadeInUp animated"><?= t('works'); ?></h2>
                <div class="row">
                    <?php
                        addWork('fw.jpg', 'ERP', 'http://www.blot-commerce.fr/');
                        addWork('fw2.jpg', 'ERP', 'http://www.blot-commerce.fr/');
                    ?>
                </div>
                <div class="row">
                    <?php
                        addWork('bdm.jpg', 'Bâtiments Durables Méditerranéens');
                        addWork('bdm2.jpg', 'Bâtiments Durables Méditerranéens');
                    ?>
                </div>
                <div class="row">
                    <?php
                        addWork('blot.jpg', 'Blot Commerce', 'http://www.blot-commerce.fr/');
                        addWork('blot2.jpg', 'Blot Commerce', 'http://www.blot-commerce.fr/');
                    ?>
                </div>
                <div class="row">
                    <?php
                        addWork('buroclub.jpg', 'BuroClub', "http://buro.com/");
                        addWork('buroclub2.jpg', 'BuroClub', "http://buro.com/");
                    ?>
                </div>
            </div>
        </section>
        
        
        <!---->
        
        
        
        
        <section id="contact" class="section">
            <div class="container">
                <h2 style="visibility: visible; animation-name: fadeInUp;" class="section-title wow fadeInUp animated"><?= t('do contact'); ?></h2>
                <div class="row">
                    <div class="col-md-6 wow fadeInUp animated">
                        <h4><?= t('do contact'); ?></h4>
                        <form method="post" id="contact-form" accept-charset="utf-8" role="form"  action="http://benkhadra.com/">
                            <div style="display:none;"><input type="hidden" name="_method" value="POST"/></div>
                            <div class="form-group">
                                <label class="control-label" for="name"><?= t('contact nom'); ?></label>
                                <input type="text" name="name" required="required" class="form-control" id="name"/>                            
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="email"><?= t('contact mail'); ?></label>
                                <input type="email" name="email" required="required" class="form-control"/>                            
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="subject"><?= t('contact sujet'); ?></label>
                                <input type="text" name="subject" required="required" class="form-control" id="subject"/>                            
                            </div>
                            <div class="form-group">
                                <label for="message"><?= t('contact message'); ?></label>
                                <textarea name="message" required="required" rows="5" class="form-control textarea" id="message"></textarea>                            
                            </div>
                            <div class="row">
                                <div class="col-sm-5 col-md-6 text-left">
                                    <div class="g-recaptcha" data-sitekey="<?= $config->recaptchaPublicKey; ?>"></div>
                                </div>
                                <div class="col-sm-5 col-sm-offset-2 col-md-6 col-md-offset-0 text-right">
                                    <button type="submit" class="btn btn-lg btn-default btn-custom">
                                        <i class="fa fa-paper-plane"></i><?= t('contact envoyer'); ?>
                                    </button>                                
                                </div>
                            </div>
                            <div class="row" id="contact-msg"> 
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 wow fadeInUp animated">
                        <div class="row center-xs">
                            <div class="col-sm-6 custom-position">
                                <div class="row">
                                    <div class="col-sm-2"><i class="fa fa-map-marker fa-4x text-primary"></i></div>
                                    <address class="col-sm-10">
                                        <strong class="custom-strong"><?= t('adresse'); ?></strong>
                                        <div><?= t('local_adresse'); ?></div>
                                    </address>
                                </div>
                            </div>
                            <div class="col-sm-6 custom-position">
                                <div class="row">
                                    <div class="col-sm-2"><i class="fa fa-phone fa-3x text-primary"></i></div>
                                    <div class="col-sm-10">
                                        <strong class="custom-strong"><?= t('phone'); ?></strong>
                                        <div><a href="tel:<?= t('local_phone'); ?>"><?= t('local_phone'); ?></a></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 custom-position">
                                <div class="row">
                                    <div class="col-sm-2"><i class="fa fa-at fa-3x text-primary"></i></div>
                                    <div class="col-sm-10">
                                        <strong class="custom-strong"><?= t('email'); ?></strong>
                                        <div><a href="mailto:carrilho_joakim@yahoo.fr">carrilho_joakim@yahoo.fr</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <img class="img-responsive custom-map" src="http://maps.googleapis.com/maps/api/staticmap?center=Costa%20da%20Caparica,Portugal&zoom=12&size=545x350&sensor=false&maptype=roadmap&markers=color:blue%7Clabel:H%7C38.650921,-9.232235">
                    </div>
                </div>
            </div>
        </section>
        
        
        <footer class="section section-primary inset-shadow">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h3>
                            <i class="el el-quote-alt el-1x"></i> 
                            <?= t('citation'); ?>
                        </h3>
                        <p>
                            <i class="fa fa-quote-left fa-1x"></i>
                            <?= t('citation text'); ?>
                            <i class="fa fa-quote-right fa-1x"></i> 
                            <small>Albert Einstein</small>
                        </p>
                    </div>
                </div>
                <div><i class="fa fa-copyright"></i><?= date('Y'); ?> Joakim Carrilho</div>
            </div>
        </footer>
        
        <div id="toTop" class="go-back-top"><a href="#home">
        <i class="fa fa-2x fa-angle-up"></i></a></div>
        
        
        <div class="tpl" id="error-contact">
            <div class="col-md-12 alert {{type}} fadeInUp animated">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{msg}}
            </div>
        </div>
        
        <?php 
        if($config->env == 'dev') {
            print_r($missingKey);
        }
        ?>
        
        <script>
            var __base__ = "<?= $config->base ?>";
            var __local__ = <?=  json_encode(array(
                "contact error" => t('contact error'),
                "contact success" => t('contact success'),
                "contact warning" => t('contact warning')
            )) ?>;
        </script>
        
        <!--<script src="../www.google.com/recaptcha/api.js"></script>     -->   
        <script src="static/build/js.js"></script>   
        <script src="static/build/main.js"></script>    
    </body>
</html>
 