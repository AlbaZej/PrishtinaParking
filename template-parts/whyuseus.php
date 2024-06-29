<?php
/*
Template Name: Why Use Us
*/
get_header() ?>


<div class="flex flex-col items-center justify-center pt-20 pb-40 h-[calc(100vh - 100px)]">
    <div class="w-full md:w-4/5 lg:w-3/5 xl:w-2/3">
        <div class="flex flex-col md:flex-row">
            <div class="w-1/2 flex flex-col justify-center">
                <div class="w-10/12 mx-auto">
                    <p class="module-heading font-bold text-menublue">Why use us?</p>
                    <p class="module-heading font-normal">A quicker, cheaper and greener way to travel</p>
                </div>
            </div>

            <div class="w-full md:w-1/2 h-auto flex flex-col items-start justify-center md:items-end">
                <div class="w-full px-4">
                    <div class="border-l-2 border-menublue pl-4">
                        <p class=" tagline text-gray-600">Say goodbye to circling
                            the block in
                            search of a parking space. Get to where you're going faster by driving straight from A
                            to B and pay the best price guaranteed for your parking space.</p>
                        <br>
                        <p class="tagline text-gray-600">Our marketplace is changing road travel and
                            moving the UK more conveniently, more affordably, and more sustainably.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container1 bg-buttonblue text-light">
    <div class="w-1/4">
        <p class="module-heading font-semibold mb-4">Best <span class="font-bold"> price </span> guarantee</p>
        <p class="module-text font-normal">We're always confident that our prices are the best available. In the
            unlikely
            event that you find a
            lower price for the same parking space elsewhere within 24 hours of booking, we will match the lower
            rate and also give you 20% off the competitor's rate.</p>
    </div>
    <div class="w-1/3"></div>
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/f1.png" alt="Fotoja" class="why-image">
    <div class=" text-light w-1/4">
        <p class="module-heading font-semibold mb-4">Parking made <span class="font-bold">smarter</span></p>
        <p class="module-text font-normal">Book and manage your parking from anywhere through the PrishtinaParking app
            or web. Extend a parking session, change a vehicle registration and manage your bookings all from the tap of
            a button.</p>
    </div>
</div>



<?php get_footer() ?>