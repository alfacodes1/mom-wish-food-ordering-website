<?php 
include("header.php");
?>

<div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="<?php echo FRONT_SITE_PATH?>home">Home</a></li>
                        <li class="active"> Contact Us </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="contact-area pt-100 pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="contact-info-wrapper text-center mb-30">
                            <div class="contact-info-icon">
                                <i class="ion-ios-location-outline"></i>
                            </div>
                            <div class="contact-info-content">
                                <h4>Our Location</h4>
                                <p>No.33, Main street, Negambo</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="contact-info-wrapper text-center mb-30">
                            <div class="contact-info-icon">
                                <i class="ion-ios-telephone-outline"></i>
                            </div>
                            <div class="contact-info-content">
                                <h4>Contact us Anytime</h4>
                                <p>Mobile: +447532620429</p>
                                <p>Email: <a href="">momswishnefoods@gmail.com</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="contact-info-wrapper text-center mb-30">
                            <div class="contact-info-icon">
                                <i class="ion-ios-email-outline"></i>
                            </div>
                            <div class="contact-info-content">
                                <h4>Write Some Words</h4>
                                <p>Fb: Mom's Wish Foods</a></p>
                                <p><a href="">momswishnefoods@gmail.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="contact-message-wrapper">
                            <h4 class="contact-title">GET IN TOUCH</h4>
                            <div class="contact-message">
                                <form id="contact-form" action="<?php echo FRONT_SITE_PATH?>contact-us_submit" method="post">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="contact-form-style mb-20">
                                                <input name="name" placeholder="Full Name" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="contact-form-style mb-20">
                                                <input name="email" placeholder="Email Address" type="email" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="contact-form-style mb-20">
                                                <input name="mobile" placeholder="Mobile" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-form-style mb-20">
                                                <input name="subject" placeholder="Subject" type="text" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-form-style">
                                                <textarea name="message" placeholder="Message" required></textarea>
                                                <button class="submit btn-style" type="submit">SEND MESSAGE</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?PHP
include("footer.php");
?>