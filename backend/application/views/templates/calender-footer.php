<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
    /* General Reset */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    /* Footer General Styles */
    .site-footer {
        background-color: #1a1a1a;
        padding: 40px 0 20px;
        font-family: 'Arial', sans-serif;
        font-size: 14px;
        color: #e0e0e0;
        border-top: 1px solid #333;
    }

    .site-footer h4 {
        font-size: 16px;
        font-weight: 600;
        color: #ffffff;
        text-transform: uppercase;
        margin-bottom: 20px;
        letter-spacing: 0.5px;
    }

    .site-footer ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .site-footer ul li {
        margin-bottom: 8px;
    }

    .site-footer ul li a {
        color: #bbb;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .site-footer ul li a:hover {
        color: #e02c3f;
    }

    /* Grid Container for Footer Sections */
    .footer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    /* Image Styling to Prevent Zoom/Enlarge */
    img {
        max-width: 100%;
        height: auto;
        transition: none;
        object-fit: contain;
    }

    /* Payment Options */
    .payment-options img {
        max-height: 100px;
        width: auto;
    }

    .digital-india ul {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .digital-india ul li img {
        max-height: 80px;
        width: auto;
    }

    /* Customer Care */
    .care p {
        margin-bottom: 10px;
        font-size: 13px;
    }

    .care .strong {
        font-weight: 600;
    }

    .care .highlighted a {
        color: #e02c3f;
        text-decoration: none;
    }

    /* Social Media Icons */
    .foot-social ul {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .foot-social ul li a {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        background-color: #333;
        border-radius: 50%;
        font-size: 18px;
        color: #fff;
        transition: background-color 0.3s ease;
    }

    .foot-social ul li a:hover {
        background-color: #e02c3f;
    }

    .foot-social ul li a img {
        display: none;
    }

    /* Hit Counter */
    .hit-counter ul {
        display: flex;
        gap: 5px;
    }

    .hit-counter ul li {
        background: #444;
        color: #fff;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 14px;
    }

    /* Map Section */
    .foot-map iframe {
        width: 100%;
        height: 150px;
        border: 0;
    }

    .foot-map a {
        color: #e02c3f;
        text-decoration: none;
        font-size: 12px;
    }

    /* Services Section */
    .footer-services {
        margin-top: 30px;
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        padding: 0 15px;
    }

    .footer-services .block-el {
        display: flex;
        align-items: center;
    }

    .footer-services .service-icon {
        width: 32px;
        height: 32px;
        background-size: contain;
        background-repeat: no-repeat;
        margin-right: 10px;
    }

    .footer-services .service-name a {
        font-size: 13px;
        color: #bbb;
    }

    /* Categories */
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 10px;
        padding: 0 15px;
        margin-top: 30px;
    }

    .footerlisting-categories {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .footerlisting-categories span a {
        color: #bbb;
        text-decoration: none;
    }

    .footerlisting-categories span a:hover {
        color: #e02c3f;
    }

    .show-more {
        color: #e02c3f;
        cursor: pointer;
        margin-top: 10px;
        display: block;
    }

    /* Web App Section */
    .web-app {
        padding: 40px 0;
        background-color: #2c2f33;
        color: #e0e0e0;
    }

    .web-app h2 {
        font-size: 24px;
        margin-bottom: 20px;
        text-align: center;
    }

    .web-app h2 span {
        color: #e02c3f;
    }

    .web-app ul {
        margin-bottom: 20px;
        text-align: center;
    }

    .web-app ul li {
        font-size: 14px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .web-app ul li i {
        margin-right: 10px;
        color: #e02c3f;
    }

    .web-app .app-link-form {
        text-align: center;
        margin-bottom: 20px;
    }

    .web-app .app-link-form ul.form-inputs {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .web-app .app-link-form input {
        padding: 10px;
        border: 1px solid #444;
        border-radius: 4px;
        background-color: #333;
        color: #e0e0e0;
    }

    .web-app .app-link-form input[type="submit"] {
        background-color: #e02c3f;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .web-app .app-links img {
        max-height: 120px;
        width: auto;
    }

    /* Web App Image */
    .web-app-img img {
        max-height: 300px;
        width: auto;
    }

    /* Copyright Section */
    .copy {
        background-color: #0d0d0d;
        color: #bbb;
        padding: 15px 0;
        text-align: center;
        font-size: 12px;
    }

    .copy a {
        color: #e02c3f;
        text-decoration: none;
    }

    /* Responsive Design */
    @media (max-width: 767px) {
        .footer-grid {
            grid-template-columns: 1fr;
        }

        .services-grid {
            grid-template-columns: 1fr 1fr;
        }

        .categories-grid {
            grid-template-columns: 1fr;
        }

        .web-app .app-link-form ul.form-inputs {
            flex-direction: column;
        }

        .web-app .app-link-form input {
            width: 100%;
        }

        .payment-options img {
            max-height: 80px;
        }

        .digital-india ul li img {
            max-height: 60px;
        }

        .web-app .app-links img {
            max-height: 100px;
        }

        .web-app-img img {
            max-height: 250px;
        }
    }
</style>

<!-- Web App Promotion Section -->
<!--<section class="web-app">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-md-6 web-app-img">-->
<!--                <img src="<?php echo base_url('assets/images/mobile01.webp'); ?>" alt="<?php echo $companyRow->cName; ?>">-->
<!--            </div>-->
<!--            <div class="col-md-6 web-app-con">-->
<!--                <h2>Looking for the Best Service Provider? <span>Get the App!</span></h2>-->
<!--                <ul>-->
<!--                    <li><i class="fa fa-check" aria-hidden="true"></i> Find nearby listings</li>-->
<!--                    <li><i class="fa fa-check" aria-hidden="true"></i> Easy service enquiry</li>-->
<!--                    <li><i class="fa fa-check" aria-hidden="true"></i> Listing reviews and ratings</li>-->
<!--                    <li><i class="fa fa-check" aria-hidden="true"></i> Manage your listing, enquiry and reviews</li>-->
<!--                </ul>-->
<!--                <form class="app-link-form">-->
<!--                    <ul class="form-inputs">-->
<!--                        <li><input type="text" placeholder="+91" readonly></li>-->
<!--                        <li><input type="number" placeholder="Enter mobile number" maxlength="10"></li>-->
<!--                        <li><input type="submit" value="Get App Link"></li>-->
<!--                    </ul>-->
<!--                </form>-->
<!--                <div class="app-links">-->
<!--                    <a href="https://play.google.com/store/apps/details?id=in.redback.groups.apps.velloreads" target="_blank">-->
<!--                        <img src="<?php echo base_url('assets/images/android.png'); ?>" alt="Google Play">-->
<!--                    </a>-->
<!--                    <a href="#!">-->
<!--                        <img src="<?php echo base_url('assets/images/apple.png'); ?>" alt="<?php echo $companyRow->cName; ?>">-->
<!--                    </a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->

<!-- Footer Section -->
<footer id="colophon" class="site-footer clearfix">
    <div class="footer-grid">
        <div class="payment-options">
            <h4>Payment Options</h4>
            <p><img src="<?php echo base_url('assets/images/Payment.webp'); ?>" alt="Payment Options"></p>
            <div class="digital-india">
                <ul>
                    <li><img src="<?php echo base_url('assets/images/makein_india.webp'); ?>" alt="Make in India"></li>
                    <li><img src="<?php echo base_url('assets/images/vocal.webp'); ?>" alt="Vocal for Local"></li>
                    <li><img src="<?php echo base_url('assets/images/digital.webp'); ?>" alt="Digital India"></li>
                </ul>
            </div>
        </div>
        <div class="care">
            <h4>Customer Care</h4>
            <p>Monday to Saturday: 9AM to 9PM</p>
            <p><span class="strong">Support: </span><span class="highlighted"><a href="tel:8189985559">8189985559</a></span></p>
            <p><span class="strong">Current Time: </span>03:58 PM IST, <?php echo date('l, F j, Y'); ?></p>
        </div>
        <div class="foot-social">
            <h4>Follow with Us</h4>
            <ul>
                <li><a href="https://www.facebook.com/velloreadsclassifieds/" title="Facebook" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="https://www.instagram.com/velloreads/?hl=en" title="Instagram" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="https://x.com/velloreads" title="Twitter" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="https://en.wikipedia.org/wiki/Vellore" title="Wikipedia" target="_blank"><i class="fa fa-wikipedia-w" aria-hidden="true"></i></a></li>
                <li><a href="https://www.youtube.com/@velloreads" title="YouTube" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                <li><a href="https://www.whatsapp.com/channel/0029VaBiWahIt5rz1woEtb3Y" title="WhatsApp" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
                <li><a href="https://www.linkedin.com/company/velloreads" title="LinkedIn" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
            </ul>
            <h4>Website Traffic</h4>
            <div class="hit-counter">
                <ul>
                    <?php
                    $visitCounter = $this->db->query("SELECT * FROM `page` WHERE `id` = '1'")->row_array();
                    $visitor = strlen($visitCounter['page_opens']);
                    for ($v = 0; $v < $visitor; $v++) {
                        echo '<li>' . $visitCounter['page_opens'][$v] . '</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="foot-map">
            <?php echo $companyRow->map; ?>
            <a href="#" target="_blank">View larger map</a>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d248904.42357588056!2d78.95352974224389!3d12.89925716822641!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bad38e61fa68ffb%3A0xbedda6917d262b5e!2sVellore%2C%20Tamil%20Nadu!5e0!3m2!1sen!2sin!4v1760697179290!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>



</footer>

<!-- Copyright Section -->
<section class="copy">
    <div class="container">
        <p>Copyrights © <?php echo date('Y'); ?> <a href="https://Quickix.com/" target="_blank">Quickix</a>. All rights reserved. Powered by <span style="color: #e02c3f">♥</span> <a href="http://redbackstudios.in" target="_blank">Redback</a></p>
    </div>
</section>