<?php 
error_reporting(E_ALL ^ E_WARNING);
$site_name = "Attendance System";

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title><?php echo $site_name; ?></title>
       
        <link rel="icon" type="image/x-icon" href="library/assets/favicon.ico" />
		<link href="library/css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav" style="background-color: black; opacity: 0.8;">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top"><?php echo $site_name; ?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Portfolio</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">ONLINE STUDENT ATTENDANCE</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">For Online Classrooms It’s ‘Beyond’ Traditional Classroom Attendance</p>
                        <a class="btn btn-primary btn-xl" href="#about">Find Out More</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">About This Project</h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">Online Attendance (Virtual Attendance) Lets You Keep An Attendance Track Of All Your Students By Tracking Their Log In’s And Off’s. It Is Beneficial For Educators As It Helps Them To Monitor Learners’ Entire Scholastic Activities Accurately. In Offline Attendance, Attendance Is Marked In Traditional Way Using Attendance Register Books</p>
                        <a class="btn btn-light btn-xl" href="#services">Get Started!</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">At Your Service</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Attendance</h3>
                            <p class="text-muted mb-0">Teachers & Admin can take the daily attendance of students </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <h3 class="h4 mb-2">Manage Students</h3>
                            <div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div>
                            <p class="text-muted mb-0">Teachers & Admin can manage the students. by add & update the students.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Feedbacks</h3>
                            <p class="text-muted mb-0">Students & Site visitors can send feedbacks yo admin & teachers.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-heart fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Manage Teachers</h3>
                            <p class="text-muted mb-0">Admin can manage the teachers by add & remove them.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio-->
        <div id="portfolio">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="library/assets/img/portfolio/fullsize/1.png" title="Project Name">
                            <img class="img-fluid" src="library/assets/img/portfolio/thumbnails/1.png" alt="..." />
                            <div class="portfolio-box-caption">
                               
                                <div class="project-name">Students</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="library/assets/img/portfolio/fullsize/2.jpg" title="Project Name">
                            <img class="img-fluid" src="library/assets/img/portfolio/thumbnails/2.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                                
                                <div class="project-name">Attendance</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="library/assets/img/portfolio/fullsize/3.png" title="Project Name">
                            <img class="img-fluid" src="library/assets/img/portfolio/thumbnails/3.png" alt="..." />
                            <div class="portfolio-box-caption">
                            
                                <div class="project-name">Daily</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="library/assets/img/portfolio/fullsize/4.jpg" title="Project Name">
                            <img class="img-fluid" src="library/assets/img/portfolio/thumbnails/4.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                             
                                <div class="project-name">Online</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="library/assets/img/portfolio/fullsize/5.png" title="Project Name">
                            <img class="img-fluid" src="library/assets/img/portfolio/thumbnails/5.png" alt="..." />
                            <div class="portfolio-box-caption">
                              
                                <div class="project-name">Teachers</div>
                            </div>
                        </a>
                    </div>
                     <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="library/assets/img/portfolio/fullsize/6.jpg" title="Project Name">
                            <img class="img-fluid" src="library/assets/img/portfolio/thumbnails/6.jpg" alt="..." />
                            <div class="portfolio-box-caption">
                              
                                <div class="project-name">Admin</div>
                            </div>
                        </a>
                    </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Feedback-->
        <section class="page-section" id="contact">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Let's Get In Touch!</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">Contact us by send the feedbacks to us and tell us which things we need to change.we will try to implement your need.</p>
                    </div>
                </div>

                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                       
                        <form id="contactForm" method="post" action="./admin/feedback_master.php" data-sb-form-api-token="API_TOKEN">
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name" type="text" name="name" placeholder="Enter your name..." data-sb-validations="required" />
                                <label for="name">Full name</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                <label for="email">Email address</label>
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone" type="tel" name="number" placeholder="(123) 456-7890" data-sb-validations="required" />
                                <label for="phone">Phone number</label>
                                <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" id="message" type="text" name="msg" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                <label for="message">Message</label>
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                           
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                            </div>
                           
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                          
                            <div class="d-grid"><button class="btn btn-primary btn-xl" id="submitButton" type="submit">Submit</button></div>
                        </form>
                    </div>
                </div>
                <div style="background-color: #dee2e6; opacity: 0.9" class="row gx-4 gx-lg-5 justify-content-center">
                    <h4 style="text-align: center"> Created by <b>Deep Rathod</b> & <b>Devang Parekh</b> </h4>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="bg-light py-5">  
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy;   <?php echo $site_name; ?> 2022</div></div>
        </footer>
     
     
        <script src="js/scripts.js"></script>
       
     
    </body>
</html>
