<?php
/* Template Name: Enfit */
$pageid = get_the_ID();
get_header();
the_post();

?>
<main id="content" class="coming">
    <section class="first__coming">
        <div class="first__coming--content">
            <div class="container special-width text-center">
                <p class="tag-coming flex">
                    <img src="<?= get_template_directory_uri() . '/assets/images/enfit/workout.svg' ?>" alt="">
                    <strong>#1 Fitness and Sports App!</strong>
                </p>
                <p class="has-x-large-font-size">Smarter training, data-driven fitness for everyone.</p>
            </div>
            <div class="first__coming--img">
                <div class="container">
                    <div class="store">
                        <a href="#">
                            <img src="<?= get_template_directory_uri() . '/assets/images/enfit/store.svg' ?>" alt="">
                        </a>
                    </div>
                    <div class="first-img">
                        <div class="main">
                            <img src="<?= get_template_directory_uri() . '/assets/images/enfit/first-mb.svg' ?>" alt="">
                        </div>
                        <div class="chart">
                            <img src="<?= get_template_directory_uri() . '/assets/images/enfit/first-chart.svg' ?>" alt="">
                        </div>
                        <div class="training">
                            <img src="<?= get_template_directory_uri() . '/assets/images/enfit/first-training.svg' ?>" alt="">
                        </div>
                        <div class="workout">
                            <img src="<?= get_template_directory_uri() . '/assets/images/enfit/first-wk.svg' ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    $brand_list = get_field('feature_on', $pageid);
    if ($brand_list) {
        ?>
        <section class="home-feature-on">
            <div class="container">
                <h2 class="pri-color-3 text-center">Featured On</h2>
                <ul>
                    <?php foreach ($brand_list as $hl) {
                        $logo = $hl['logo'];
                        ?>
                        <li><img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>"></li>
                    <?php } ?>
                </ul>
            </div>
        </section>
    <?php } ?>
    <section class="second__coming">
        <div class="container flex">
            <div class="second__coming--left">
                <div class="content">
                    <p class="tag-coming">Our Features</p>
                    <h1>Track your progress, crush your goals, and reach a fitter you!</h1>
                    <p>Key features that propel your fitness journey.</p>
                </div>
                <div class="second__coming--item grid">
                    <div class="it">
                        <img src="<?= get_template_directory_uri() . '/assets/images/enfit/it-1.svg' ?>" alt="">
                        <h4 class="">All the motivation you need.</h4>
                        <p class="has-small-font-size">Join a dynamic community for support, motivation, and shared
                            progress.</p>
                    </div>
                    <div class="it">
                        <img src="<?= get_template_directory_uri() . '/assets/images/enfit/it-2.svg' ?>" alt="">
                        <h4 class="">Diverse Nutrition Recipes.</h4>
                        <p class="has-small-font-size">Access expert-designed plans for personalized fitness goals like
                            weight loss or muscle gain.</p>
                    </div>
                    <div class="it">
                        <img src="<?= get_template_directory_uri() . '/assets/images/enfit/it-3.svg' ?>" alt="">
                        <h4 class="">1000+ Exercises</h4>
                        <p class="has-small-font-size">Explore a diverse range of exercises from strength training to
                            yoga, tailored to all fitness levels.</p>
                    </div>
                    <div class="it">
                        <img src="<?= get_template_directory_uri() . '/assets/images/enfit/it-4.svg' ?>" alt="">
                        <h4 class="">Realtime Progress Tracking</h4>
                        <p class="has-small-font-size">Monitor your workouts, calorie burn, and achievements with
                            detailed, real-time insights.</p>
                    </div>
                </div>
            </div>
            <?php $comingSlick = get_field('slider_image', $pageid); ?>
            <?php if (!empty($comingSlick)): ?>
                <div class="second__coming-right" id="rightSlick">
                    <?php foreach ($comingSlick as $it): ?>
                        <img src="<?= $it['img']['url'] ?>" alt="<?= $it['img']['alt'] ?>">
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <section class="third__coming pd-main">
        <div class="container">
            <div class="third__coming--top text-center">
                <p class="tag-coming">HOW TO START</p>
                <h1>Start Your Fitness Journey in Moments</h1>
                <p>Easy step o start your workout</p>
            </div>
            <div class="third__coming--bottom flex">
                <div class="it">
                    <img class="mr-bottom-20"
                        src="<?= get_template_directory_uri() . '/assets/images/enfit/third-1.svg' ?>"
                        alt="Download App">
                    <h3>Download App</h3>
                    <p class="has-small-font-size">You can download the App from AppStore</p>
                </div>
                <div class="it">
                    <img class="mr-bottom-20"
                        src="<?= get_template_directory_uri() . '/assets/images/enfit/third-2.svg' ?>"
                        alt="Create and Personalized">
                    <h3>Create and Personalized</h3>
                    <p class="has-small-font-size">Create your account and start personalized you preferences!</p>
                </div>
                <div class="it">
                    <img class="mr-bottom-20"
                        src="<?= get_template_directory_uri() . '/assets/images/enfit/third-3.svg' ?>"
                        alt="Start Your Workout!">
                    <h3>Start Your Workout!</h3>
                    <p class="has-small-font-size">Choose the workout based on your preferences.</p>
                </div>
                <div class="it">
                    <img class="mr-bottom-20"
                        src="<?= get_template_directory_uri() . '/assets/images/enfit/third-4.svg' ?>"
                        alt="Analyze and Repeat">
                    <h3>Analyze and Repeat</h3>
                    <p class="has-small-font-size">Gain Value</p>
                </div>
            </div>
        </div>
    </section>
    <section class="fourth__coming">
        <div class="flex">
            <div class="four__coming--left">
                <img src="<?= get_template_directory_uri() . '/assets/images/enfit/fouth-coming.svg' ?>" alt="">
            </div>
            <div class="four__coming--right">
                <div class="content">
                    <p class="has-x-large-font-size">Downlad <span class="enfit">Enfit</span> Today</p>
                    <p class="">Join thousands who are already enjoying a personalized fitness experience. It's fast and
                        easy!</p>
                    <a href="#">
                        <img class="mr-bottom-20"
                            src="<?= get_template_directory_uri() . '/assets/images/enfit/store.svg' ?>" alt="">
                    </a>
                    <p class="">Unlock a <span class="enfit" style="font-size: 27px;">30%</span> discount at Endomondo
                        with
                        our app download!</p>
                </div>
            </div>
        </div>
    </section>
    <section class="fifth__coming">
        <div class="fifth__coming--top text-center">
            <div class="container">
                <p class="tag-coming">App Preview</p>
                <h1>Visualize Your Journey with Our App!</h1>
                <p>Take a closer look at our app's interface and features. These screenshots showcase how our app will
                    enhance your experience and make your journey enjoyable!</p>
            </div>
        </div>
        <div class="fifth__coming--bottom">
            <img src="<?= get_template_directory_uri() . '/assets/images/enfit/fifth-coming.svg' ?>" alt="">
        </div>
    </section>

    <div class="single-main">
        <div class="container">
            <div class="sg-editor">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>