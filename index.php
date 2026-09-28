<?php
require __DIR__ . '/includes/bootstrap.php';

$siteName = 'Attendance System';
$user = current_user();
$old = take_old_input();
$flashes = take_flashes();

$portfolio = [
    ['image' => '1.png', 'caption' => 'Students'],
    ['image' => '2.jpg', 'caption' => 'Attendance'],
    ['image' => '3.png', 'caption' => 'Daily'],
    ['image' => '4.jpg', 'caption' => 'Online'],
    ['image' => '5.png', 'caption' => 'Teachers'],
    ['image' => '6.jpg', 'caption' => 'Admin'],
];

$services = [
    ['icon' => 'bi-clipboard-check', 'title' => 'Attendance', 'text' => 'Teachers and admins take daily attendance, one student at a time.'],
    ['icon' => 'bi-people', 'title' => 'Manage Students', 'text' => 'Teachers and admins add and update students and review their attendance history.'],
    ['icon' => 'bi-chat-dots', 'title' => 'Feedback', 'text' => 'Students and visitors can send feedback to the admin and teachers.'],
    ['icon' => 'bi-person-badge', 'title' => 'Manage Teachers', 'text' => 'The admin adds, updates and removes teacher accounts.'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Online student attendance management system built with PHP and MySQL.">
    <title><?= e($siteName) ?></title>

    <link rel="icon" type="image/x-icon" href="library/assets/favicon.ico">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css">
    <link rel="stylesheet" href="library/css/styles.css">
    <link rel="stylesheet" href="library/css/custom.css">
</head>
<body id="page-top">
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#page-top"><?= e($siteName) ?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto my-2 my-lg-0">
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#portfolio">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                <?php if ($user): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= e(home_for_role($user['role'])) ?>">Dashboard</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<header class="masthead">
    <div class="container px-4 px-lg-5 h-100">
        <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-8 align-self-end">
                <h1 class="text-white font-weight-bold">Online Student Attendance</h1>
                <hr class="divider">
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 mb-5">For online classrooms, attendance goes beyond the traditional register.</p>
                <a class="btn btn-primary btn-xl" href="#about">Find Out More</a>
            </div>
        </div>
    </div>
</header>

<section class="page-section bg-primary" id="about">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="text-white mt-0">About This Project</h2>
                <hr class="divider divider-light">
                <p class="text-white-75 mb-4">
                    Online (virtual) attendance lets you keep track of every student's attendance in one place.
                    It helps educators monitor learners accurately, instead of marking attendance the traditional
                    way in paper registers.
                </p>
                <a class="btn btn-light btn-xl" href="#services">Get Started!</a>
            </div>
        </div>
    </div>
</section>

<section class="page-section" id="services">
    <div class="container px-4 px-lg-5">
        <h2 class="text-center mt-0">At Your Service</h2>
        <hr class="divider">
        <div class="row gx-4 gx-lg-5">
            <?php foreach ($services as $service): ?>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-5">
                        <div class="mb-2"><i class="<?= e($service['icon']) ?> fs-1 text-primary"></i></div>
                        <h3 class="h4 mb-2"><?= e($service['title']) ?></h3>
                        <p class="text-muted mb-0"><?= e($service['text']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<div id="portfolio">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <?php foreach ($portfolio as $item): ?>
                <div class="col-lg-4 col-sm-6">
                    <a class="portfolio-box" href="library/assets/img/portfolio/fullsize/<?= e($item['image']) ?>" title="<?= e($item['caption']) ?>">
                        <img class="img-fluid" src="library/assets/img/portfolio/thumbnails/<?= e($item['image']) ?>" alt="<?= e($item['caption']) ?>">
                        <div class="portfolio-box-caption">
                            <div class="project-name"><?= e($item['caption']) ?></div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<section class="page-section" id="contact">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-lg-8 col-xl-6 text-center">
                <h2 class="mt-0">Let's Get In Touch!</h2>
                <hr class="divider">
                <p class="text-muted mb-5">Send us your feedback and tell us what we should improve. We will do our best to implement it.</p>
            </div>
        </div>

        <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
            <div class="col-lg-6">
                <?php foreach ($flashes as $flash): ?>
                    <div class="alert alert-<?= e($flash['type']) ?> alert-dismissible fade show" role="alert">
                        <?= e($flash['message']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endforeach; ?>

                <form id="contactForm" method="post" action="feedback_submit.php">
                    <?= csrf_field() ?>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="name" type="text" name="name" placeholder="Enter your name..." maxlength="100" required
                               value="<?= e($old['name'] ?? '') ?>">
                        <label for="name">Full name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com" maxlength="100" required
                               value="<?= e($old['email'] ?? '') ?>">
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="phone" type="tel" name="phone" placeholder="(123) 456-7890" maxlength="20" required
                               pattern="[0-9\s\+\-\(\)]{7,20}" value="<?= e($old['phone'] ?? '') ?>">
                        <label for="phone">Phone number</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="message" name="message" placeholder="Enter your message here..." maxlength="2000" required
                                  style="height: 10rem"><?= e($old['message'] ?? '') ?></textarea>
                        <label for="message">Message</label>
                    </div>
                    <div class="d-grid"><button class="btn btn-primary btn-xl" type="submit">Submit</button></div>
                </form>
            </div>
        </div>

        <div class="row gx-4 gx-lg-5 justify-content-center credits">
            <h4 class="text-center py-2 mb-0">Created by <b>Deep Rathod</b> &amp; <b>Devang Parekh</b></h4>
        </div>
    </div>
</section>

<footer class="bg-light py-5">
    <div class="container px-4 px-lg-5">
        <div class="small text-center text-muted">Copyright &copy; <?= date('Y') ?> <?= e($siteName) ?></div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
<script src="library/js/scripts.js"></script>
</body>
</html>
