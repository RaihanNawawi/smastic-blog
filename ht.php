    <style>
        /* Menambahkan font agar mirip dengan desain */
        @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@300;500;700&display=swap');
        body {
            font-family: 'Raleway', sans-serif;
        }
    </style>


    <!-- Navbar -->
    <header class="fixed top-0 left-0 w-full z-50">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center bg-transparent">
            <div class="flex items-center space-x-4">
                <img src="https://play-lh.googleusercontent.com/NDyl1N4_JTl4TNsAfWfr_-xbA2W_gYT3ifloZi7CJvYTVd9qYb5y2Tm9w7sfYdVX_ZE" alt="Agriswara Logo" class="h-8">
                <a href="#" class="text-white font-semibold text-lg">Agnes com</a>
            </div>
            <ul class="hidden md:flex space-x-8">
                <li><a href="#" class="text-white hover:text-gray-300">Services</a></li>
                <li><a href="#" class="text-white hover:text-gray-300">Category</a></li>
                <li><a href="#" class="text-white hover:text-gray-300">Article</a></li>
                <li><a href="#" class="text-white hover:text-gray-300">About Us</a></li>
                <li><a href="#" class="text-white hover:text-gray-300">Contact</a></li>
            </ul>
                <div class="flex space-x-4">
                    <ul class="hidden md:flex">
                    <a href="#" class="text-white font-semibold py-2 px-4 rounded-full hover:text-gray-300">Sign In</a>
                    <a href="#" class="bg-white text-black-600 font-semibold py-2 px-4 rounded-full hover:bg-gray-400">Sign Up</a>
                </ul>
                </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-cover bg-center h-screen" style="background-image: url('https://wallpapers.com/images/featured/islamic-xptqk5xw6adpezzv.jpg');">
        <div class="absolute inset-0 bg-black opacity-40"></div>
        <div class="relative container mx-auto px-6 py-32 text-left text-white">
            <h1 class="text-5xl font-extrabold leading-tight mb-6" style="font-family: 'Raleway', sans-serif;">
                Utilization of Technology to <br> Support Environmentally <br> Friendly Agriculture
            </h1>
            <p class="text-xl mb-8">Supporting sustainable farming practices through modern agricultural technology.</p>

                       <!-- Search bar -->
            <div class="max-w-lg mx-auto md:mx-0 flex items-center relative w-[480px] bg-gray-100 rounded-2xl shadow-md p-1.5 transition-all duration-150 ease-in-out hover:scale-105 hover:shadow-lg">
  <div
    class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none"
  >
    <svg
      class="h-5 w-5 text-gray-400"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 20 20"
      fill="currentColor"
    >
      <path
        fill-rule="evenodd"
        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
        clip-rule="evenodd"
      ></path>
    </svg>
  </div>
  <input
    type="text"
    class="w-full pl-8 pr-24 py-3 text-base text-gray-700 bg-transparent rounded-lg focus:outline-none"
    placeholder="Search for components, styles, creators..."
  />
  <button
    class="absolute right-1 top-1 bottom-1 px-6 bg-[#2F3438] text-white font-medium rounded-xl focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#5044e4]"
  >
    Search
  </button>

            </div>

            <!-- Explore more button -->
            <div class="absolute bottom-16 right-16 mt-8">
                <a href="#popular-articles" class="text-white text-lg flex items-center space-x-2 hover:text-gray-300 transition duration-300">
                    <span>Explore More</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Popular Articles Section -->
    <section id="popular-articles" class="container mx-auto py-12 px-6">
        <h2 class="text-2xl font-bold mb-6">Popular Articles</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-2">
                <img src="https://example.com/popular1.jpg" class="w-full h-60 object-cover mb-4" alt="Article Image">
                <h3 class="text-xl font-semibold">Best Strategy to Achieve Profitable Harvest</h3>
                <p class="text-gray-600 mt-2">Optimal strategies for achieving profitable harvests involve a comprehensive approach to farm management, selection of appropriate crop varieties, and implementation of efficient practices.</p>
                <p class="text-sm text-gray-500 mt-2">October 23, 2023</p>
            </div>
            <div>
                <img src="https://example.com/popular2.jpg" class="w-full h-40 object-cover mb-4" alt="Article Image">
                <h3 class="text-lg font-semibold">Abundant Harvest from Agricultural Farm Land Shows Success</h3>
                <p class="text-sm text-gray-500 mt-2">October 23, 2023</p>
            </div>
            <div>
                <img src="https://example.com/popular3.jpg" class="w-full h-40 object-cover mb-4" alt="Article Image">
                <h3 class="text-lg font-semibold">Latest Innovations Increasing Milk Production and Quality</h3>
                <p class="text-sm text-gray-500 mt-2">October 23, 2023</p>
            </div>
            <div>
                <img src="https://example.com/popular4.jpg" class="w-full h-40 object-cover mb-4" alt="Article Image">
                <h3 class="text-lg font-semibold">Best Practices in Harvesting Vegetables from Plantations</h3>
                <p class="text-sm text-gray-500 mt-2">October 23, 2023</p>
            </div>
        </div>
    </section>

    <!-- Latest Articles Section -->
    <section class="bg-gray-50 py-12">
        <div class="container mx-auto px-6">
            <h2 class="text-2xl font-bold mb-6">Latest Articles</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="https://example.com/latest1.jpg" class="w-full h-40 object-cover mb-4" alt="Article Image">
                    <h3 class="text-lg font-semibold">Exploring Potential and Challenges in Global Agriculture</h3>
                    <p class="text-sm text-gray-500 mt-2">October 23, 2023</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="https://example.com/latest2.jpg" class="w-full h-40 object-cover mb-4" alt="Article Image">
                    <h3 class="text-lg font-semibold">Bringing Change in the Livestock Industry</h3>
                    <p class="text-sm text-gray-500 mt-2">October 23, 2023</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="https://example.com/latest3.jpg" class="w-full h-40 object-cover mb-4" alt="Article Image">
                    <h3 class="text-lg font-semibold">Potential and Constraints Faced in Production Quality</h3>
                    <p class="text-sm text-gray-500 mt-2">October 23, 2023</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="https://example.com/latest4.jpg" class="w-full h-40 object-cover mb-4" alt="Article Image">
                    <h3 class="text-lg font-semibold">Achieving High Productivity from Your Own Home Garden</h3>
                    <p class="text-sm text-gray-500 mt-2">October 23, 2023</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="https://example.com/latest5.jpg" class="w-full h-40 object-cover mb-4" alt="Article Image">
                    <h3 class="text-lg font-semibold">The Best Guide to Planting Seeds with Optimal Results</h3>
                    <p class="text-sm text-gray-500 mt-2">October 23, 2023</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="https://example.com/latest6.jpg" class="w-full h-40 object-cover mb-4" alt="Article Image">
                    <h3 class="text-lg font-semibold">Strategies for Caring for Your Garden More Efficiently and Productively</h3>
                    <p class="text-sm text-gray-500 mt-2">October 23, 2023</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section class="bg-green-600 py-12 text-white text-center">
        <h2 class="text-3xl font-bold mb-4">Get involved in the agricultural uprising</h2>
        <p class="mb-6">Type your email address to join now!</p>
        <input type="email" placeholder="Enter your email" class="px-4 py-2 rounded-l-md text-black focus:outline-none">
        <button class="bg-white text-green-600 px-6 py-2 rounded-r-md hover:bg-gray-200">Join Now</button>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between">
                <div class="mb-6 md:mb-0">
                    <h4 class="font-bold text-lg">Agriswara</h4>
                    <p>Rajawali street No.45, Magelang, Indonesia</p>
                    <p>Email: info@agriswara.com</p>
                </div>
                <div class="flex space-x-12">
                    <div>
                        <h4 class="font-bold">Company Category</h4>
                        <ul class="space-y-2">
                            <li>Agribusiness</li>
                            <li>Financial Services</li>
                            <li>IoT Service Provider</li>
                            <li>Educational Institutions</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold">Services</h4>
                        <ul class="space-y-2">
                            <li>Partner</li>
                            <li>Capital</li>
                            <li>Market</li>
                            <li>Smart Farming</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold">Company</h4>
                        <ul class="space-y-2">
                            <li>About Us</li>
                            <li>Blog</li>
                            <li>FAQ</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-12 text-center text-sm text-gray-500">
                <p>&copy; 2024 Agriswara. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>

</html>

