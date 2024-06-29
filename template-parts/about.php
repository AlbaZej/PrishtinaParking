<?php
/*
Template Name: About Us
*/
?>
<?php get_header(); ?>

<div class="container mx-auto flex flex-col md:flex-row mt-4">
    <div class="w-1/2 flex flex-col justify-center">
        <div class="w-10/12 mx-auto">
            <h2 class="module-heading font-bold text-menublue text-4xl">Parking Your Way.</h2>
            <p class="module-heading font-normal">Our mission is to change the
                way the world parks
            </p>
        </div>

    </div>
    <div class="border-l-2 border-menublue pl-4"></div>
    <div class="w-1/2 p-4 md:pl-4  my-auto">
        <p class="tagline text-gray-500 text-sm">We plan to do this by creating more accessible parking through the
            digitalisation of parking assets.</p>
        <br>
        <p class="tagline text-gray-600">Journeys become easier and we become more connected, the more accessible
            our
            parking options are. We're building a digital parking network to move the UK more conveniently, more
            affordably, and more sustainably.</p>
    </div>
</div>

<div class="container mx-auto flex justify-center my-5">
    <div class="w-10/12 ">
        <h2 class="text-2xl font-bold mb-4  text-menublue text-center pt-12">Our Vision</h2>
        <h3 class="module-heading font-normal text-center text-xl">A world where parking is seamlessly
            integrated into our
            travels
            through the use of smart technology.</h3>
    </div>
</div>

<div class="pb-11">
    <img class="h-80 w-full object-cover" src="<?= get_template_directory_uri() . '/assets/images/about.jpg' ?>"
        alt="Image description">
</div>

<div class="container mx-auto flex justify-center items-center flex-col md:flex-row py-10">

    <div class="md:w-1/2 mb-4 md:mb-0 md:mr-4 flex flex-col justify-center px-6 ">
        <h2 class="text-menublue module-heading font-bold mb-4 text-2xl">Our Story: How It All Started</h2>
        <h2 class="text-2xl font-bold mb-4 rounded-md bg-buttonblue inline-block text-center w-20 text-white px-4 py-2">
            2012
        </h2>
        <p class="mb-4 medium-text font-bold ">PrishtinaParking was born...</p>
        <p class="tagline text-sm text-gray-600">PrishtinaParking was born from a 'what if' thought on a walk to the station
            in South West London. With driveways sitting empty and a congested city desperate for affordable parking,
            what if we could bring unused parking spaces to consumers and reduce the friction on road travel?</p>
    </div>

    <div class="md:w-1/2 relative flex justify-center items-center md:pl-80">
        <img class="w-84 h-full object-cover rounded-md"
            src="<?= get_template_directory_uri() . '/assets/images/journey.jpg' ?>" alt="About Us Image">
    </div>
</div>

<div class="container mx-auto flex justify-between py-8 pb-18">

    <div class="w-full md:w-1/3 p-6">
        <h2 class="text-2xl font-bold mb-4 rounded-md bg-buttonblue inline-block text-center text-white px-4 py-2">2014
        </h2>
        <p class="medium-text font-bold mb-4">Harrison & Charles join forces</p>
        <p class="tagline text-sm text-gray-600">In 2014, Harrison Woods joined forces with Charles Cridland as co-founders
            of PrishtinaParking with the vision to build a two-sided marketplace where drivers can search and book
            parking in advance or on-demand. The platform started with privately owned parking spaces such as driveways
            and garages.</p>
    </div>

    <div class="w-full md:w-1/3 p-6">
        <h2 class="text-2xl font-bold mb-4 rounded-md bg-buttonblue inline-block text-center text-white px-4 py-2">2016
        </h2>
        <p class="medium-text font-bold mb-4">Digital transformation</p>
        <p class="tagline text-sm text-gray-600">By 2016, we expanded to include commercial inventory with parking providers
            such as national hotel and supermarket chains, car park operators, landowners, local businesses, charities,
            and schools across the country. What began as a marketplace for parking has evolved into a business that is
            digitally transforming the UK's parking infrastructure.</p>
    </div>

    <div class="w-full md:w-1/3 p-6">
        <h2 class="text-2xl font-bold mb-4 rounded-md bg-buttonblue inline-block text-center text-white px-4 py-2">2019
        </h2>
        <p class="medium-text font-bold mb-4">Building car parks of the future</p>
        <p class="tagline text-sm text-gray-600">PrishtinaParking became a car park operator in 2019 after spending years
            working within an industry reluctant to embrace new technologies. With our mission in mind, PrishtinaParking
            became the UK's most trusted car park operator. We're building the car parks of the future, today, powered
            by ParkMaven technology.</p>
    </div>
</div>

<div class="border-t border-menuwhite w-full my-8 pb-12"></div>

<div class="container mx-auto flex flex-col md:flex-row pt-11 font-family: Mont, sans-serif rounded-md">
    <div class="w-full md:w-1/2 px-4 md:pr-4 py-4 flex flex-col justify-center items-center rounded-md"> 
        <h2 class="text-4xl font-bold text-menublue">Forget the Stress to Find Parking</h2>
        <div class="text-center"> 
            <a href="your-link-url" class="inline-block bg-buttonblue text-white px-4 py-2 rounded-md mt-4">Book a Parking Now</a>
        </div>
    </div>
    <div class="w-full md:w-1/2 px-4 pb-11 flex justify-center items-center rounded-md">
        <img  class="max-w-md h-auto md:h-medium w-full md:w-auto rounded-md"
            src="<?= get_template_directory_uri() . '/assets/images/how-it-works.png' ?>" alt="About Us Image">
    </div>
</div>


<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <?php
        $columns = array(
            array(
                'icon' => '<svg class="w-8 h-8 text-buttonblue" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2c2.756 0 5 2.244 5 5 0 2.88-5 10-5 10s-5-7.12-5-10c0-2.756 2.244-5 5-5zM10 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" clip-rule="evenodd"></path>
                        </svg>',
                'title' => 'Find the best parking',
                'content' => 'Find parking near your destination.'
            ),
            array(
                'icon' => '<svg class="w-8 h-8 text-buttonblue" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 2c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm.5 9.25V6a.75.75 0 0 1 1.5 0v4.25a.75.75 0 0 1-.25.56l-2.5 2.5a.75.75 0 1 1-.5-1.28l2.25-2.25z"></path>
                        </svg>',
                'title' => 'Book your parking space at a good price',
                'content' => 'Enjoy special prices and exclusive offers.'
            ),
            array(
                'icon' => '<svg class="w-8 h-8 text-buttonblue" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M5 2a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V7l-3-3H6a1 1 0 0 0-1-1z"></path>
                            <path d="M5.447 15.5a.5.5 0 0 0 .5-.5V11h3v4h4v-8H7.5a.5.5 0 0 0-.5.5v4.5H5.447z"></path>
                        </svg>',
                'title' => 'When you arrive at the car park, show your reservation',
                'content' => 'If the car park has a number plate reader, you will enter just like at home, without having to show anything.'
            )
        );

        foreach ($columns as $column) {
            ?>
            <div class="bg-gray-100 p-6 rounded-md flex items-center">
                <div class="mr-4"><?php echo $column['icon']; ?></div>
                <div>
                    <h3 class="text-lg font-semibold"><?php echo $column['title']; ?></h3>
                    <p><?php echo $column['content']; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="container mx-auto px-8 flex justify-center items-center pb-24">
    <div class="flex flex-col md:flex-row items-center">
        <img class="w-50 h-50 object-cover rounded-md z-10 -ml-4 mb-4 md:mb-0 md:mr-4"
            src="<?= get_template_directory_uri() . '/assets/images/team.jpg' ?>" alt="About Us Image">
        <div class="p-8 h-[400px] w-[570px] rounded-md bg-menublue text-center">
            <h2 class="module-heading font-normal mb-2 text-white text-left">Behind our technology is an incredible
                team who have
                a real passion for what we are creating at PrishtinaParking.</h2>
            <p class="mt-4 pt-12"><a href="/register"
                    class="inline-block bg-buttonblue text-white font-semibold px-4 py-2 rounded">Join our Team</a></p>
        </div>
    </div>
</div>


<?php get_footer() ?>