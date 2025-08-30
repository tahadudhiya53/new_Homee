<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero.php</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <!-- hero.php -->
    <section class="w-full h-screen relative overflow-hidden">
        <!-- Slider Wrapper -->
        <div id="slider" class="absolute inset-0 w-full h-full">
            <!-- Slide 1 -->
            <div class="slide absolute inset-0 bg-cover bg-center opacity-100 transition-opacity duration-1000"
                style="background-image: url('assets/images/MH1.jpg');">
            </div>

            <!-- Slide 2 -->
            <div class="slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000"
                style="background-image: url('assets/images/MH2.webp');">
            </div>

            <!-- Slide 3 -->
            <div class="slide absolute inset-0 bg-cover bg-center opacity-0 transition-opacity duration-1000"
                style="background-image: url('assets/images/MH3.jpg');">
            </div>
        </div>

        <!-- Dark overlay for readability -->
        <div class="absolute inset-0 bg-black/50"></div>

        <!-- Overlay Content (Text in Center) -->
        <div class="relative z-10 flex items-center justify-center h-full text-center px-6">
            <div>
                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold text-white drop-shadow-lg mb-4">
                    Find Your Dream Home
                </h1>
                <p class="text-lg sm:text-xl md:text-2xl text-gray-200 mb-6">
                    Buy • Rent • Invest with trusted properties
                </p>
                <a href="/new_homee/properties"
                    class="px-6 py-3 bg-blue-600 text-white text-lg rounded-xl shadow-lg hover:bg-blue-700 transition">
                    Explore Now
                </a>
            </div>
        </div>
    </section>

    <!-- JS for Auto Slider -->
    <script>
        let slides = document.querySelectorAll(".slide");
        let currentIndex = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.opacity = (i === index) ? "1" : "0";
            });
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }

        setInterval(nextSlide, 5000); // 5s change
    </script>


</body>

</html>