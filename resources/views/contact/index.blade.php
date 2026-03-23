@extends('layouts.app')

@section('title','Contact Us')

@section('content')

<!-- contact area start -->
<section class="rs-contact-area rs-contact-one section-space">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="rs-contact-wrapper">
                    <div class="rs-contact-item">
                        <div class="rs-contact-thumb">
                            <img src="assets/images/contact/contact-thumb-01.webp" alt="image">
                        </div>
                        <h5 class="rs-contact-title">California</h5>
                        <div class="rs-contact-info">
                            <span><a href="#">Madison Avenue, new york</a></span>
                            <span><a href="tel:990123456789">+990 123 456 789</a></span>
                            <span><a href="mailto:nerionewsexmple@gmail.com">nerionewsexmple@gmail.com</a></span>
                        </div>
                    </div>
                    <div class="rs-contact-item">
                        <div class="rs-contact-thumb">
                            <img src="assets/images/contact/contact-thumb-02.webp" alt="image">
                        </div>
                        <h5 class="rs-contact-title">New York City</h5>
                        <div class="rs-contact-info">
                            <span><a href="#">Washington Ave. Manchester, Kentucky </a></span>
                            <span><a href="tel:893085550121">+89 (308) 555-0121</a></span>
                            <span><a href="mailto:nerionewsexmple@gmail.com">nerionewsexmple@gmail.com</a></span>
                        </div>
                    </div>
                    <div class="rs-contact-item">
                        <div class="rs-contact-thumb">
                            <img src="assets/images/contact/contact-thumb-03.webp" alt="image">
                        </div>
                        <h5 class="rs-contact-title">New Hampshire</h5>
                        <div class="rs-contact-info">
                            <span><a href="#"> Parker Rd. Allentown, New Mexico</a></span>
                            <span><a href="tel:9075550101">(907) 555-0101</a></span>
                            <span><a href="mailto:nerionewsexmple@gmail.com">nerionewsexmple@gmail.com</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact area end -->

<!-- contact area start -->
<section class="rs-contact-area rs-contact-two">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="rs-contact-wrapper">
                    <div class="rs-contact-form">
                        <h3 class="rs-contact-form-title">Feel Free to Contact Us</h3>
                        <form id="contact-form" action="https://demo.rstheme.com/html/nerio/assets/mailer.php"
                            method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="rs-contact-input-box">
                                        <div class="rs-contact-input-title">
                                            <label for="name">Full Name<span>*</span></label>
                                        </div>
                                        <div class="rs-contact-input">
                                            <input id="name" name="name" type="text" placeholder="Robot fox">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="rs-contact-input-box">
                                        <div class="rs-contact-input-title">
                                            <label for="name">Email Address<span>*</span></label>
                                        </div>
                                        <div class="rs-contact-input">
                                            <input id="email" name="email" type="email" placeholder="info@example.com">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="rs-contact-input-box">
                                        <div class="rs-contact-input-title">
                                            <label for="name">Phone number<span>*</span></label>
                                        </div>
                                        <div class="rs-contact-input">
                                            <input id="phone" name="phone" type="text" placeholder="(480) 555-0103">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="rs-contact-input-box">
                                        <div class="rs-contact-input-title">
                                            <label for="name">Website<span>*</span></label>
                                        </div>
                                        <div class="rs-contact-input">
                                            <input id="text" name="name" type="text" placeholder="www.nerio.net">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="rs-contact-input-box">
                                        <div class="rs-contact-input-title">
                                            <label for="name">Message<span>*</span></label>
                                        </div>
                                        <div class="rs-contact-input">
                                            <textarea id="message" name="message" placeholder="Type here..."></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="rs-contact-btn">
                                        <button type="submit" class="rs-btn has-icon">
                                            Send Massage
                                            <span class="icon-box">
                                                <svg class="icon-first" width="17" height="12" viewBox="0 0 17 12"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.3153 5.0991C13.1189 5.0991 11.1171 3.0991 11.1171 0.900901V0H9.31532V0.900901C9.31532 2.4991 10.0162 3.9982 11.1162 5.0991H0V6.9009H11.1162C10.0162 8.0018 9.31532 9.5009 9.31532 11.0991V12H11.1171V11.0991C11.1171 8.9018 13.1189 6.9009 15.3153 6.9009H16.2162V5.0991H15.3153Z"
                                                        fill="white" />
                                                </svg>

                                                <svg class="icon-second" width="17" height="12" viewBox="0 0 17 12"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.3153 5.0991C13.1189 5.0991 11.1171 3.0991 11.1171 0.900901V0H9.31532V0.900901C9.31532 2.4991 10.0162 3.9982 11.1162 5.0991H0V6.9009H11.1162C10.0162 8.0018 9.31532 9.5009 9.31532 11.0991V12H11.1171V11.0991C11.1171 8.9018 13.1189 6.9009 15.3153 6.9009H16.2162V5.0991H15.3153Z"
                                                        fill="white" />
                                                </svg>

                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="form-messages"></div>
                    </div>
                    <div class="rs-contact-thumb">
                        <img src="assets/images/contact/contact-thumb-04.webp" alt="contact image">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- contact area end -->

<!-- Google map area start -->
<div class="rs-map-area rs-map-one">
    <div class="rs-google-map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d34214.60083365065!2d-74.01068688015093!3d40.714229226069826!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1713786758295!5m2!1sen!2sbd"
            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
</div>
<!-- Google map area end-->
 @endsection