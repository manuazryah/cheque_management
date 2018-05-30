<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div role="main" class="main">
    <section class="section section-no-background m-none">


        <div class="container" style="padding-top:30px !important;">
            <div class="container">

                <div class="row">
                    <div class="col-md-6">
                        <h2 class="mb-sm mt-sm"><strong>Contact</strong> Us</h2>
                        <?php $form = ActiveForm::begin(); ?>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="control-label" for="contact-name">Your Name *</label>
                                    <input type="text" id="contact-name" class="form-control" name="Contact[name]" maxlength="100" required>

                                    <div class="help-block"></div>
                                </div>
                                <div class="col-md-6">
                                    <label class="control-label" for="contact-email">Your email address *</label>
                                    <input type="email" id="contact-email" class="form-control" name="Contact[email]" maxlength="100" required>

                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label" for="contact-subject">Subject</label>
                                    <input type="text" id="contact-subject" class="form-control" name="Contact[subject]" maxlength="200" required>

                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label class="control-label" for="contact-message">Message *</label>
                                    <textarea id="contact-message" class="form-control" name="Contact[message]" rows="10" required></textarea>

                                    <div class="help-block"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg mb-xlg">Send Message</button>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                    <div class="col-md-6" style="padding-top:60px;">

                        <h4 class="heading-primary mt-lg">Get in <strong>Touch</strong></h4>
                        <p>The Complete Cheque Printing Software Eazy Cheque will help you to print cheques in your own customized format. You can also get a bank statement with your inward transaction.</p>

                        <hr>

                        <h4 class="heading-primary" style="padding-top:30px;">The <strong>Office</strong></h4>
                        <ul class="list list-icons list-icons-style-3 mt-xlg">
                            <li><i class="fa fa-map-marker"></i> <strong>Address:</strong> Building 1, Bay Square, Business Bay, Dubai, UAE</li>
                            <li><i class="fa fa-phone"></i> <strong>Phone:</strong>:+971 555 88 4262 / +971 555 16 11 87</li>
                            <li><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:#">info@gulfproaccountants.com</a></li>
                        </ul>

                        <hr>

                    </div>

                </div>

            </div>

        </div>

        <div id="googlemaps" class="google-map" style="margin-top:50px !important;"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3610.547516430474!2d55.27668511459447!3d25.184751983901958!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f69d4b3566553%3A0xd7b659fbd3123d39!2sBay+Square!5e0!3m2!1sen!2sin!4v1490961360695" width="100%" height="480" frameborder="0" style="border:0" allowfullscreen></iframe></div>


    </section>
</div>