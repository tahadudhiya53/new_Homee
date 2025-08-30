<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>testimonials.php</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

  <!-- Testimonial Section -->
  <section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-6 text-center">
      <h2 class="text-3xl font-bold mb-8">What Our Clients Say</h2>

      <div class="relative overflow-hidden">
        <!-- Slides Container -->
        <div id="testimonial-slider" class="flex transition-transform duration-700 ease-in-out">
          
          <!-- Slide 1 -->
          <div class="min-w-full px-6">
            <div class="bg-gray-50 rounded-2xl shadow p-8">
              <p class="text-lg italic mb-4">
                "This company provided excellent service and support. I am extremely satisfied!"
              </p>
              <h3 class="font-semibold text-xl">– John Doe</h3>
              <p class="text-gray-500">CEO, Example Corp</p>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="min-w-full px-6">
            <div class="bg-gray-50 rounded-2xl shadow p-8">
              <p class="text-lg italic mb-4">
                "A wonderful experience from start to finish. Highly recommended!"
              </p>
              <h3 class="font-semibold text-xl">– Sarah Smith</h3>
              <p class="text-gray-500">Marketing Manager</p>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="min-w-full px-6">
            <div class="bg-gray-50 rounded-2xl shadow p-8">
              <p class="text-lg italic mb-4">
                "Their attention to detail and professionalism exceeded expectations."
              </p>
              <h3 class="font-semibold text-xl">– Michael Lee</h3>
              <p class="text-gray-500">Entrepreneur</p>
            </div>
          </div>

        </div>
      </div>

      <!-- Dots Indicator -->
      <div class="flex justify-center mt-6 space-x-2">
        <span class="dot w-3 h-3 bg-gray-400 rounded-full cursor-pointer"></span>
        <span class="dot w-3 h-3 bg-gray-400 rounded-full cursor-pointer"></span>
        <span class="dot w-3 h-3 bg-gray-400 rounded-full cursor-pointer"></span>
      </div>
    </div>
  </section>

  <script>
    const slider = document.getElementById("testimonial-slider");
    const dots = document.querySelectorAll(".dot");
    let index = 0;
    const totalSlides = slider.children.length;

    function updateSlider() {
      slider.style.transform = `translateX(-${index * 100}%)`;
      dots.forEach((dot, i) => {
        dot.classList.toggle("bg-blue-500", i === index);
        dot.classList.toggle("bg-gray-400", i !== index);
      });
    }

    function nextSlide() {
      index = (index + 1) % totalSlides;
      updateSlider();
    }

    // Auto Slide every 5s
    setInterval(nextSlide, 5000);

    // Dot Click Event
    dots.forEach((dot, i) => {
      dot.addEventListener("click", () => {
        index = i;
        updateSlider();
      });
    });

    // Initial State
    updateSlider();
  </script>

</body>
</html>
