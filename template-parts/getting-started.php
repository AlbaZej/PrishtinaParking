
<div class="container-xl  bg-gray-100 p-5">

    <div class="flex flex-wrap md:flex-nowrap">
        <div class="booking-div w-full md:w-1/2 p-20 order-2 md:order-1 flex justify-center md:justify-end">
            <img id="booking-image" src="<?php echo $image_step_1; ?>" alt="Booking Step Image"
                class="rounded shadow-lg">
        </div>

        <div class="w-full md:w-1/2 p-4 md:p-8 lg:p-12 order-1 md:order-2 ">
            <div class="text-left mb-6 md:text-left">
                <h2 class="sub-title text-sm font-bold uppercase text-buttonblue md:ms-3">BOOKING YOUR SPACE</h2>
                <h3 class="module-heading font-bold text-4xl font-bold">Getting started</h3>
            </div>
            <div class="flex flex-col space-y-2 md:space-y-8">
                <?php
                // Define image paths using PHP
                $image_step_1 = get_template_directory_uri() . '/assets/images/GS-1.jpg';
                $image_step_2 = get_template_directory_uri() . '/assets/images/GS-2.jpg';
                $image_step_3 = get_template_directory_uri() . '/assets/images/GS-3.jpg';
                ?>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const steps = document.querySelectorAll('.step');
                        const image = document.querySelector('#booking-image');

                        image.src = '<?php echo $image_step_1; ?>';

                        steps.forEach(step => {
                            step.addEventListener('click', function () {
                                const stepNumber = this.getAttribute('data-step');
                                switch (stepNumber) {
                                    case '1':
                                        image.src = '<?php echo $image_step_1; ?>';
                                        break;
                                    case '2':
                                        image.src = '<?php echo $image_step_2; ?>';
                                        break;
                                    case '3':
                                        image.src = '<?php echo $image_step_3; ?>';
                                        break;
                                    default:
                                        image.src = '<?php echo $image_step_1; ?>';
                                        break;
                                }

                                steps.forEach(s => {
                                    s.classList.remove('active');
                                });
                                this.classList.add('active');
                            });
                        });
                    });
                </script>
                <div class="step flex items-center py-2 px-4 rounded-lg cursor-pointer active " data-step="1">
                    <span
                        class="text-buttonblue text-lg font-bold bg-gray-200 w-12 h-12 flex items-center justify-center mr-4 hover:bg-gray-100"
                        style="height: 3.5rem">1</span>
                    <div>
                        <p class="medium-text font-bold text-gray-700 font-bold text-xl mb-1">Search from anywhere</p>
                        <p class="text-gray-600">Search and find parking by app or by web.</p>
                    </div>
                </div>
                <div class="step flex items-center py-2 px-4 rounded-lg cursor-pointer " data-step="2">
                    <span
                        class="text-buttonblue text-lg font-bold bg-gray-200 w-12 h-12 flex items-center justify-center mr-4 hover:bg-gray-100"
                        style="height: 3.5rem">2</span>
                    <div>
                        <p class="medium-text font-bold text-gray-700 font-bold text-xl">Book in advance or on demand</p>
                        <p class="text-gray-600">Pre-book your space or book it when you arrive.</p>
                    </div>
                </div>
                <div class="step flex items-center py-2 px-4 rounded-lg cursor-pointer " data-step="3">
                    <span
                        class="text-buttonblue text-lg font-bold bg-gray-200  w-12 flex items-center justify-center mr-4 hover:bg-gray-100"
                        style="height: 3.5rem">3</span>
                    <div>
                        <p class="medium-text font-bold">Park with confidence</p>
                        <p class="text-gray-600">Manage your parking session from anywhere.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>